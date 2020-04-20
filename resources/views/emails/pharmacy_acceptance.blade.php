@component('mail::message')
# Introduction

You've had a new student apply for Placement

Please click the link below to accept to be the students Tutor.
@component('mail::button', ['url' => '/pharmacy-acceptance/{{$student->id}}'])
Acceptance Form
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
