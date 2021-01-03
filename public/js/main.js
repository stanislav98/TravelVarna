(function($) {
	var inp =  document.getElementById("bus_number");
	if(inp) {
	function autocomplete(inp, arr) {
		  /*the autocomplete function takes two arguments,
		  the text field element and an array of possible autocompleted values:*/
		  var currentFocus;
		  /*execute a function when someone writes in the text field:*/
		  inp.addEventListener("input", function(e) {
		      var a, b, i, val = this.value;
		      /*close any already open lists of autocompleted values*/
		      closeAllLists();
		      if (!val) { return false;}
		      currentFocus = -1;
		      /*create a DIV element that will contain the items (values):*/
		      a = document.createElement("DIV");
		      a.setAttribute("id", this.id + "autocomplete-list");
		      a.setAttribute("class", "autocomplete-items");
		      /*append the DIV element as a child of the autocomplete container:*/
		      this.parentNode.appendChild(a);
		      /*for each item in the array...*/
		      for (i = 0; i < arr.length; i++) {
		        /*check if the item starts with the same letters as the text field value:*/
		        if (arr[i].substr(0, val.length).toUpperCase() == val.toUpperCase()) {
		          /*create a DIV element for each matching element:*/
		          b = document.createElement("DIV");
		          /*make the matching letters bold:*/
		          b.innerHTML = "<strong>" + arr[i].substr(0, val.length) + "</strong>";
		          b.innerHTML += arr[i].substr(val.length);
		          /*insert a input field that will hold the current array item's value:*/
		          b.innerHTML += "<input type='hidden' value='" + arr[i] + "'>";
		          /*execute a function when someone clicks on the item value (DIV element):*/
		              b.addEventListener("click", function(e) {
		              /*insert the value for the autocomplete text field:*/
		              inp.value = this.getElementsByTagName("input")[0].value;
		              /*close the list of autocompleted values,
		              (or any other open lists of autocompleted values:*/
		              closeAllLists();
		          });
		          a.appendChild(b);
		        }
		      }
		  });
		  /*execute a function presses a key on the keyboard:*/
		  inp.addEventListener("keydown", function(e) {
		      var x = document.getElementById(this.id + "autocomplete-list");
		      if (x) x = x.getElementsByTagName("div");
		      if (e.keyCode == 40) {
		        /*If the arrow DOWN key is pressed,
		        increase the currentFocus variable:*/
		        currentFocus++;
		        /*and and make the current item more visible:*/
		        addActive(x);
		      } else if (e.keyCode == 38) { //up
		        /*If the arrow UP key is pressed,
		        decrease the currentFocus variable:*/
		        currentFocus--;
		        /*and and make the current item more visible:*/
		        addActive(x);
		      } else if (e.keyCode == 13) {
		        /*If the ENTER key is pressed, prevent the form from being submitted,*/
		        e.preventDefault();
		        if (currentFocus > -1) {
		          /*and simulate a click on the "active" item:*/
		          if (x) x[currentFocus].click();
		        }
		      }
		  });
		  function addActive(x) {
		    /*a function to classify an item as "active":*/
		    if (!x) return false;
		    /*start by removing the "active" class on all items:*/
		    removeActive(x);
		    if (currentFocus >= x.length) currentFocus = 0;
		    if (currentFocus < 0) currentFocus = (x.length - 1);
		    /*add class "autocomplete-active":*/
		    x[currentFocus].classList.add("autocomplete-active");
		  }
		  function removeActive(x) {
		    /*a function to remove the "active" class from all autocomplete items:*/
		    for (var i = 0; i < x.length; i++) {
		      x[i].classList.remove("autocomplete-active");
		    }
		  }
		  function closeAllLists(elmnt) {
		    /*close all autocomplete lists in the document,
		    except the one passed as an argument:*/
		    var x = document.getElementsByClassName("autocomplete-items");
		    for (var i = 0; i < x.length; i++) {
		      if (elmnt != x[i] && elmnt != inp) {
		      x[i].parentNode.removeChild(x[i]);
		    }
		  }
		}
		/*execute a function when someone clicks in the document:*/
		document.addEventListener("click", function (e) {
		    closeAllLists(e.target);
		});
		}
			var names = [];
	$('.grid-col--fixed-left div.grid-item[data-name]').each(function(){
		names.push($(this).attr('data-name'));
	});

	autocomplete(document.getElementById("bus_number"), names);

	}

	var parent;
	function isEmail(email) {
	  var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
	  return regex.test(email);
	}


	function isTenNumbers(numbers) {
	  var regex = /\d{10}/;
	  if(regex.test(numbers) && numbers.toString().length == 10) {
	  	return true;
	  }
	  return false;
	}

	function isEmpty(str) {
	  return str.replace(/^\s+|\s+$/g, '').length == 0;
	}



	$("#bus_number").keyup(function() {

	    if (!this.value) {
	    	$('.grid-item[data-id].d-none').each(function(){
	    		$(this).removeClass('d-none');
	    	})
	    }

	});

	$(document).on('click','.administrator .admin_links li',function(){
		if(!$(this).hasClass('active_link')) {
			$('.administrator .admin_links li.active_link').removeClass('active_link');
			$(this).addClass('active_link');
			var index = $(this).index();
			if(index == 0) {
				$('.posts,.penalties,.add_post').removeClass('d-none');
				$('.administrator .right .add_post').removeClass('d-none');
			} else if(index == 1) {
				$('.posts').removeClass('d-none');
				$('.penalties').addClass('d-none');
				$('.add_post').addClass('d-none');
			} else if(index == 2) {
				$('.penalties').removeClass('d-none');
				$('.posts').addClass('d-none');
				$('.add_post').addClass('d-none');
			} else if(index == 3) {
					$('.posts').addClass('d-none');
					$('.penalties').addClass('d-none');
					$('.add_post').removeClass('d-none');

			}
		}
	});

	$('form#search_buses').submit(function(e){
		e.preventDefault();
		var val = $('.filter_info .filter .right form input[name="bus_number"]').val();
		var token = $("input[name='csrfToken']").val();
		if (Object.values(names).includes(val)) {
			$.ajax({
		        url: "/scheludes/search",
		        type:"POST",
		           data:{
		           		stop_id : val , 
		           	},
				   dataType:'JSON',
				    headers: {
	                    'X-CSRF-Token': token 
	               },
		           success:function(response){
		          	var data_to_hide = response.result.stop_id;
			          	if(data_to_hide) {
			          		$('.grid-item--header').each(function(){
			          			$(this).attr('data-id',data_to_hide);
			          		});
				          	$(".grid-item[data-id!="+data_to_hide+"]").each(function(){
				          		$(this).addClass('d-none');
				          	});
			          	} 
		        	},
		        error: function(xhr, status, error) {
		        	alert("Възникна грешка ! Моля опитайте отново!");
				}
		       });
		} else {
			alert("Спирката не е в графика");
		}

	
	});

	$(document).on('click','.stars span',function(){
		$('.stars span').each(function(){
			$(this).removeClass('star_active');
			$(this).removeClass('yellow');
		})
		$(this).addClass('star_active');
		var star = $(this).attr('data-id');
		$(this).nextAll().addClass('yellow');
	});

	$('form.encourage').submit(function(e){
			e.preventDefault();
			error = 0;
			var token = $("input[name='_token']").val();
			user_id = $('select[name="user_encourage"]').val();
			message = $('textarea[name="pooshtri_message"]').val();
			stars = $('.stars span.star_active').attr('data-id');
			if(!user_id) {
				error = 1;
				alert("Моля изберете служител !");
			}
			if(isEmpty(message)) {
				error =1;
				alert("Моля въведете текст");
			}
			if($('.stars span.star_active').length == 0) {
				error =1;
				alert("Моля оценете служителя с звезди");
			} 
	   	
	   		if(error == 0) {
	   			$.ajax({
			        url: "/encourage",
			        type:"POST",
			           data:{
			           		user_id : user_id , 
			           		message : message , 
			           		stars : stars , 
			           	},
					   dataType:'JSON',
					    headers: {
		                    'X-CSRF-Token': token 
		               },
			           success:function(response){
			          $('.modal.sucess_response').toggleClass('d-none');
			          $('.modal.sucess_response .modal_body').html(response.success);
			          $('.modal.sucess_response .modal_header .icon_box span').html("done");
			          $('.modal.sucess_response .modal_header .icon_box').addClass("sucess");
			          $('.modal.sucess_response .modal_header .modal_title').html("Благодарим ви !");
			        },
			        error: function(xhr, status, error) {
			        	var obj = JSON.parse(xhr.responseText);
			        	var errors = obj.errors;
			        	 $('.modal.sucess_response').toggleClass('d-none');
			        	 $('.modal.sucess_response .modal_header .icon_box span').html("close");
			        	   $('.modal.sucess_response .modal_header .icon_box').addClass("fail");
			        	 $('.modal.sucess_response .modal_header .modal_title').html("Въведете коректни данни !");
			        	for(var i = 0, l = Object.keys(errors).length; i < l; i++) {
			        	  $('.modal.sucess_response .modal_body').append("<p>"+errors[Object.keys(errors)[i]]+"</p>");
			        	 };
					}
			       });
	   		}
   	});	

		$('form.post_add').submit(function(e){
			e.preventDefault();
			error = 0;
			var token = $("input[name='csrfToken']").val();
			var title = $('input[name="post_title"]').val();
			var content = $('textarea[name="content"]').val();
	   		if(isEmpty(title)) {
	   			alert("Моля попълнете заглавие");
	   			error = 1;
	   		}

	   		if(!content) {
	   			alert("Моля попълнете описание");
	   			error = 1;
	   		}
	   		if(error == 0) {
	   			$.ajax({
			        url: "/admin-dashboard",
			        type:"POST",
			           data:{
			           		title : title , 
			           		content : content , 
			           	},
					   dataType:'JSON',
					    headers: {
		                    'X-CSRF-Token': token 
		               },
				        success:function(response){
				        	alert("Успешно добавихте публикацията !");
				        	$('form.post_add')[0].reset();

				        },
				        error: function(xhr, status, error) {
				        	alert("Възникна проблем при добавянето на публикацията! Моля опитайте отново");
						}
			       });
	   		}
   	});	

	$(document).on('click','.administrator .right ul.list_posts li span.remove_post',function(){
	   		var token = $("input[name='csrfToken']").val();
	   		var id = $(this).attr('data-id');
	   			  $.ajax({
			        url: "/admin-dashboard/delete-post",
			        type:"POST",
			           data:{
			           		post_id : id , 
			           	},
					   dataType:'JSON',
					    headers: {
		                    'X-CSRF-Token': token 
		               },
				        success:function(response){
				        	alert("Успешно премахнахте публикацията !");
				        	$('.list_posts li[data-id="'+id+'"]').addClass('d-none');

				        },
				        error: function(xhr, status, error) {
				        	alert("Възникна проблем при премахването на публикацията! Моля опитайте отново");
						}
			       });
   	});	

  	$(document).on('click','.administrator .right ul.list_penalties li p.icons_actions span.remove_penalty',function(){
	   		var token = $("input[name='csrfToken']").val();
	   		var id = $(this).attr('data-id')
	   			  $.ajax({
			        url: "/admin-dashboard/delete-penalty",
			        type:"POST",
			           data:{
			           		penalty_id : id , 
			           	},
					   dataType:'JSON',
					    headers: {
		                    'X-CSRF-Token': token 
		               },
				        success:function(response){
				        	alert("Успешно премахнахте репорта !");
				        	$('.list_penalties li[data-id="'+id+'"]').addClass('d-none');

				        },
				        error: function(xhr, status, error) {
				        	alert("Възникна проблем при премахването на репорта! Моля опитайте отново");
						}
			       });
   	});	

   	$(document).on('click','.administrator .right ul.list_penalties li p.icons_actions span.accept_penalty',function(){
	   		var token = $("input[name='csrfToken']").val();
	   		var id = $(this).attr('data-id');
	   		// var span = $();
	   		var user_id = $(this).next().next().val();
	   		if(!user_id) {
	   			alert("Моля изберете служител когото да глобите !");
	   		} else { 
	   			  $.ajax({
			        url: "/admin-dashboard/accept-penalty",
			        type:"POST",
			           data:{
			           		penalty_id : id ,
			           		user_id : user_id 
			           	},
					   dataType:'JSON',
					    headers: {
		                    'X-CSRF-Token': token 
		               },
				        success:function(response){
				        	alert("Успешно одобрихте репорта !");
				        	$('.list_penalties li[data-id="'+id+'"]').addClass('d-none');

				        },
				        error: function(xhr, status, error) {
				        	alert("Възникна проблем при одобряването на репорта! Моля опитайте отново");
						}
			       });
	   			}
   	});

	$(document).on("click",".buy_ticket",function(e) {
		e.preventDefault();
		$('#qr_modal').toggleClass('d-none');
	});

	$(document).on("click","#confirm_send",function(e) {
		e.preventDefault();
		$('.modal.sucess_response').toggleClass('d-none');
	});

	$(document).on("click","#close_modal",function(e) {
		e.preventDefault();
		$('#qr_modal').toggleClass('d-none');
	});

	$(document).on("click","header .navigation .second_menu span",function(e) {
		$('.submenu').toggleClass('visible');
	});

	$(document).on("click","#vhod,.close_reg_vhod",function(e) {
			e.preventDefault();
			$('#vhod_modal').toggleClass('d-none');
			$('.mobile_visible').removeClass('mobile_visible');
			$('.hamburger').removeClass('visible');
	});

	$(document).on("click","input,select,textarea",function() {
			parent = $(this).parent()
			$(this).parent().addClass('parent');
	});

	$(document).on("click","a.forgot_password_button",function(e) {
		e.preventDefault();
		$('#vhod_modal').addClass('d-none');
		$('#vhod_modal_user').addClass('d-none');
		$('#forgot_pass_modal').removeClass('d-none');
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

	$('input,select,textarea').focus(function(){
		parent = $(this).parent()
		$(this).parent().addClass('parent');
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

	// $(document).on('keydown', "input[name='password'],input[name='passwordvalidation']", function(e) {
	//     if (e.keyCode == 32) return false;
	// });

	$(document).ready(function(){
		$('select').each(function(){
			$(this).prop("selectedIndex", -1);
		})
	});

	$('select[name="sfera_activity"]').change(function(){
		if($('select[name="sfera_activity"]').val() == 'Служител на партньори') {
			$('.partners_select').removeClass('d-none');
		} else {
			if(!$('.partners_select').hasClass('d-none')) {
				$('.partners_select').addClass('d-none');
			}
		}
	});

	$(document).on('click','#submit_calc',function(e){
		e.preventDefault();
		error = 0;
		var age = $('input[name="age"]').val();
		var sfera = $('select[name="sfera_activity"]').val();
		var partners = $('select[name="partners_calc"]').val();
		if(age == "" || age== null) {
			alert("Моля попълнете години");
			error = 1;
		}

		if (sfera == "" || sfera== null) {
			alert("Моля попълнете сфера на дейност");
			error = 1;
		}

		if(sfera == 'Служител на партньори') {
			if(isEmpty(partners)) {
				alert("Моля избере партньор");
				error = 1;
			}
		}
		var discount = 0;
		if( error == 0 ) {
			if(age <= 18) {
				discount += 10;
			} 
			if(sfera == 'Учащ' || sfera == 'Пенсионер') {
				discount += 5
			}
			if(sfera == 'Служител на партньори') {
				if(partners == 'Технически университет') {
					discount += 10;
				} else if (partners == 'Община Варна') {
					discount +=15;
				} else if(partners == 'Други') {
					discount +=5;
				}
			}
			$('.price_calced span').html(40-discount+"лв.");
		}
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
	
	$(document).on('click','.overlay_error',function(){
		$('.overlay_error').each(function() {
			$(this).removeClass('active');
		})
	});

	$(document).on('click','.close_overlay_error',function(){
		$('.overlay_error').each(function() {
			$(this).removeClass('active');
		})

	});

	$(document).on("click",".hamburger",function() {
      $(this).toggleClass("visible");
      $('header .navigation .menu').toggleClass("mobile_visible");
    });

	  $("form.report").submit(function(event){
	      event.preventDefault();
	       var error = 0;
	      if(isEmpty($('input[name="user_name"]').val())) {
	      	alert("Моля въведете данни в полето за име !");
      		error = 1;
	      }
	      if(!isTenNumbers($('input[name="phone"]').val())) {
	      		alert("Моля въведете коректен телефонен номер !");
	      		error = 1;
	      }

	      if(!isEmail($('input[name="email"]').val())) {
	      	alert("Моля въведете коректен имейл !");
	      	error = 1;
	      }
	      var selected_option = $('#penalty_id option:selected');
	      if(selected_option.length == 0) {
      		alert("Моля изберете вид на нарушението !");
	      	error = 1;
	      }

	      if(isEmpty($('textarea[name="violation"]').val())) {
	      		alert("Моля въведете съобщение !");
	      		error = 1;
	      }
	      if ($('input[name="violation_image_path"]').get(0).files.length === 0) {
 		   	alert("Моля прикачете файл !");
	      		error = 1;
		  }
	      if(error == 0) {
		      $.ajax({
		        url: "/report",
		        type:"POST",
		         data:new FormData(this),
				   dataType:'JSON',
				   contentType: false,
				   cache: false,
				   processData: false,
			        success:function(response){
			          $('.modal.sucess_response').toggleClass('d-none');
			          $('.modal.sucess_response .modal_body').html(response.success);
			          $('.modal.sucess_response .modal_header .icon_box span').html("done");
			          $('.modal.sucess_response .modal_header .icon_box').addClass("sucess");
			          $('.modal.sucess_response .modal_header .modal_title').html("Благодарим ви !");
			          $('form.report')[0].reset();
			        },
			        error: function(xhr, status, error) {
			        	var obj = JSON.parse(xhr.responseText);
			        	var errors = obj.errors;
			        	$('#confirm_send').addClass('not');
			        	 $('.modal.sucess_response').toggleClass('d-none');
			        	 $('.modal.sucess_response .modal_header .icon_box span').html("close");
			        	   $('.modal.sucess_response .modal_header .icon_box').addClass("fail");
			        	 $('.modal.sucess_response .modal_header .modal_title').html("Въведете коректни данни !");
			        	for(var i = 0, l = Object.keys(errors).length; i < l; i++) {
			        	  $('.modal.sucess_response .modal_body').append("<p>"+errors[Object.keys(errors)[i]]+"</p>");
			        	 };
					}
		       });
		  }
	  });

	   $("form.options").submit(function(event){
	   		event.preventDefault();
	   		 var error = 0;
		      if(isEmpty($('input[name="change_name"]').val())) {
		      	alert("Моля въведете данни в полето за име !");
	      		error = 1;
		      }
		      if(!isEmail($('input[name="change_email"]').val())) {
		      	alert("Моля въведете коректен имейл !");
	      		error = 1;
		      }
	       if(!isTenNumbers($('input[name="change_phone"]').val())) {
	      		alert("Моля въведете коректен телефонен номер !");
	      		error = 1;
	      	}

	      	if(error == 0 ) {
	      		$("form.options")[0].submit();
	      	}
	   });

	   $("form#contact_form").submit(function(event){
	      event.preventDefault();
	      var error = 0;
	      if(isEmpty($('input[name="username"]').val())) {
	      	alert("Моля въведете данни в полето за име !");
      		error = 1;
	      }
	      if(!isTenNumbers($('input[name="phone"]').val())) {
	      		alert("Моля въведете коректен телефонен номер !");
	      		error = 1;
	      }

	      if(!isEmail($('input[name="email"]').val())) {
	      	alert("Моля въведете коректен имейл !");
	      	error = 1;
	      }

	      if(isEmpty($('textarea[name="message"]').val())) {
	      		alert("Моля въведете съобщение !");
	      		error = 1;
	      }
	      if(error == 0) {
		      $.ajax({
		        url: "/contact",
		        type:"POST",
		         data:new FormData(this),
				   dataType:'JSON',
				   contentType: false,
				   cache: false,
				   processData: false,
			        success:function(response){
			          $('.modal.sucess_response').toggleClass('d-none');
			          $('.modal.sucess_response .modal_body').html(response.success);
			          $('.modal.sucess_response .modal_header .icon_box span').html("done");
			          $('.modal.sucess_response .modal_header .icon_box').addClass("sucess");
			          $('.modal.sucess_response .modal_header .modal_title').html("Благодарим ви !");
			        },
			        error: function(xhr, status, error) {
			        	var obj = JSON.parse(xhr.responseText);
			        	var errors = obj.errors;
			        	$('#confirm_send').addClass('not');
			        	 $('.modal.sucess_response').toggleClass('d-none');
			        	 $('.modal.sucess_response .modal_header .icon_box span').html("close");
			        	   $('.modal.sucess_response .modal_header .icon_box').addClass("fail");
			        	 $('.modal.sucess_response .modal_header .modal_title').html("Въведете коректни данни !");
			        	for(var i = 0, l = Object.keys(errors).length; i < l; i++) {
			        	  $('.modal.sucess_response .modal_body').append("<p>"+errors[Object.keys(errors)[i]]+"</p>");
			        	 };
					}
		       });
		  }
	  });

	   $(document).on('click','a[data-type]',function(e){
	   	e.preventDefault();

	   		if($('input[name="can_activate"]').val() == 1 ) {
	   			var token = $("input[name='csrfToken']").val();
	   			  $.ajax({
			        url: "/subscriptions",
			        type:"POST",
			           data:{
			           		type_id : $(this).attr('data-type') , 
			           		user_id : $('input[name="user_id"]').val() 
			           	},
					   dataType:'JSON',
					    headers: {
		                    'X-CSRF-Token': token 
		               },
				        success:function(response){
				        	$('input[name="can_activate"]').val('0');
				          $('.modal.sucess_response').toggleClass('d-none');
				          $('.modal.sucess_response .modal_body').html(response.success);
				          $('.modal.sucess_response .modal_header .icon_box span').html("done");
				          $('.modal.sucess_response .modal_header .icon_box').addClass("sucess");
				          $('.modal.sucess_response .modal_header .modal_title').html("Благодарим ви !");
				        },
				        error: function(xhr, status, error) {
				        	var obj = JSON.parse(xhr.responseText);
				        	var errors = obj.errors;
				        	$('#confirm_send').addClass('not');
				        	 $('.modal.sucess_response').toggleClass('d-none');
				        	 $('.modal.sucess_response .modal_header .icon_box span').html("close");
				        	   $('.modal.sucess_response .modal_header .icon_box').addClass("fail");
				        	 $('.modal.sucess_response .modal_header .modal_title').html("Въведете коректни данни !");
				        	for(var i = 0, l = Object.keys(errors).length; i < l; i++) {
				        	  $('.modal.sucess_response .modal_body').append("<p>"+errors[Object.keys(errors)[i]]+"</p>");
				        	 };
						}
			       });
	   		} else {
	   			alert("Вече имате активен абонамент");
	   		}

	   });

})(jQuery);
