<?php
use Illuminate\Support\Facades\Auth; 
    $user = Auth::user();
	if(empty($user) || $user->type_id != 7 ) {
       ?>
       	<script>
			 window.location.href = 'https://travelvarna.obufki.eu/';
		</script>
       <?php
    }

    $penalty = DB::table('all_penalties')->where('penalty_active',0)->get();
    $posts = DB::table('posts')->get();
    $users = DB::table('users')->where('type_id',9)->get();
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
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.css" /> 
</head>
<body>
	<section class="administrator">
		 <input name="csrfToken" value="{{ Session::token() }}" type="hidden">    
		<div class="grid">
			<div class="left">
				<div class="logo_holder">
					<a href="{{ URL::to('/') }}" class="logo"><img src="../images/logo.png" alt=""></a>
				</div>
				<ul class="admin_links">
					<li class="active_link"><a href="#">Всичко</a></li>
					<li><a href="#">Публикации</a></li>
					<li><a href="#">Глоби и нарушения</a></li>
					<li><a href="#">Добавяне на публикация</a></li>
				</ul>
			</div>
			<div class="right">
				<div class="posts">
					<h4>Публикации</h4>
					<ul class="list_posts admin-table">
						<?php foreach($posts as $k => $v) { ?>
						<li data-id="{{ $v->id }}">
								<p class="post_title">{{$v->title}}</p>
								<p class="post_date">Добавено на : {{ $v->created_at }}</p>
								<p class="content">{{$v->content}}</p>
								<span class="material-icons remove_post" data-id="{{ $v->id }}">delete</span>
						</li>
						<?php } ?>
					</ul>
				</div>
				<div class="penalties">
					<h4>Нарушения</h4>
					<ul class="list_penalties admin-table">
						<?php foreach($penalty as $k => $v) { 
						$type = DB::table('penalties')->where('penalty_id',$v->penalty_id)->get()->first();
						?> <li data-id="{{ $v->id }}">
							<div class="left_side">
								<p>Нарушение : {{ $v->violation }}</p>
								<p>Докладвано от : {{ $v->user_name }} </p>
								<p>Телефонен номер : {{ $v->phone }} </p>
								<p>Имейл : {{ $v->email }} </p>
								<p>Вид на нарушението : {{ $type->type_penalty }} </p>
								<p>Цена : {{ $v->amount }} лв.</p>
								<p>Дата : {{ $v->penalty_date }}</p>
								<p class="icons_actions">
									<span class="material-icons remove_penalty" data-id="{{ $v->id }}">delete</span>
									<?php if($v->penalty_active != 1) { ?>
										<span class="material-icons accept_penalty" data-id="{{ $v->id }}">done</span>
									<?php } ?>
									<span>Изберете служител : </span>
									<select name="user_for_penalty" id="user_for_penalty">
										<?php foreach($users as $k => $user) { ?>
											<option value="{{ $user->id }}">{{ $user->name }}</option>
										<?php } ?>
									</select>
								</p>
							</div>
							<p class="img_holder">
								<span>Снимка : </span>
								<a data-fancybox="gallery" rel="gallery1" href="<?php echo asset('uploads/reports/'.$v->violation_image_path); ?>">
									<img src="<?php echo asset('uploads/reports/'.$v->violation_image_path); ?>" alt="img">
								</a>
							</p>
						</li>
						<?php } ?>
					</ul>
				</div>
				<div class="add_post">
					<h2>Добавяне на публикация</h2>
					<?php
						echo Form::open(array('class'=>'post_add','action' => 'App\Http\Controllers\AjaxController@addPosts'));
				  	?>
			  		<div class="input_hold mtb-20">
						<input type="text" name="post_title" id="post_title" class="w-100"></input>
						<span class="floating-label">Заглавие*</span>
					</div>
				  	<div class="input_hold textarea_hold mtb-20">
						<textarea name="content" id="content" class="w-100"></textarea>
						<span class="floating-label">Съдържание*</span>
					</div>
			  		<input type="submit" name="Добави" class="main_btn" value="Добави">
				  	<?php echo Form::close(); ?>
				</div>	
			</div>
		</div>
	</section>
</body>

<script type="text/javascript" src="{{ asset('js/main.js') }}"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js"></script>

</body>

</html>
