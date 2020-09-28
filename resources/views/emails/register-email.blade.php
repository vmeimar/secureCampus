@component('mail::message')
# Welcome to UoA

The body of your message.

@component('mail::button', ['url' => url('/set/password').'/'.$token])
Button Text
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
