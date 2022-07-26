$(document).ready(function () {

	document.querySelector('.back_video').playbackRate = 1

	function showPopup() {
		$('#ModalCenter').modal('show');
	}

	setTimeout(showPopup, 300000); //время открытия попапа

	$('#set-feed').click(function () {
		$('#modal-set-feed').modal('show');
	});

	$('#feed-form').submit(function (e) {
		e.preventDefault();
		$('#feed-body').hide();
		$('#feed-load').show();
		setTimeout(hideFeedLoad, 3000);
	});

	function hideFeedLoad() {
		$('#feed-load').hide();
		showFeedPostReady();
	}

	function showFeedPostReady() {
		$('#feed-post-ready').show();
		setTimeout(toggleFeedModal, 3000);
	}

	function toggleFeedModal() {
		$('#modal-set-feed').modal('toggle');
	}

	function goToaAnchor() {
		$("html, body").animate({
			scrollTop: $($(this).attr("href")).offset().top + "px"
		}, {
			duration: 3500,
			easing: "swing"
		});
		return false;
	}

	$('.going-to-form').click(goToaAnchor);

	$("body").on("contextmenu", false);


	$('#main-form').submit(function (e) {
		$(this).find('.button-m').attr("disabled", true);
		e.preventDefault();
		var formData = $(this).serializeObject();
		postForm($(this), formData.name, formData.phone, $(this).attr('action'));
	});

	$('#modal-form').submit(function (e) {
		$(this).find('.button-m').attr("disabled", true);
		e.preventDefault();
		var formData = $(this).serializeObject();
		formData.name = formData.name + ' - POPUP';
		postForm($(this), formData.name, formData.phone, $(this).attr('action'));
	});
});

function postForm(form, name, phone, addr) {
	form.fadeOut('fast', function () {
		form.siblings('.loader').fadeIn('fast', function () {
			// noinspection JSUnresolvedFunction
			var urlParams = new URLSearchParams(window.location.search);
			$.post(addr +'?'+urlParams.toString(), {name: name, phone: phone}, function (data) {
				if (data.error) {
					form.siblings('.loader').fadeOut('fast', function () {
						form.siblings('.error-message').text(data.message);
						form.siblings('.error-message').fadeIn('fast', function () {
							return;
						});
					});
				} else {
					form.siblings('.loader').hide();
					form.siblings('.error-message').text('Спасибо за заказ!');
					form.siblings('.error-message').show();
					$(location).attr('href', data.thankyouPage);
				}
			}, 'json');
		});
	});


}

$.fn.serializeObject = function () {
	var obj = {};
	var arr = this.serializeArray();
	arr.forEach(function (item, index) {
		if (obj[item.name] === undefined) {
			obj[item.name] = item.value || '';
		} else {
			if (!obj[item.name].push) {
				obj[item.name] = [obj[item.name]];
			}
			obj[item.name].push(item.value || '');
		}
	});
	return obj;
};