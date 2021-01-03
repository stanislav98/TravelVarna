<?php
    $types = DB::table('user_types')->whereNotIn('type_id',[7,9])->get();
?>
<div class="modal vhod d-none flex flex-center align-center" id="vhod_modal">
    <div class="modal_form">
        <div class="grid_form">
            <x-guest-layout>
                <x-jet-authentication-card>
                    <x-slot name="logo">
                        <x-jet-authentication-card-logo />
                    </x-slot>

                    <x-jet-validation-errors class="mb-4" />

                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <h4 class="form_title text-center">Регистрация</h4>
                        <span class="material-icons close_reg_vhod mobile_close">close</span>
                        <div class="grid gap-10 grid-2 mtb-10">
                            <div class="input_hold">
                                <!-- <x-jet-label for="name" value="{{ __('Name') }}" /> -->
                                <x-jet-input id="name" class="w-100" type="text" name="name" required autofocus autocomplete="name" />
                                 <span class="floating-label">Име*</span>
                            </div>
                            <div class="input_hold">
                                <!-- <x-jet-label for="email" value="{{ __('Email') }}" /> -->
                                <x-jet-input id="email" class="w-100" type="email" name="email" required/>
                                 <span class="floating-label">Имейл*</span>
                            </div>
                        </div>
                        <div class="grid gap-10 mtb-10">
                            <div class="input_hold">
                                <!-- <x-jet-label for="password" value="{{ __('Password') }}" /> -->
                                <x-jet-input id="password" class="w-100" type="password" name="password" required autocomplete="new-password" />
                                 <span class="floating-label">Парола*</span>
                            </div>
                        </div>
                        <div class="grid gap-10 mtb-10">
                            <div class="input_hold">
                                <!-- <x-jet-label for="password_confirmation" value="{{ __('Confirm Password') }}" /> -->
                                <x-jet-input id="password_confirmation" class="w-100" type="password" name="password_confirmation" required autocomplete="new-password"  />
                                 <span class="floating-label">Повторете Паролата*</span>
                            </div>
                        </div>

                        <div class="grid gap-10 mtb-10">
                            <div class="input_hold">
                                <x-jet-input id="phone" class="w-100" type="text" name="phone" required />
                                <span class="floating-label">Телефонен номер*</span>
                            </div> 
                        </div>
                        <div class="grid gap-10 mtb-10">
                            <div class="input_hold">
                                <select  name="type_id" id="type_id" class="w-100" required placeholder="Тип">
                                     @foreach ($types as $type)
                                              <option value="{{ $type->type_id }}">{{ ucfirst($type->type) }}</option>
                                     @endforeach
                                </select>
                                 <span class="floating-label">Тип*</span>
                                <!-- <x-jet-input id="type_id" class="w-100" type="text" name="type_id" :value="old('type_id')" required placeholder="Тип"  /> -->
                            </div> 
                        </div>
                        <div class="grid gap-10 mtb-10">
                            <div class="input_hold">
                                <x-jet-input id="egn" class="w-100" type="text" name="egn" required />
                                <span class="floating-label">Идентификационен номер*</span>
                            </div>
                        </div>
                        <div class="grid grid-2 gap-10 mtb-10 align-center">
                            <div class="div">
                                <input type="checkbox" id="accept_privacy" name="accept_privacy" required>
                                <label for="accept_privacy"> Моля съгласете се с общите условия</label>
                            </div>
                            <div class="form-group mtb-10">
                                  {!! NoCaptcha::renderJs() !!}
                                  {!! NoCaptcha::display() !!}
                                  @error('g-recaptcha-response')
                                      <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                  @enderror
                           </div>
                        </div>
                        <div class="text-center">
                            <x-jet-button class="mat_btn">
                                {{ __('Регистрация') }}
                            </x-jet-button>
                        </div>
                    </form>
                </x-jet-authentication-card>
            </x-guest-layout>
            <div class="right">
                <span class="material-icons close_reg_vhod">close</span>
                <a href="" class="main_btn" id="vhod_user">Вход</a>
            </div>
        </div>
    </div>
</div>

<script></script>
