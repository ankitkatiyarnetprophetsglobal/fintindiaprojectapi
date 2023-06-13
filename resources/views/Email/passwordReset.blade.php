@component('mail::message')
# Introduction
The body of your message.
@component('mail::button', ['url' => 'http://103.65.20.170/fitind/update-password?token='.$token])
Button Text
@endcomponent
Thanks,<br>
{{ config('app.name') }}
@endcomponent
