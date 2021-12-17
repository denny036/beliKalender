@component('mail::message')
# Mari aktivasi akun Anda!

Hai {{ $user->name }},

Berikut kode OTP Anda <b>{{ $user->token_activation }}</b><br>
Silakan masukkan kode OTP tersebut untuk melakukan verifikasi akun Anda.

{{-- @component('mail::button', ['url' => ''])
Button Text
@endcomponent --}}

Thanks,<br>
{{ config('app.name') }}
@endcomponent
