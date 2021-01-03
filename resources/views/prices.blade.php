@include('header')
@include('breadcrumbs',['title' => 'Цени'])

<h2 class="m-20">Стандартни цени</h2>
<div class="container lg">
	<div class="grid-container">
	  	<div class="grid-fixed-table pricing_table">
		    <div class="grid-col grid-col--fixed-left">
		  		<div class="grid-item grid-item--header" data-id="">
		  	   	<p class="station_title">Район</p>
		  		</div>
		  		<div class="grid-item">1 месец/1 линия</div>
			</div>
		    <div class="grid-col">
	    	 	<div class="grid-item grid-item--header"><p>Тополи</p></div>
				<div class="grid-item"><p>48.00лв.</p></div>
	    	 </div>
	    	 <div class="grid-col">
				<div class="grid-item grid-item--header"><p>Звездица</p></div>
				<div class="grid-item"><p>52.00лв.</p></div>
			</div>
			 <div class="grid-col">
				<div class="grid-item grid-item--header"><p>Каменар</p></div>
				<div class="grid-item"><p>52.00лв.</p></div>
			</div>
			 <div class="grid-col">
				<div class="grid-item grid-item--header"><p>Казашко</p></div>
				<div class="grid-item"><p>56.00лв.</p></div>
			</div>
			 <div class="grid-col">
				<div class="grid-item grid-item--header"><p>Константиново</p></div>
<div class="grid-item"><p>64.00лв.</p></div>
			</div>
			 <div class="grid-col">
				<div class="grid-item grid-item--header"><p>Аладжа м-р</p></div>
<div class="grid-item"><p>80.00лв.</p></div>
			</div>
			 <div class="grid-col">
				<div class="grid-item grid-item--header"><p>Зл.пясъци</p></div>
<div class="grid-item"><p>120.00лв.</p></div>
			</div>
		    </div>
		</div>
	</div>
</div>

			




<section class="calculator">
	<h2 class="m-20">Калкулатор</h2>
	<form action="#" method="POST" class="m-20 grid align-center">
		<div class="mtb-20 min-150">
		<div class="input_hold">
				<input type="number" name="age" required class="w-100"  onkeydown="javascript: return event.keyCode == 69 ? false : true" min="0" max="100">
				 <span class="floating-label">Възраст*</span>
			</div>
		</div>
		<div class="mtb-20 min-150">
			<div class="input_hold">
				<select name="sfera_activity" id="" class="w-100">
					<option value="Учащ">Учащ</option>
					<option value="Пенсионер">Пенсионер</option>
					<option value="Служител на партньори">Служител на партньори</option>
				</select>
				<span class="floating-label">Сфера на дейност*</span>
			</div>
		</div>
		<div class="mtb-20 min-150 partners_select d-none">
			<div class="input_hold">
				<select name="partners_calc" id="" class="w-100">
					<option value="Технически университет">Технически университет</option>
					<option value="Община Варна">Община Варна</option>
					<option value="Други">Други</option>
				</select>
				<span class="floating-label">Партньори*</span>
			</div>
		</div>
	    <input type="submit" value="Изчисли" class="second_btn" id="submit_calc">
	</form>
	<p class="m-20 price_calced">Преференциална цена в лв : <span>40лв.</span></p>
</section>


@include('footer')