<x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
            <x-jet-authentication-card-logo />
        </x-slot>

        <x-jet-validation-errors class="mb-4" />
   
        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif

<div class="modal vhod d-none flex flex-center align-center" id="vhod_modal_user">
    <div class="modal_form">
        <div class="grid_form">
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <h4 class="form_title text-center">Вписване</h4>
                <span class="material-icons close_vhod mobile_close">close</span>
                <div class="mtb-20">
                    <div class="input_hold">
                        <x-jet-input id="email" class="w-100" type="email" name="email" required autofocus />
                         <span class="floating-label">Имейл*</span>
                    </div>
                </div>
                <div class="mtb-20">
                    <div class="input_hold">
                        <x-jet-input id="password" class="w-100" type="password" name="password" required autocomplete="current-password" />
                        <span class="floating-label">Парола*</span>
                    </div>
                </div>
                <a href="#" class="forgot_password_button mb-20">Забравена парола ?</a>
                <div class="wrap_bttn_logins">
                    <div class="text-center">
                        <x-jet-button class="mat_btn">
                            {{ __('Вход') }}
                        </x-jet-button>
                    </div>
                  <a class="main_btn" href="{{ url('login/facebook') }}" id="btn-fblogin">
                      <span class="material-icons">facebook</span> Login with Facebook
                  </a>

                    <a class="main_btn" href="{{ url('login/google') }}" id="btn-glogin">
                        <img src="{{url('/images/google-logo.png')}}" alt=""> Login with Google
                    </a>
                    <!-- <div id="fb-root"></div>
                    <div id="status"></div>
                    <script async defer crossorigin="anonymous" src="https://connect.facebook.net/bg_BG/sdk.js#xfbml=1&version=v9.0&appId=3646522018742049" nonce="hizlVSGd"></script>
                    <div class="fb-login-button" data-size="medium" data-button-type="continue_with" data-layout="default" data-auto-logout-link="false" data-use-continue-as="false" data-width=""></div> -->
                </div>
            </form>
            <div class="right">
                <span class="material-icons close_vhod">close</span>
                <a href="" class="main_btn" id="register_user_back">Регистрация</a>
            </div>
        </div>
    </div>
</div>
    </x-jet-authentication-card>
</x-guest-layout>
