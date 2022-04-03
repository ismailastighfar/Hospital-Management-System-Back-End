@component('mail::message')

your appointment created succefully 
date : ---
time : ---

@component('mail::button', ['url' => ''])
visit us
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
