@component('mail::message')

Welcome to Our Hospital, Your are now ready to benifit our Services 

@component('mail::button', ['url' => '' ]) 
visite us
@endcomponent

Thanks,<br>
<img src="{{asset('/assets/img/logo.png')}}" width="80px" alt="">

@endcomponent
