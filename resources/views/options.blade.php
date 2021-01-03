@include('header')
@include('breadcrumbs',['title' => 'Настройки'])
<?php 
	use Illuminate\Support\Facades\Auth; 
	$user = Auth::user();
	if($user->profile_photo_path != NULL) {
		$img_src = $user->profile_photo_path;
	}
?>
@if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
@endif

<section class="qr_code m-20">
	<div class="container">
		<div class="edit_info">
			<h2>Лични данни</h2>
			<?php
				echo Form::open(array('class'=>'options','action' => 'App\Http\Controllers\OptionsController@update','files'=>'true'));
		  	?>
		  	<div class="grid_custom">
		  		<div class="image">
		  			<?php if(!empty($img_src)) { ?>
		  				<img src="{{ $img_src }}" alt="">
		  			<?php } else { ?>
		  				<img src="https://sample-data.potenzaglobal.com/ciyashop/placeholder_960x700.jpg" alt="">
		  			<?php } ?>
		  			<?php  echo Form::file('change_image'); ?>
		  			<input type="hidden" name="user_id" value="{{ $user->id }}">
		  		</div>
		  		<div class="options_list">
		  			<div class="input_hold mtb-20 w-100 parent">
						<input type="name" name="change_name" required class="w-100" value="{{ $user->name }}">
						<span class="floating-label">Име*</span>
					</div>
					<div class="input_hold mtb-20 w-100 parent">
						<input type="name" name="change_phone" required class="w-100" value="{{ $user->phone }}">
						<span class="floating-label">Телефон*</span>
					</div>
					<div class="input_hold mtb-20 w-100 parent">
						<input type="name" name="change_email" required class="w-100" value="{{ $user->email }}">
						<span class="floating-label">Имейл*</span>
					</div>
		  		</div>
		  		<div class="edit_info_right flex flex-around align-center flex-column">
					<div class="account w-100 text-center">
						<h2 class="text-center">Акаунт</h2>
						<div class="mtb-20">
							<input type="checkbox" id="deactivate_acc" name="deactivate_acc" value="deactivate">
				 			<label for="deactivate_acc">Желая акаунта ми да бъде деактивиран</label><br>
			 			</div>
			 			<div class="mtb-20">
							<input type="checkbox" id="delete_acc" name="delete_acc" value="delete">
				 			<label for="delete_acc">Желая акаунта ми да бъде изтрит</label><br>
			 			</div>
					</div>
					<div class="messages w-100 text-center">
						<h2 class="text-center">Известия</h2>
			 			<?php if($user->type_id == 9) { 
			 				 ($user->notify_tickets == 1) ? $checked = 'checked' : $checked = ''; 
			 				?>
						<div class="mtb-20">
							<input type="checkbox" id="new_penalty" name="new_penalty" value="notify_penalty" {{ $checked }}>
				 			<label for="new_penalty">Желая да получавам известия за направени фишове</label><br>
			 			</div>
			 			<?php } ?>
			 			<?php ($user->notify_change_subscription == 1) ? $checked = 'checked' : $checked = ''; ?>
			 			<div class="mtb-20">
							<input type="checkbox" id="change_subscription" name="change_subscription" value="change" {{ $checked }}>
				 			<label for="change_subscription">Желая да получавам известия за промяна в абонамента си</label><br>
			 			</div>
					</div>
					<div class="save_data">
						<input type="submit" name="save" class="mat_btn" value="Запази">
					</div>
				</div>
		  	</div>
		  	<?php echo Form::close(); ?>
		  </div>
		</div>
	</section>



@include('footer')