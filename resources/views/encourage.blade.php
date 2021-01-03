@include('header')
@include('breadcrumbs',['title' => 'Поощри служител'])
<?php
	$users = DB::table('users')->where('type_id',9)->get();
?>
<section class="pooshtri m-20">
 	<?php
		echo Form::open(array('class'=>'encourage','action' => 'App\Http\Controllers\AjaxController@encourage'));
  	?>
		<div class="grid gap-10 grid-4">
                <div class="input_hold w-100">
					<select name="user_encourage" id="user_encourage" class="w-100">
						<?php foreach($users as $k => $user) { ?>
							<option value="{{ $user->id }}">{{ $user->name }}</option>
						<?php } ?>
					</select>
					<span class="floating-label">Служител*</span>
				</div>
			<div class="stars">
				<span class="material-icons" data-id="10">star</span>
				<span class="material-icons" data-id="9">star</span>
				<span class="material-icons" data-id="8">star</span>
				<span class="material-icons" data-id="7">star</span>
				<span class="material-icons" data-id="6">star</span>
				<span class="material-icons" data-id="5">star</span>
				<span class="material-icons" data-id="4">star</span>
				<span class="material-icons" data-id="3">star</span>
				<span class="material-icons" data-id="2">star</span>
				<span class="material-icons" data-id="1">star</span>
			</div>
		</div>
		<div class="grid gap-10 grid-2">
			<div class="input_hold textarea_hold mtb-20">
				<textarea name="pooshtri_message" id="pooshtri_message" class="w-100"></textarea>
				<span class="floating-label">Въведете вашето съобщение*</span>
			</div>
			<div class="flex flex-start align-end mtb-20">
				<button type="submit" class="mat_btn">Изпрати</button>
			</div>
		</div>
	<?php echo Form::close(); ?>
</section>
<section class="ranking m-20">
	<h2 class="mtb-20">Временно класиране</h2>
	<div class="grid gap-30 grid-3">
		<?php 
		function group_assoc($array, $key) {
		    $return = array();
		    foreach($array as $v) {
		        $return[$v->$key][] = $v;
		    }
		    return $return;
		}

		//Group the requests by their account_id
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
			$top_sums =   array_slice($sums, -3, 3, true);
			$value = session()->get('voted', 'default');
			foreach($top_sums as $k => $v) { 
				$user = DB::table('users')->where('id',$v['id'])->get()->first();
				// trace($user);
				$user_type = DB::table('employee_types')->where('id',$user->employee_type)->get()->first();
				
		?>
				<div class="employee grid grid-2 gap-30">
					<?php if($user->profile_photo_path) { ?>
					<img src="{{ $user->profile_photo_path }}" alt="">
					<?php } else { ?>
					<img src="https://images.unsplash.com/photo-1560250097-0b93528c311a?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=334&q=80" alt="">
					<?php } ?>
					<div class="info">
						<p>{{ $user->name }} </p>
						<p>{{ $user_type->employee_type }}</p>
						<p>Рейтинг {{ $v['total_rating'] }}</p>
						<p>Гласове {{ $v['votes'] }}</p>
					</div>
				</div>
		<?php } ?>
	</div>
</section>


<div class="modal sucess_response d-none">
	<div class="modal_sucess">
		<div class="modal_header">
			<div class="icon_box">
				<span class="material-icons">done</span>
			</div>
			<h4 class="modal_title"></h4>
		</div>
		<div class="modal_body"></div>
		<div class="modal_footer">
			<a href="#" id="confirm_send">OK</a>
		</div>
	</div>
</div>


@include('footer')