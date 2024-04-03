

$('.dropdownDost').click(function () {
			$(this).attr('tabindex', 1).focus();
			$(this).toggleClass('active');
			$(this).find('.dropdown-menu').slideToggle(300);
		});

		$('.dropdownDost').focusout(function () {
			$(this).removeClass('active');
			$(this).find('.dropdown-menu').slideUp(300);
		});

		$('.dropdownDost .dropdown-menu li').click(function () {
			$(this).parents('.dropdownDost').find('span').text($(this).text());
			$(this).parents('.dropdownDost').find('input').attr('value', $(this).attr('id'));
	

		});
