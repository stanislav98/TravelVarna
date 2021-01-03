
<div class="modal vhod d-none flex flex-center align-center" id="vhod_modal">
	<div class="modal_form">
		<div class="grid_form">
			<form action="/" method="POST">
				<h4 class="form_title text-center">Регистрация</h4>
				<div class="grid gap-10 grid-3">
					<div class="input_hold">
						<input type="text" name="name" required class="w-100">
						 <span class="floating-label">Име*</span>
					</div>
					<div class="input_hold">
						<input type="text" name="surname" required class="w-100">
						 <span class="floating-label">Презиме*</span>
					</div>
					<div class="input_hold">
						<input type="text" name="family" required class="w-100">
						 <span class="floating-label">Фамилия*</span>
					</div>
				</div>
				<div class="grid gap-10 grid-2 mtb-10">
					<div class="input_hold">
						<input type="text" name="phone" required class="w-100">
						 <span class="floating-label">Телефон*</span>
					</div>
					<div class="input_hold">
						<input type="email" name="email" required class="w-100">
						 <span class="floating-label">Имейл*</span>
					</div>
				</div>
				<div class="grid gap-10 grid-2 mtb-10">
					<div class="input_hold">
						<input type="password" name="password" required class="w-100">
						 <span class="floating-label">Парола*</span>
					</div>
					<div class="input_hold">
						<input type="password" name="passwordvalidation" required class="w-100">
						 <span class="floating-label">Потвърди парола*</span>
					</div>
				</div>
				<p class="subtitle mtb-20">За учащи/Пенсионери/Служители на партноьори</p>
				<div class="input_hold mtb-10">
					<select class="w-100" name="type" id="type">
						<option value="uchenici">Учащи</option>
						<option value="pensioneri">Пенсионери</option>
						<option value="slujteli">Служители на партньори</option>
					</select>
					<span class="floating-label">Тип на картата*</span>
				</div>
				<div class="input_hold">
					<input type="password" name="egn" required class="w-100">
					<span class="floating-label">Въведете идентификационен номер*</span>
				</div>
				<div class="mtb-20">
					<input type="checkbox" id="agree_terms" name="agree_terms" value="Bike">
		 			<label for="agree_terms"> Съгласен съм с общите условия</label><br>
	 			</div>
	 			<div class="text-center">
	 				<a href="#" class="mat_btn" id="register_user_main">Регистрация</a>
	 			</div>
			</form>
			<div class="right">
				<span class="material-icons close_reg_vhod">close</span>
				<a href="" class="main_btn" id="vhod_user">Вход</a>
			</div>
		</div>
	</div>
</div>
