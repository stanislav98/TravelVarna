<?php

	use Illuminate\Support\Facades\Auth; 

	$user = DB::table('users')->where('id',$profile_id)->get()->first();
	if($user) {
		if($user->active_profile == 0) {
			DB::table('users')->where('id',$profile_id)->update(['active_profile' => 1]);
			Auth::loginUsingId($user->id);
			 ?>
		<script>
			window.location.href="https://travelvarna.obufki.eu/subscriptions";
		</script>
<?php
		} else { ?>
		<script>
			window.location.href="https://travelvarna.obufki.eu/";
		</script>
<?php

		}
	} else { ?>
		<script>
			window.location.href="https://travelvarna.obufki.eu/";
		</script>
<?php	}