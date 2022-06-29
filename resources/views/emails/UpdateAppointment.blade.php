@component('mail::message')

your Appointment has been updated please visite us form more details


@component('mail::button', ['url' => ''])
See details
@endcomponent

Thanks,<br>
<img src="{{asset('/assets/img/logo.png')}}" width="80px" alt="">
@endcomponent
