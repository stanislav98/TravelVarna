@include('header')
@include('breadcrumbs',['title' => 'Блог'])
<?php
$posts = DB::table('posts')->orderBy('id', 'desc')->simplePaginate(2); 
?>
<section class="blog">
	<div class="container">
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
		<div class="pagination">
			<?php echo $posts->render(); ?>
		</div>
	</div>	
</section>
@include('footer')