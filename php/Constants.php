<?php
define('API_DOMAIN', 'https://hotwix.retailcrm.ru');                           //retail crm домен
define('API_V_CREATE_API', '/api/v4/orders/create');                           //retail crm путь к созданию
define('API_CODE_CRM', 'gTavHPJCpArQxE5Ihk5PW1QQpCBKJQAg');                    //api crm

define('API_GOOGLE', '1B_D7TOLCptJRRhPe7Aqinjebel6j-kR0WWDwJTxa09Q');          //api google
define('GOOGLE_LIST', 'Штаны джоггеры');                                         //лист в гугл таблице

define('PRODUCT_ID', '108');                                                   //ID товара
define('PRODUCT_NAME', 'Джогери чоловічі KOPO - 749 грн.');           //Название товара
define('PRODUCT_PRICE', '749');                                                //Цена
define('PRODUCT_COUNT', '1');                                                  //Количество (набор)
define('PAGE_THANK_YOU', '/thankyou.html');


define('PATH_TO_DB', '/home/sop01/app/assets/lead.db');
define('PATH_TO_AUTOLOAD', '/home/sop01/vendor/autoload.php');

define('SITE_NAME', $_SERVER['SERVER_NAME']);
define('CLIENT_IP', $_SERVER['REMOTE_ADDR']);
define('ORDER_ID', number_format(round(microtime(true)*10 + (int)PRODUCT_ID*10),0,'.',''));
