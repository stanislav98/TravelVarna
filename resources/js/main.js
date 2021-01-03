(function($) {
	var parent;
	$(document).on("click",".buy_ticket",function(e) {
		e.preventDefault();
		$('#qr_modal').toggleClass('d-none');
	});

	$(document).on("click","#close_modal",function(e) {
		e.preventDefault();
		$('#qr_modal').toggleClass('d-none');
	});

	$(document).on("click","#vhod,.close_reg_vhod",function() {
			$('#vhod_modal').toggleClass('d-none');
	});

	$(document).on("click","input,select,textarea",function() {
			parent = $(this).parent()
			$(this).parent().addClass('parent');
	});

	$(document).on("click","#vhod_user",function(e) {
		e.preventDefault();
		$('#vhod_modal').toggleClass('d-none');
		$('#vhod_modal_user').toggleClass('d-none');
	});	

	$(document).on("click","#register_user_back",function(e) {
		e.preventDefault();
		$('#vhod_modal').toggleClass('d-none');
		$('#vhod_modal_user').toggleClass('d-none');
	});



	$(document).on("click",".close_vhod",function(e) {
		e.preventDefault();
		$('#vhod_modal_user').toggleClass('d-none');
	});


	$('input,select,textarea').focusout(function(){
		if( $.trim( $(this).val() ) == '') {
			parent.removeClass('parent');
		}
	});

	$(document).on('click','.tabs li',function(){
		var data = $(this).attr('data-id');
		$('.tabs li').each(function(){
			$(this).removeClass('active_tab');
		});
		$(this).addClass('active_tab');

		$('.container').each(function(){
			$(this).removeClass('active_container');
		});
		$(".container[data-id='"+data+"']").addClass('active_container');
	});

	$(document).on('keydown', "input[name='password'],input[name='passwordvalidation']", function(e) {
	    if (e.keyCode == 32) return false;
	});

	$(document).ready(function(){
		$('select').each(function(){
			$(this).prop("selectedIndex", -1);
		})
	});

	$(document).on('click','#submit_calc',function(){
		alert("calc");
	})

	$(document).ready(function(){
	    $('input[type="number"]').on('keyup',function(){
	        v = parseInt($(this).val());
	        min = parseInt($(this).attr('min'));
	        max = parseInt($(this).attr('max'));

	        if (v < min){
	            $(this).val(min);
	        } else if (v > max){
	            $(this).val(max);
	        }
	    });
	});

	$(document).on('click','.expand_more',function(){
		// expand less
		$(this).removeClass('expand_more');
		$(this).addClass('expand_less');
		$(this).html('expand_less');
		$(this).parent().parent().addClass('expanded');
	});

	$(document).on('click','.expand_less',function(){
		// expand less
		$(this).removeClass('expand_less');
		$(this).addClass('expand_more');
		$(this).parent().parent().removeClass('expanded');
		$(this).html('expand_more');
	});
	
})(jQuery);
