@component('mail::message')

<p>Hello {{ $name }},<br/> Your are almost done!. <br/> {{ $message }}</p>

@component('mail::button', ['url' => $actionUrl, 'color' => 'blue'])
Activate Account
@endcomponent

<p>Regards,<br>{{ config('app.name') }}</p>

@component('mail::subcopy')
If you’re having trouble clicking the "Activate Account" button, copy and paste the URL below
into your web browser: [{{ $actionUrl }}]({{ $actionUrl }})
@endcomponent

@endcomponent
