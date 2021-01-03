<?php use Illuminate\Support\Facades\Auth; 

function trace($data) {
	echo "<pre>";
	print_r($data);
	echo "</pre>";
}

	
	
// use Spatie\Sitemap\SitemapGenerator;

// SitemapGenerator::create('https://travelvarna.obufki.eu/')->writeToFile(public_path('sitemap.xml'));

 $site_info = DB::table('site_info')->select(['site_email','site_phone'])->get()->first();

?>
<!DOCTYPE html>
<html>
<head>
<title>Varna Transport | <?php echo isset($title) ? $title : 'title'; ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}">
<script src="https://cdnjs.cloudflare.com/ajax/libs/less.js/3.12.2/less.min.js" type="text/javascript"></script>
<link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,400;0,500;0,700;1,400&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>

</head>
<header>
	<div class="topbar">
			<a href="mailto:{{ $site_info->site_email }}">{{ $site_info->site_email }}</a>
			<a href="tel:{{ $site_info->site_phone }}">{{ $site_info->site_phone }}</a>
	</div>
	<?php if (!Auth::check()) { ?>
	<div class="navigation">
		<div class="container flex flex-between">
			<a href="{{ URL::to('/') }}" class="logo"><img src="../images/logo.png" alt=""></a>
			<ul class="menu flex">
				<li><a href="{{ URL::to('/') }}">Начало</a></li>
				<li><a href="{{ URL::to('/about') }}">За нас</a></li>
				<li><a href="{{ URL::to('/scheludes?path=forward&bus=148') }}">Разписание</a></li>
				<li><a href="{{ URL::to('/prices') }}">Цени</a></li>
				<li><a href="{{ URL::to('/contact') }}">Контакти</a></li>
				<li><a href="#" id="vhod">Вход</a></li>
			</ul>
      <div class="hamburger">
        <span></span>
        <span></span>
        <span></span>
      </div>
		</div>
	</div>
<?php }  else { 
  $user = Auth::user();
$type =  DB::table('user_types')->where('type_id',$user->type_id)->get();
  ?>
	<div class="navigation user_logged">
		<div class="container flex flex-between">
			<a href="{{ URL::to('/') }}" class="logo"><img src="../images/logo.png" alt=""></a>
			<?php if($user->type_id != 7){ ?>
				<ul class="menu flex">
					<li><a href="{{ URL::to('/subscriptions') }}">Абонаменти</a></li>
				  <?php if($user->type_id != 9) { ?>
					<li><a href="{{ URL::to('/history') }}">История на покупките</a></li>
					<?php } ?>
	        		<?php if($user->type_id == 9) { ?>
					  <li><a href="{{ URL::to('/duties') }}">Проверки и задължения</a></li>
	    			<?php } ?>
					<li><a href="{{ URL::to('/contact') }}">Контакти</a></li>
			        <ul class="mobile_second_menu">
			             <li><a href="{{ URL::to('/options') }}">Настройки</a></li>
			            <li><a href="{{ URL::to('/qr') }}">QR Код</a></li>
			            <li><a href="{{ URL::to('/exit') }}">Изход</a></li>
			        </ul>
				</ul>
		      <div class="second_menu">
		      	<?php if(!empty($user->profile_photo_path)) { 
		      		$url = url('/'.$user->profile_photo_path);
		      		?>
		        	<img src="{{ $url }}" alt="">
		        <?php } else { ?>
		        	<img src="https://www.xovi.com/wp-content/plugins/all-in-one-seo-pack/images/default-user-image.png" alt="">
		        <?php }?>
		        <span class="material-icons">more_vert</span>
		        <ul class="submenu">
		            <li><a href="{{ URL::to('/options') }}">Настройки</a></li>
		            <li><a href="{{ URL::to('/qr') }}">QR Код</a></li>
		            <li><a href="{{ URL::to('/exit') }}">Изход</a></li>
		        </ul>
		      </div>
		      <div class="hamburger">
		        <span></span>
		        <span></span>
		        <span></span>
		      </div>
		  <?php } else { ?>
		  	<ul class="menu flex">
					<li><a href="{{ URL::to('/admin-dashboard') }}">Администрация</a></li>
					 <li><a href="{{ URL::to('/exit') }}">Изход</a></li>
			</ul>
		  <?php } ?>
		</div>
	</div>
<?php } ?>
</header>