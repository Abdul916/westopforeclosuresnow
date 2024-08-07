<?php
function custom_chat_form(){
	ob_start();
	?>
	<style>
		#chat_box {
			position: fixed;
			bottom: 65px;
			right: 25px;
			width: 300px;
			max-height: 80%;
			border: 1px solid #ccc;
			border-radius: 5px;
			overflow: hidden;
			display: none;
			height: 700px;
		}
		#chat_header {
			background-color: #0253a7;
			color: #fff;
			padding: 10px;
			position: relative;
		}
		#chat_body {
			height: 388px;
			overflow-y: auto;
			padding: 10px;
			border-left: 3px solid #0253a7 !important;
			border-bottom-left-radius: 5px;
			width: 94%;
			position: absolute;
			top: 83px;
			z-index: 9999;
			scrollbar-width: thin;
			scrollbar-color: #bfbfbf #f0f0f0;
			right: 8px;
			background-color: #fff;
			border-radius: 5px;
		}
		#chat-footer {
			padding: 10px;
		}
		#toggle_chat_btn {
			position: fixed;
			bottom: 100px;
			right: 20px;
			background-color: #0253a7;
			color: #fff;
			border: none;
			border-radius: 50%;
			padding: 10px;
			cursor: pointer;
			width: 40px;
			height: 40px;
			display: flex;
			justify-content: center;
			align-items: center;
			z-index: 9;
		}
		#toggle_chat_btn svg{
			width: 28px;
			height: 35px !important;
		}
		#chat_body::-webkit-scrollbar-track {
			background-color: #f0f0f0;
			right: 0;
		}
		.error{
			color: red;
		}
	</style>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
	<button id="toggle_chat_btn"><i id="toggle-icon" class="fa-solid fa-comment-sms"></i></button>
	<div id="chat_box">
		<div id="chat_header">
			<span>
				We are live and ready to PRIVATELY chat with you now. Please Tell us the Hardship Details*
			</span>
		</div>
		<div id="chat_body">
			<form id="custom_support_chat_form" method="post">
				<div class="form-group">
					<input type="text" name="property_address" class="form-control form-control-sm" placeholder="Property Address" required="required">
				</div>
				<div class="form-group">
					<input type="text" name="full_name" class="form-control form-control-sm" placeholder="Full Name">
				</div>
				<div class="form-group">
					<input type="email" name="email" class="form-control form-control-sm" placeholder="Email">
				</div>
				<div class="form-group">
					<input type="tel" name="phone_no" class="form-control form-control-sm" placeholder="Mobile Number">
				</div>
				<div class="form-group">
					<input type="text" name="due_amount" class="form-control form-control-sm" placeholder="Amount Past Due">
				</div>
				<div class="form-group">
					<input type="text" name="monthly_payment" class="form-control form-control-sm" placeholder="Monthly Payment">
				</div>
				<div class="form-group">
					<input type="text" name="private_cell_no" class="form-control form-control-sm" placeholder="Private Call">
				</div>
				<div class="form-group">
					<input type="datetime-local" name="create_datetime" class="form-control form-control-sm">
				</div>
				<div class="form-group">
					<input type="text" name="interest_rate" class="form-control form-control-sm" placeholder="Interest Rate">
				</div>
				<div class="form-group">
					<textarea name="details" class="form-control form-control-sm" rows="3" placeholder="Hardship Details"></textarea>
				</div>
				<button type="button" class="btn btn-primary w-100" id="btn_send"><i class="fa-solid fa-paper-plane"></i> Submit</button>
				<br />
				<br />
				<div class="alert alert-success" id="success_message" role="alert" style="display: none;"></div>
				<div class="alert alert-danger" id="error_message" role="alert" style="display: none;"></div>
			</form>
		</div>
	</div>
	<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/js/all.min.js"></script>
	<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
	<script>
		$(document).ready(function () {
			$(document).on("click","#toggle_chat_btn",function() {
				$("#chat_box").slideToggle();
				var icon = $("#toggle-icon");
				icon.toggleClass("fa-comment-sms");
				icon.toggleClass("fa-xmark");
			});
		});
		$(document).ready(function() {
			$("#custom_support_chat_form").validate({
				rules: {
					full_name: {
						required: true
					},
					email: {
						required: true,
						email: true
					},
					phone_no: {
						required: true
					},
					due_amount: {
						required: true
					},
					monthly_payment: {
						required: true
					},
					private_cell_no: {
						required: true
					},
					create_datetime: {
						required: true
					},
					interest_rate: {
						required: true
					},
					details: {
						required: true
					}
				},
				messages: {
					full_name: {
						required: 'Please enter your full name.'
					},
					email: {
						required: 'Please enter your email address.',
						email: 'Please enter a valid email address.'
					},
					phone_no: {
						required: 'Please enter your phone no.',
					},
					due_amount: {
						required: 'Please enter your previous due amount.',
					},
					monthly_payment: {
						required: 'Please enter your monthly payment.',
					},
					private_cell_no: {
						required: 'Please enter your private cell no.',
					},
					create_datetime: {
						required: 'Please enter date and time.',
					},
					interest_rate: {
						required: 'Please enter interest rate.',
					},
					details: {
						required: 'Please enter your hardship details.',
					}
				},
				debug: true,
				errorPlacement: function(error, element) {
					error.insertAfter(element);
					// error.insertBefore(element);
				},
				highlight: function(element) {
					$(element).addClass('error');
				},
				unhighlight: function(element) {
					$(element).removeClass('error');
				}
			});
			$(document).on("click","#btn_send",function() {
				if($("#custom_support_chat_form").valid()) {
					var btn = $("#btn_send");
					var formData = $("#custom_support_chat_form").serialize();
					btn.addClass('disabled').attr('disabled', 'true');
					$.ajax({
						url: ajaxurl,
						type: 'POST',
						dataType: 'json',
						data: {
							'action': 'support_chat_contect',
							'data': formData
						},
						success: function(status) {
							btn.removeClass('disabled').removeAttr('disabled');
							if (status.msg == "success") {
								$('#custom_support_chat_form')[0].reset();
								$("#error_message").hide();
								$("#success_message").text("Form successfully submitted.").show();
							} else {
								$("#success_message").hide();
								$("#error_message").text("Something went wrong please try again later.").show();
							}
						}
					});
				}
			});
		});
		$(document).click(function (event) {
			if (!$(event.target).closest('#chat_box, #toggle_chat_btn').length) {
				$("#chat_box").slideUp();
				$("#toggle-icon").removeClass("fa-xmark").addClass("fa-comment-sms");
			}
		});
	</script>
	<?php
	$form_content = ob_get_clean();
	ob_end_flush();
	return $form_content;
}
add_shortcode( 'custom_support_chat', 'custom_chat_form' );