@include('header')
@include('breadcrumbs',['title' => 'Проверки и задължения'])
<?php
use Illuminate\Support\Facades\Auth; 
$user = Auth::user();
$penalties = DB::table('all_penalties')->where('penalty_for_user',$user->id)->get();
?>
<section class="history_buyed m-20">
	<div class="container">

		<?php 
		if(count($penalties) != 0) { 
		foreach($penalties as $k => $v) { 
			$penalty_type = DB::table('penalties')->where('penalty_id',$v->penalty_id)->get()->first();
		?>
		<div class="buyed_list list flex flex-between align-center">
			<p>Служител : {{ $user->name }}</p>
			<p>Дата: {{ $v->penalty_date }}</p>
			<p>Нарушение : {{ $penalty_type->type_penalty }}</p>
			<p>Глоба : {{ $v->amount }}лв. </p>
		</div>
		<?php } } else {  ?>
			<p>Нямате задължения</p>
		<?php } ?>
	</div>
</section>

@include('footer')