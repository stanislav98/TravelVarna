<div class="modal forgot_password d-none flex flex-center align-center" id="forgot_pass_modal">
    <div class="modal_form">
            @csrf
            <h4 class="form_title text-center">Забравена парола</h4>
            <x-guest-layout>
                <x-jet-authentication-card>
                    <x-slot name="logo">
                        <x-jet-authentication-card-logo />
                    </x-slot>

                    <div class="text-center">
                        {{ __(' Забравили сте паролата си ? Не е проблем. Оставете ни имейла си и ние ще ви изпратим имейл,който ще ви позволи да изберете нова парола!') }}
                    </div>

                    @if (session('status'))
                        <div class="mb-4 font-medium text-sm text-green-600">
                            {{ session('status') }}
                        </div>
                    @endif

                    <x-jet-validation-errors class="mb-4" />

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <div class="input_hold w-100 mtb-10">
                            <x-jet-input id="email" class="block mt-1 w-100" type="email" name="email" required autofocus />
                            <span class="floating-label">Имейл*</span>
                        </div>

                        <div class="flex flex-center align-center">
                           <button type="submit" class="mtb-20 main_btn text-center">
                                Изпрати
                            </button>
                        </div>
                    </form>
                </x-jet-authentication-card>
            </x-guest-layout>
    </div>
</div>
