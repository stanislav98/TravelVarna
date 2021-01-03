@include('header')
@include('breadcrumbs',['title' => 'Контакти'])

<ul class="tabs grid">
	<li class="active_tab" data-id="contact">Изберете запитване</li>	
	<li  data-id="find_us">Къде можете да ни откриете</li>	
	<li data-id="reklama">Желаете да рекламирате</li>	
	<li data-id="punktove">Пунктове за карти</li>	
	<li data-id="qa">Често задавани въпроси</li>	
</ul>

<section class="contact_page">
	<div class="container sm active_container" data-id="contact" >
		<div class="mtb-20">
			<h4 class="text-center">При възниканли въпроси</h4>
			<p class="text-center">Свържете се с нас нашият екип ще се радва да ви отговори.На основание чл. 111,ал. 4 от Административнопроцесуалнатия кодекс,
			анонимни сигнали не се разглеждат</p>
		</div>
		<?php
		echo Form::open(array('id'=>'contact_form','action' => 'App\Http\Controllers\AjaxController@contact'));
	  	?>
		<form action="#" method="POST" id="contact_form">
			<div class="grid gap-10 grid-2 mtb-20">
				<div class="input_hold">
					<input type="text" name="username" required class="w-100">
					<span class="floating-label">Лице за контакт*</span>
				</div>
				<div class="input_hold">
					<input type="text" name="phone" required class="w-100">
					<span class="floating-label">Телефон*</span>
				</div>
			</div>
				<div class="input_hold">
					<input type="text" name="email" required class="w-100">
					<span class="floating-label">Имейл*</span>
				</div>
				<div class="input_hold textarea_hold mtb-20">
					<textarea name="message" id="message" class="w-100"></textarea>
					<span class="floating-label">Въведете вашето съобщение*</span>
				</div>
				<div class="form-group mtb-10">
		          {!! NoCaptcha::renderJs() !!}
		          {!! NoCaptcha::display() !!}
		          @error('g-recaptcha-response')
		              <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
		          @enderror
		      </div>
			<input type="submit" value="Изпрати" class="mat_btn">
		<?php echo Form::close(); ?>
	</div>
</section>

<section class="contact_page">
	<div class="container" data-id="find_us">
		<iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d11629.330081473217!2d27.9350696!3d43.2234875!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xbb9c00bf3e90d5d1!2z0KLQtdGF0L3QuNGH0LXRgdC60Lgg0YPQvdC40LLQtdGA0YHQuNGC0LXRgiAtINCS0LDRgNC90LA!5e0!3m2!1sbg!2sbg!4v1601807347390!5m2!1sbg!2sbg" width="100%" height="450" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
	</div>
</section>

<section class="contact_page">
	<div class="container" data-id="reklama">
		<div class="content">
			<p>„Градски транспорт” ЕАД предоставя място за Вашата реклама в и върху превозните средства!Поставете своите рекламно информационни пана на тролейбусните стълбове!Възможност за наемане според необходимия Ви срок, формиране на цени на база 1 кв. м. Атрактивни цени, отстъпки, договорени срокове на плащане.</p>
			<p>Предмета  на дейност на дружеството са автобусни превози, градски тролейбусни превози и свързаните с това дейности като комисионерство, посредничество, представителство, сервизно автомобилно обслужване. Градски транспорт ЕООД е образувано на основата на съответната част от имуществото и дейността на фирма „Варна Автотранспорт” - гр. Варна със съответната част от активите и пасивите по баланса към 15.10.1991 г както и от имуществото и дейността на АС „Пътнически автобусни и тролейбусни превози” -гр. Варна като приема активите, пасивите и други права и задължения, съгласно разделителния протокол.
	         С решение от 07.05.1992 г. по ф.д. № 742/1992 г. на ВОС вписва в търговския регистър Градски Транспорт ЕООД. На 16.03.1999 г е издаден Акт за общинска частна собственост № 1018 за гаражна площадка на „Градски транспорт” ЕООД. Имотът е включен в капитала на Дружеството.</p>
	         <p>Съгласно протокол № 12/29.05.2000 г. с решение № 289-2 на Общински съвет - Варна е образувано „Градски транспорт” ЕАД с имуществото на Община Варна и Градски Транспорт ЕООД  с предмет на дейност: осъществяване на  превоз на пътници срещу заплащане, съгласно действащата нормативна уредба; тролейбусен транспорт на пътници; ремонтна дейност и диагностика на МПС;   търговия с ГСМ, резервни части  и гуми; технически услуги и ремонт на автобусни спирки, диспечерски пунктове за автобусен транспорт и единни системи за комуникации и отчитане разписанията на автобусите в градския транспорт и пътнико-потока,  разработване на проекти за транспортни схеми, разписания, внос и рециклиране на нови и употребявани автобуси.</p>
         </div>
	</div>
