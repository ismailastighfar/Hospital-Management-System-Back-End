@component('mail::message')

Welcome to Our Hospital 


@component('mail::button', ['url' => '<!-- APP LINK -->' ]) 
visite us
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
