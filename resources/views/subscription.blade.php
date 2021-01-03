@include('header')
@include('breadcrumbs',['title' => 'Абонаменти'])
<?php
use Illuminate\Support\Facades\Auth; 
$user = Auth::user();
if($user->subscription == NULL || empty($user->subscription)) {
	$can_activate = 1;
} else {
	$can_activate = 0;
}
?>
<input type="hidden" name="can_activate" value="{{ $can_activate }}">
<input type="hidden" name="user_id" value="{{ $user->id }}">
 <input name="csrfToken" value="{{ Session::token() }}" type="hidden">    
<section class="abonaments m-20">
	<div class="container sm">
		<div class="wrapper_abonaments grid grid-3 gap-30">	
			<div class="abonament">
				<h4 class="text-center">Стандартен</h4>
				<p class="plr-10">1 линия</p>
				<p class="plr-10">1 месец</p>
				<?php if($user->subscription_type == 1 && $user->subscription == 1) { ?>
					<a href="#" class="flex w-100 activate_abonament active_abonament align-center flex-center" data-type="1">Активен</a>
				<?php } else { ?>
					<a href="#" class="flex w-100 activate_abonament align-center flex-center" data-type="1">Активирай</a>
				<?php } ?>
			</div>
			<div class="abonament">
				<h4 class="text-center">Работнически</h4>
				<p class="plr-10">Всички линии</p>
				<p class="plr-10">1 месец</p>
					<?php if($user->subscription_type == 2 && $user->subscription == 1) { ?>
					<a href="#" class="flex w-100 activate_abonament active_abonament align-center flex-center" data-type="2">Активен</a>
				<?php } else { ?>
					<a href="#" class="flex w-100 activate_abonament align-center flex-center" data-type="2">Активирай</a>
				<?php } ?>
			</div>
			<div class="abonament">
				<h4 class="text-center">Супер</h4>
				<p class="plr-10">Всички линии</p>
				<p class="plr-10">Място за багаж</p>
				<p class="plr-10">1 месец</p>
					<?php if($user->subscription_type == 3 && $user->subscription == 1) { ?>
					<a href="#" class="flex w-100 activate_abonament active_abonament align-center flex-center" data-type="3">Активен</a>
				<?php } else { ?>
					<a href="#" class="flex w-100 activate_abonament align-center flex-center" data-type="3">Активирай</a>
				<?php } ?>
			</div>
		</div>
	</div>		
</section>
<div class="modal sucess_response d-none">
	<div class="modal_sucess">
		<div class="modal_header">
			<div class="icon_box">
				<span class="material-icons">done</span>
			</div>
			<h4 class="modal_title"></h4>
		</div>
		<div class="modal_body"></div>
		<div class="modal_footer">
			<a href="#" id="confirm_send">OK</a>
		</div>
	</div>
</div>


@include('footer')