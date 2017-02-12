@component('mail::message')
# Dear {{ $name }}

You are receiving this email because you are invited to Piyes.

@component('mail::button', ['url' => url('/register?token='.$token)])
Register Your Account
@endcomponent

Thanks,<br>
{{ config('app.name') }}


@component('mail::subcopy')
If you’re having trouble clicking the "Register Your Account" button, copy and paste the URL below
into your web browser: <br> [{{ url('/register?token='.$token) }}]({{ url('/register?token='.$token) }})
@endcomponent

@endcomponent