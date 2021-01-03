@include('header')
<?php
use Illuminate\Support\Facades\Auth; 
$posts = DB::table('posts')->orderBy('id', 'desc')->take(3)->get(); 
	function group_assoc($array, $key) {
		    $return = array();
		    foreach($array as $v) {
		        $return[$v->$key][] = $v;
		    }
		    return $return;
		}



	$employees = DB::table('all_ratings')->get();
			$account_requests = group_assoc($employees, 'user_id');
			$sums = array();
			foreach($account_requests as $k => $v) {
					$sums[$k] = array();
					$sums[$k]['rating'] = 0;
					$sums[$k]['id'] = $k;
					$sums[$k]['votes'] = 0;
				foreach($v as $kk => $vv) {
					$sums[$k]['votes'] += 1;
					$sums[$k]['rating'] += $vv->rating;
				}
			}

			foreach($sums as $k => $v) {
				$sums[$k]['total_rating'] = round($v['rating']/$v['votes'],2);
			}

			
			function cmp($a, $b)
			{
			    if ($a["total_rating"] == $b["total_rating"]) {
			        return 0;
			    }
			    return ($a["total_rating"] < $b["total_rating"]) ? -1 : 1;
			}
			usort($sums,'cmp');
			$top_sums = array_slice($sums, -1, 1, true);
			foreach($top_sums as $k => $v) {
				$top_sums = $v;
			}
			$top_employee = DB::table('users')->where('id',$top_sums['id'])->get()->first();

?>
<section class="home">
	<div class="grid grid-2">
		<div class="wrap_img flex">
			<img src="https://images.unsplash.com/photo-1520105072000-f44fc083e508?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1189&q=80" alt="">
			<?php if(Auth::check() && Auth::user()->type_id != 7) { ?><a href="#" class="main_btn buy_ticket">Купи билет</a><?php } ?>
		</div>
		<div class="news">
			<h2 class="text-center">Новини</h2>
			<?php foreach($posts as $k => $v) { ?>
			<article class="card ptb-10 mlr-20 plr-20">
				<a href="{{ URL::to('/posts/'.$v->slug)}}"><h4>{{ $v->title }}</h4></a>
				<div class="article_info flex align-center">
					<span class="material-icons">account_circle</span>
					<span class="author">Станислав Стойчев</span>
					<span class="material-icons">calendar_today</span>
					<span class="date">{{$v->created_at}}</span>
				</div>
				<div class="btn_holder flex flex-end">
					<a href="{{ URL::to('/posts/'.$v->slug)}}" class="mat_btn">Повече</a>
				</div>
			</article>
			<?php } ?>
			<div class="flex flex-center ptb-20">
				<a href="{{ URL::to('/blog')}}" class="second_btn">Виж всички</a>
			</div>
		</div>		
	</div>
</section>

<section class="month_employee ptb-50">
	<div class="container grid grid-3 gap-50">
		<div class="certificates">
			<p class="mtb-10">Отличия и сертификати</p>
			<div class="certificates_holder grid grid-4 gap-10">
				<img src="https://previews.123rf.com/images/petrnutil/petrnutil1606/petrnutil160600211/58367987-employee-of-the-month-label.jpg" alt="">
				<img src="https://previews.123rf.com/images/petrnutil/petrnutil1606/petrnutil160600211/58367987-employee-of-the-month-label.jpg" alt="">
				<img src="https://previews.123rf.com/images/petrnutil/petrnutil1606/petrnutil160600211/58367987-employee-of-the-month-label.jpg" alt="">
				<img src="https://previews.123rf.com/images/petrnutil/petrnutil1606/petrnutil160600211/58367987-employee-of-the-month-label.jpg" alt="">
			</div>
		</div>
		<div class="employee grid grid-2 gap-10">
					<img src="<?php echo $top_employee->profile_photo_path; ?>" alt="">
			<div class="info plr-20">
				<h5 class="mtb-10">Служител на месеца</h4>
				<span><?php echo  $top_employee->name; ?></span>
			</div>
		</div>
		<ul class="links flex flex-column align-end flex-center">
			<li><a href="{{ URL::to('/rules') }}">Правила и задължения</a></li>
			<li><a href="{{ URL::to('/fines') }}">Глоби и санкции</a></li>
			<li><a href="{{ URL::to('/report') }}">Докладване за нередност</a></li>
			<li><a href="{{ URL::to('/encourage') }}">Поощри служител</a></li>
		</ul>
		
	</div>
</section>

<div class="modal d-none flex flex-center align-center" id="qr_modal">
	<div class="modal_form">
		<h4>Купуване на билет</h4>
		<p>Изпратете SMS на номер +1 848-278-6204</p>
		<p>с текст QR_ACTIVATE за да получите вашият код!</p>
		<p>След изпращането системата ще ви усведоми когато QR кодът ви е активиран.</p>
		<p>За да го използвате влезте в акаунта си и отидете на страница QR код.</p>
		<p>Кодът ви ще е активен веднага след получаването на СМС.Приятно пътуване!</p>
		<div class="btn_holder flex flex-end">
			<a href="#" id="close_modal" class="main_btn">Готово</a>
		</div>	
	</div>
</div>

@include('footer')