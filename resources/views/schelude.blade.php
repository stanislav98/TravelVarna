@include('header')
@include('breadcrumbs',['title' => 'Разписание'])
<?php

  if($_GET['path'] != 'forward' && $_GET['path'] != 'backward' || $_GET['bus'] != '31' && $_GET['bus'] != '148') {
  ?>
      <script>
       window.location.href = 'https://travelvarna.obufki.eu/';
    </script>
  <?php
  } else {
    $path = $_GET['path'];
    $bus = $_GET['bus'];
  }

  if($bus == 148) {
    $current_bus = 1;
  } else {
    $current_bus = 2;
  }
  if($path == 'forward') {
    $position = 'scheludes';
    $oposite_path = 'backward';
  } else {
    $position = 'scheludes_back';
     $oposite_path = 'forward';
  }

  $direction = '';
  if($current_bus == 1 && $path == 'forward') {
    $first_stop = 1;
    $direction = 31;
  } else if($current_bus == 1 && $path == 'backward') {
    $first_stop = 31;
    $direction = 1;
  } else if($current_bus == 2 && $path == 'forward') {
    $first_stop = 32;
    $direction = 81;
  } else if($current_bus == 2 && $path == 'backward') {
    $first_stop = 81;
    $direction = 32;
  }
  $direction_name = DB::table('stops')->where('stop_id',$direction)->get()->first();
  $first_stop = 31; 
  $stops = DB::table($position)->select('stop_id')->where('bus_id',$current_bus)->distinct()->get();
   $stopping_hours = DB::table($position)->select('stop_id','bus_id','hour')->where('stop_id',$first_stop)->get();



?>
<section class="filter_info">
	<div class="filter ptb-20 grid">
		<div class="left">
			<div class="buses flex align-center">
				<span class="pr-20">Поддържани линии</span>
        <?php $buses = DB::table('buses')->get(); ?>
				<ul class="bus_numbers flex">
          <?php foreach($buses as $k => $v) { 
            $class = ($v->bus_number == $bus) ? 'main_btn' : 'second_btn';
            ?>
					<li ><a href="https://travelvarna.obufki.eu/scheludes?path={{$path}}&bus={{$v->bus_number}}" class="{{$class}}">{{$v->bus_number}}</a></li>
          <?php } ?>
				</ul>
			</div>	
			<p class="mtb-20">Следващ курс тръгва в : <span class="depart_at">11:30</span></p>
		</div>
		<div class="right">
			<form action="" autocomplete="off" method="POST" id="search_buses" class="flex">
         <input name="csrfToken" value="{{ Session::token() }}" type="hidden">    
          <div class="autocomplete" style="width:300px;">
				    <input type="text" name="bus_number" id="bus_number">
          </div>
				<button type="submit">Търси</button>
				<span class="material-icons">search</span>
			</form>
			<div class="flex flex-between align-center mtb-20">
				<div class="mat_btn map flex flex-between alig-center"><span class="material-icons">location_on</span>Карта</div>
				<div class="directions flex alig-center">
					 <a href="https://travelvarna.obufki.eu/scheludes?path={{$oposite_path}}&bus={{$bus}}" class="main_btn flex align-center direction_path">
            <span>Посока {{$direction_name->stop_name}}</span>
				    <span class="material-icons button_direction">sync_alt</span>
            </a>
				</div>
			</div>
		</div>

	</div>
</section>

<!-- Таблица разписание -->

<div class="container lg"><div class="grid-container">
  <div class="grid-fixed-table">
    <div class="grid-col grid-col--fixed-left">
  		<div class="grid-item grid-item--header" data-id="">
  	   	<p class="station_title">Спирка</p>
  		</div>
        <?php foreach($stops as $k => $v) {
          if($k==0) {
            $main_stop_id = $v;
          }
          $name = DB::table('stops')->select('stop_name','stop_id')->where('stop_id',$v->stop_id)->get()->first();
         ?>
      		<div class="grid-item" data-id="{{$name->stop_id}}" data-name="{{$name->stop_name}}">
      		  <p><?php echo $name->stop_name?></p>
      		</div>
        <?php } ?>
    </div>
    <?php 
    $count = count($stops);
    foreach($stopping_hours as $k => $v) { 
      ?>
        <div class="grid-col">
         <?php foreach($stops as $kk => $vv) { 
           $first_col = DB::table($position)->select('hour')->where(['stop_id' => $vv->stop_id,'bus_id'=>$current_bus])->skip($k)->take(1)->orderByRaw('hour')->get()->first();
             $class = ($kk  == 0) ? 'grid-item--header' : '';
          ?>
          <?php if(!empty($class)) { ?>
          <div class="grid-item {{$class}} data-id="{{$vv->stop_id}}">
            <p>{{$first_col->hour}}</p>
          </div>
          <div class="grid-item" data-id="{{$vv->stop_id}}">
            <p>{{$first_col->hour}}</p>
          </div>
        <?php } else { ?>
          <div class="grid-item {{$class}}" data-id="{{$vv->stop_id}}">
            <p>{{$first_col->hour}}</p>
          </div>
        <?php } ?>
        <?php } ?>

        </div>
      <?php } ?>
  </div>
  </div>
</div>
@include('footer')

