@component('mail::message')
# Introduction

your Appointment has been updated 

date: ???
time: ??
doctor: ???

@component('mail::button', ['url' => ''])
See details
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
