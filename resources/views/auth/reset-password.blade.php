@include('header')
<div class="container">
<x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
            <x-jet-authentication-card-logo />
        </x-slot>
        <x-jet-validation-errors class="mb-4" />
        <form method="POST" action="{{ route('password.update') }}" class="mtb-20">
            @csrf

            <input type="hidden" name="token" value="{{ $request->route('token') }}">

            <div class="input_hold w-100 mtb-10">
                <x-jet-input id="email" class="block mt-1 w-100" type="email" name="email" required autofocus />
                <span class="floating-label">Имейл*</span>
            </div>

            <div class="input_hold w-100 mtb-10">
                <x-jet-input id="password" class="block mt-1 w-100" type="password" name="password" required autocomplete="new-password" />
                 <span class="floating-label">Парола*</span>
            </div>

            <div class="input_hold w-100 mtb-10">
                <x-jet-input id="password_confirmation" class="block mt-1 w-100" type="password" name="password_confirmation" required autocomplete="new-password" />
                 <span class="floating-label">Повторете паролата*</span>
            </div>

            <div class="flex flex-center align-center w-100">
               <button type="submit" class="mtb-20 main_btn text-center">
                    Смени паролата
                </button>
            </div>
        </form>
    </x-jet-authentication-card>
</x-guest-layout>
</div>
@include('footer')
