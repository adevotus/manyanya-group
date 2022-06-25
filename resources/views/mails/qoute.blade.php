@component('mail::message')
    {{ $reply }}

    Thank for contact us by asking for quote on our services

    Yours sincerly,

    {{ config('app.name') }} Accountant
@endcomponent
