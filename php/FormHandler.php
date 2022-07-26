<?php

/** @noinspection PhpUndefinedMethodInspection */
/** @noinspection PhpIncludeInspection */
/** @noinspection PhpUndefinedClassInspection */
/** @noinspection PhpUndefinedNamespaceInspection */

require 'Constants.php';
require(PATH_TO_AUTOLOAD);

use App\SaveLead;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['name']) && isset($_POST['phone']))
{
	$response = [];

	$utm = [
		'source'   => $_GET['utm_source'],
		'medium'   => $_GET['utm_medium'],
		'campaign' => $_GET['utm_campaign'],
		'term'     => $_GET['utm_term'],
		'content'  => $_GET['utm_content'],
	];

	$data = [
		'name' => $_POST['name'],
		'phone' => $_POST['phone'],
		'utm' => $utm
	];
	$saveObj = new SaveLead(__DIR__);
	$saveResponse = $saveObj->saveLead($data);
	if ($saveResponse['error'] === false)
	{
		$response = [
			'error' => false,
			'thankyouPage' => PAGE_THANK_YOU
		];
	} else
	{
		$response['error'] = true;
		switch ($saveResponse['key'])
		{
			case 'crm':
			case 'set':
				$response['message'] = 'Упс, щось пішло не так, спробуйте пізніше';
				break;
			case 'get':
				$response['message'] = 'Ваша заявка знаходиться в обробці';
				break;
		}
	}

$order_details = array (
        'title'               => 'Нове замовлення',
        'source_id'         => 31,
        'client_attributes'   => array (
            'person'            => $_POST['name'],
            'status_id'         => 28,
            'lead'              => true,
            'phones' => array (
                0 => $_POST['phone'],
            )
        ),
        'jobs_attributes' => array (
            0 => array(
                'amount'              => 1,
                'title'               => 'Джогери чоловічі KOPO - 749 грн.',
                'product_attributes'  => array (
                    'sku'               => 123,
                    'title'             => 'Джогери чоловічі KOPO - 749 грн.',
                    'price'             => 749
                )
            )
        ),
    );

    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, 'https://api.keepincrm.com/v1/agreements?ignore_price_list=true');
    curl_setopt($curl, CURLOPT_HTTPHEADER, array('Accept: application/json', 'X-Auth-Token: RPEFKuq2kgWC4RSuAhQ48F2V', 'Content-Type: application/json'));
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 2);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curl, CURLOPT_POST, 1);
    curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($order_details));
    curl_exec($curl);
    curl_close($curl);

	echo json_encode($response, JSON_UNESCAPED_UNICODE);
}

