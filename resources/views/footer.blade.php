<?php 
use Illuminate\Support\Facades\Auth; 
if (!Auth::check()) { ?>
@include('auth/register')
@include('auth/login')
@include('auth/forgot-password')
<?php } ?>

<div class="copyright grid grid-3 gap-10 ptb-10 plr-10 align-center">
	<p></p>
	<p class="text-center">Copyright 2020</p>
	<p class="text-end">Author Станислав/Радостин/Илиян</p>
</div>

<script type="text/javascript" src="{{ asset('js/main.js') }}"></script>

</body>

</html>
