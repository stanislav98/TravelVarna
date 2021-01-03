@include('header')
@include('breadcrumbs',['title' => 'Докладване на нередност'])
<?php 
	use Illuminate\Support\Facades\Auth; 

	$site_info = DB::table('site_info')->get()->first();
	$penalties = DB::table('penalties')->get();
	$user = Auth::user();
?>

<section class="dokladvane">
	<p class="mtb-20">На основание чл. 111,ал. 4 от Административнопроцесуалнатия кодекс,анонимни сигнали не се разглеждат</p>
	<div class="wrapper">
		<?php
		echo Form::open(array('class'=>'report','action' => 'App\Http\Controllers\ReportController@report','files'=>'true'));
	  	?>
	
		<?php if (!Auth::check() && empty($user)) {  ?>
			<!-- user prompt data -->
			<?php if(!empty($user)) { ?>
				  <input type="hidden" name="user_id" value="<?php echo $user->id; ?>">
			<?php } else  { ?>
			      <input type="hidden" name="user_id" value="0">
			<?php } ?>
		      <div class="grid gap-10 grid-3">
				<div class="input_hold">
					<?php echo Form::text('user_name','',array('class' => 'w-100')); ?>
					 <span class="floating-label">Лице за контакт*</span>
				</div>
				<div class="input_hold">
					<?php echo Form::text('phone','',array('class' => 'w-100')); ?>
					 <span class="floating-label">Телефон*</span>
				</div>
				<div class="input_hold">
					<?php echo Form::text('email','',array('class' => 'w-100')); ?>
      				 <span class="floating-label">Имейл*</span>
				</div>
			</div>
		<?php } else { 
			$user = Auth::user();
			?>
			<!-- hidden fields data -->
			<input type="hidden" name="user_id" value="{{ $user->id }}">
			<input type="hidden" name="user_name" value="{{ $user->name }}">
			<input type="hidden" name="phone" value="{{ $user->phone }}">
			<input type="hidden" name="email" value="{{ $user->email }}">

		<?php } ?>
			<div class="mtb-20 min-150">
				<div class="input_hold">
					<select name="penalty_id" id="penalty_id" class="w-100">
						@foreach($penalties as $penalty)
						<option value="{{ $penalty->penalty_id }}">{{ $penalty->type_penalty }}</option>
						@endforeach
					</select>
					<span class="floating-label">Вид нарушение*</span>
				</div>
			</div>
			<div class="input_hold textarea_hold mtb-20">
				<textarea name="violation" id="dokladvane_message" class="w-100"></textarea>
				<span class="floating-label">Въведете вашето съобщение*</span>
			</div>

			<?php  echo Form::file('violation_image_path'); ?>
			<div class="form-group mtb-10">
		          {!! NoCaptcha::renderJs() !!}
		          {!! NoCaptcha::display() !!}
		          @error('g-recaptcha-response')
		              <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
		          @enderror
		      </div>
			<input type="submit" name="Изпрати" class="main_btn">

			<?php echo Form::close(); ?>
		<ul class="info_contacts">
			<li class="flex align-center"><span class="material-icons">home</span>{{ $site_info->firm_name }}</li>
			<li class="flex align-center"><span class="material-icons">location_on</span>Адрес<a href="https://goo.gl/maps/TmhSPvpQ3QqsDwv46" target="_blank">{{ $site_info->address }}</a></li>
			<li class="flex align-center"><span class="material-icons">call</span>Тел<a href="tel:{{ $site_info->site_phone }}">{{ $site_info->site_phone }}</a></li>
			<li class="flex align-center"><span class="gps">GPS</span><span> {{ $site_info->gps }}</span></li>
			<li class="flex align-center"><span class="material-icons">email</span>Имейл<a href="mailto:{{ $site_info->station_email }}">{{ $site_info->station_email }}</a></li>
			<li class="flex align-center"><span class="material-icons">gps_fixed</span>GPS<span>{{ $site_info->gps_coords }}</span></li>
			<li class="flex align-center"><span class="material-icons">home</span>{{ $site_info->info_name }}</li>
			<li class="flex align-center"><span class="material-icons">call</span>Тел<a href="tel:{{ $site_info->info_phone }}">{{ $site_info->info_phone }}</a></li>
			<li class="flex align-center"><span class="material-icons">email</span>Имейл<a href="mailto:{{ $site_info->info_email }}">{{ $site_info->info_email }}</a></li>
		</ul>
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