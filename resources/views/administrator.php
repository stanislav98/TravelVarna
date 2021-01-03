<?php
use Illuminate\Support\Facades\Auth; 
    $user = Auth::user();
	if($user->type_id != 9 ) {
       ?>
       	<script>
			 window.location.href = 'https://travelvarna.obufki.eu/';
		</script>
       <?php
    }
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
<body>
	<section class="administrator">
		<div class="grid">
			<div class="left">
				
			</div>
			<div class="right">
				
			</div>
		</div>
	</section>
</body>

<div class="copyright grid grid-3 gap-10 ptb-10 plr-10 align-center">
	<p></p>
	<p class="text-center">Copyright 2020</p>
	<p class="text-end">Author Станислав/Радостин/Илиян</p>
</div>

<script type="text/javascript" src="{{ asset('js/main.js') }}"></script>

</body>

</html>
