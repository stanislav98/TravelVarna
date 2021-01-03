<div class="breadcrumbs">
	<div class="container">
		<div class="flex flex-between ptb-20">
			<h1>{{ isset($title) ? $title : 'title'}}</h1>
			<div class="breadcrumbs_list">
				<a href="{{ URL::to('/') }}">Начало</a>
				<span class="del">/</span>
				<span class="current">{{ isset($title) ? $title : 'title'}}</span>
			</div>
		</div>
	</div>
</div>
