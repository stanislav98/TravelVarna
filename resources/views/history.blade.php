@include('header')
@include('breadcrumbs',['title' => 'История на покупките'])
<?php
use Illuminate\Support\Facades\Auth; 
$user = Auth::user();
$types = DB::table('table_all_subscriptions')->where('user_id',$user->id)->get();
?>
<section class="history_buyed m-20">
	<div class="container">
		<?php 
		if(!$types->isEmpty()) {
			foreach($types as $k => $v ) {
				$type = DB::table('table_abonaments')->where('abonament_id',$v->subscription_id)->get()->first();
			 ?>
			<div class="buyed_list list flex flex-between align-center">
				<h4>{{ $type->type_abonament }}</h4>
				<p>Заплатен на : {{ $v->subscription_date }}</p>
				<p>Начин на плащане : Карта</p>
			</div>
			<?php } 
		} else { ?>
			<p>Нямате предишни абонаменти</p>
		<?php } ?>
	</div>
</section>

@include('footer')