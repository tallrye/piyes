@component('mail::message')
# You have a new message from: {{ $name }}

{!! $body !!}

Thanks,<br>
{{ $name }} <br>
<hr>
Phone: {{ $phone }} <br>
Email: {{ $email }}

@endcomponent