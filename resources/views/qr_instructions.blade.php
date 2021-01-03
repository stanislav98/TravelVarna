@include('header')
@include('breadcrumbs',['title' => 'QR Код'])
<?php
use Illuminate\Support\Facades\Auth;
$user = Auth::user();
$type =  DB::table('user_types')->where('type_id',$user->type_id)->get();
?>
<section class="qr_code m-20">
	<div class="container">
		<div class="grid grid-2 gap-30">
			<div class="left">
				<?php if($user->qr_active == NULL || empty($user->qr_active)) { ?>
					<img src="https://png.pngtree.com/png-clipart/20190604/original/pngtree-qr-code-png-image_1014079.jpg" alt="">
				<?php } else { ?>
					<img src="{{ $user->qrcode_path }}" alt="">
				<?php } ?>
				<div class="content">
					<p>Инстукции : </p>
					<p>QR кода се използва за валидиране на абонамента от контуктура/контрольора</p>
					<p>Моля покажете го за сканиране при постъпване в превозните средства на градския транспорт</p>
					<p>Изпратете SMS на номер +1 848-278-6204 с текст QR_ACTIVATE за да получите вашият код!</p>
					<p>Благодарим за разбирането !</p>
				</div>
			</div>
			<div class="right">
				<?php if ($user->profile_photo_path == NULL || empty($user->profile_photo_path)) { ?>
				<img src="https://reputationtoday.in/wp-content/uploads/2019/11/110-1102775_download-empty-profile-hd-png-download.jpg" alt="Profile image">
				<?php } else { ?>
				<img src="{{ $user->profile_photo_path }}" alt="Profile image">
				<?php } ?>
				<ul class="person_info">
					<li>Име : <span>{{ $user->name }}</span></li>
					<li>Дейност : <span>{{ $type[0]->type }}</span></li>
					<li>Учебно заведение : <span>ТУ-Варна</span></li>
					<?php if($user->active_profile == 1) {
						$status = 'Потвърден';
				    } else { $status = 'Непотвърден'; } ?>
					<li>Статус : <span>{{ $status }}</span></li>
					<?php if($user->subscription_type == NULL || empty($user->subscription_type)) {
						$subscription = 'Няма';
					} else {
						$subscription = DB::table('table_abonaments')->where('abonament_id',$user->subscription_type)->get()[0]->type_abonament;
					} ?>
					<li>Абонамент : <span>{{ $subscription }}</span></li>
				</ul>
			</div>

		</div>
	</div>
</section>


@include('footer')