</section>

<section class="contact_page">
	<div class="container" data-id="punktove">
			<p class="mtb-20">Посоченото работно време е валидно за кампаниите от 27-мо число на предходния месец до 4 -то число на текущия (редовна кампания)</p>
		<div class="punkts">
			<div class="single_punkt">
				<h4>кв. Галата, сп. Центъра</h4>
				<div class="address">
					<p>Адрес</p>
					<a href="#" target="_blank">ул."Русе" ( обръщача до училище “Димчо Дебелянов”)</a>
				</div>
				<p class="work_time">Работно време</p>
				<div class="work_day">
					<p>Делник:</p>
					<p>08.00 - 18.45 часа</p>
					<p>12.00 - 14.00 часа - стъпаловидна почивка</p>
				</div>
				<div class="holiday">
					<p>Събота и неделя:</p>
					<p>08.00 - 16.30 часа</p>
					<p>12.00 - 12.30 часа обедна почивка</p>
				</div>
			</div>
			<div class="single_punkt">
				<h4>кв. Галата, сп. Центъра</h4>
				<div class="address">
					<p>Адрес</p>
					<a href="#" target="_blank">ул."Русе" ( обръщача до училище “Димчо Дебелянов”)</a>
				</div>
				<p class="work_time">Работно време</p>
				<div class="work_day">
					<p>Делник:</p>
					<p>08.00 - 18.45 часа</p>
					<p>12.00 - 14.00 часа - стъпаловидна почивка</p>
				</div>
				<div class="holiday">
					<p>Събота и неделя:</p>
					<p>08.00 - 16.30 часа</p>
					<p>12.00 - 12.30 часа обедна почивка</p>
				</div>
			</div>	
			<div class="single_punkt">
				<h4>кв. Галата, сп. Центъра</h4>
				<div class="address">
					<p>Адрес</p>
					<a href="#" target="_blank">ул."Русе" ( обръщача до училище “Димчо Дебелянов”)</a>
				</div>
				<p class="work_time">Работно време</p>
				<div class="work_day">
					<p>Делник:</p>
					<p>08.00 - 18.45 часа</p>
					<p>12.00 - 14.00 часа - стъпаловидна почивка</p>
				</div>
				<div class="holiday">
					<p>Събота и неделя:</p>
					<p>08.00 - 16.30 часа</p>
					<p>12.00 - 12.30 часа обедна почивка</p>
				</div>
			</div>
				<div class="single_punkt">
				<h4>кв. Галата, сп. Центъра</h4>
				<div class="address">
					<p>Адрес</p>
					<a href="#" target="_blank">ул."Русе" ( обръщача до училище “Димчо Дебелянов”)</a>
				</div>
				<p class="work_time">Работно време</p>
				<div class="work_day">
					<p>Делник:</p>
					<p>08.00 - 18.45 часа</p>
					<p>12.00 - 14.00 часа - стъпаловидна почивка</p>
				</div>
				<div class="holiday">
					<p>Събота и неделя:</p>
					<p>08.00 - 16.30 часа</p>
					<p>12.00 - 12.30 часа обедна почивка</p>
				</div>
			</div>
		</div>				
	</div>
</section>

<section class="contact_page">
	<div class="container" data-id="qa">
		<h2 class="mtb-20">Често задавани въпроси</h2>
		<ul class="qa w-100">
			<li class="expanded">
				<div class="flex flex-between align-center">
					<p class="questions">Къде да си закупя билет?</p>
					<span class="material-icons expand_less">expand_less</span>
				</div>
				<p class="answer mtb-10">Примерен отговор</p>
			</li>
			<li>
				<div class="flex flex-between align-center">
					<p class="questions">От къде тръгва автобус №148</p>
					<span class="material-icons expand_more">expand_more</span>
				</div>
				<p class="answer mtb-10">Примерен отговор 2</p>
			</li>
			<li>
				<div class="flex flex-between align-center">
					<p class="questions">Кога е последният автобус за Владиславово</p>
					<span class="material-icons expand_more">expand_more</span>
				</div>
				<p class="answer mtb-10">Примерен отговор</p>
			</li>
		</ul>
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