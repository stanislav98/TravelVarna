@include('header')
<?php
$post = DB::table('posts')->where('slug',$slug)->get()->first();
if(empty($post)) {
	  ?>
       	<script>
			 window.location.href = 'https://travelvarna.obufki.eu/';
		</script>
       <?php
	} else {
?>
@include('breadcrumbs',['title' => $post->title])
<section class="single_post mtb-20">
	<div class="container">
		<article>
			<h2>{{$post->title}}</h2>
			<div class="article_info flex align-center">
				<span class="material-icons">account_circle</span>
				<span class="author">Станислав Стойчев</span>
				<span class="material-icons">calendar_today</span>
				<span class="date">{{$post->created_at}}</span>
			</div>
			<div class="content">
				{{$post->content}}
			</div>
		</article>
	</div>
</section>		
@include('footer')
<?php } ?>