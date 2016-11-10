(function( $ ) {
	'use strict';
	
	$( document ).ready(function() {
		var calculator = $('.tax-calculator');
		var frame1 = $('.calculator-frame-1');
		var frame2 = $('.calculator-frame-2');

		var dropdownIncome = $('.calculator-income');
		var dropdownDonation = $('.calculator-donation');

		function showFrame1(){
			dropdownIncome.find('.dropdown-value').text('Annual income').attr('data-value', '0');
			dropdownDonation.find('.dropdown-value').text('Your donation').attr('data-value', '0');

			frame2.hide().removeClass('calculator-frame-active');
			frame1.show();
			setTimeout(function(){
				fixHeight();
				frame1.addClass('calculator-frame-active');
			}, 20);
		}

		function showFrame2(income, donation){
			var result = frame2.find('.calculator-result-'+donation+income);

			frame2.find('.calculator-result').removeClass('calculator-result-active');
			frame1.hide().removeClass('calculator-frame-active');

			frame2.show();
			setTimeout(function(){
				frame2.addClass('calculator-frame-active');
				result.addClass('calculator-result-active');
				
			}, 20);
		}

		function fixHeight(){
			if(calculator.css('padding-top') == '0px'){
				calculator.height(frame1.outerHeight());
			} else {
				calculator.height('inherit');
			}
		}

		$(window).resize(function() {
			fixHeight();
		});

		$('.calculator-dropdown').each(function(){
			var dropdown = $(this);
			var options = dropdown.find('.dropdown-options');
			var option = dropdown.find('.dropdown-option');
			var value = dropdown.find('.dropdown-value');

			dropdown.click(function(){
				if(dropdown.hasClass('calculator-dropdown-open')) {
					$('.calculator-dropdown').removeClass('calculator-dropdown-open');
				} else {
					$('.calculator-dropdown').removeClass('calculator-dropdown-open');
					dropdown.addClass('calculator-dropdown-open');
				}
				return false;
			});

			option.click(function(){
				value.text($(this).text()).attr('data-value', $(this).attr('data-value'));
			});
		});

		showFrame1();

		$('.calculator-calculate').click(function(){
			var income = dropdownIncome.find('.dropdown-value').attr('data-value');
			var donation = dropdownDonation.find('.dropdown-value').attr('data-value');

			if((income != 0) && (donation != 0)) {
				showFrame2(income, donation);
			}

			return false;
		});

		$('.calculator-restart').click(function(){
			showFrame1();
		});
	});

})( jQuery );
