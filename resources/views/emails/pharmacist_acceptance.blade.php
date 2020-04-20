@component('mail::message')
# Introduction

You've had a new student apply for Placement

Please click the link below to accept the student.
@component('mail::button', ['url' => '/pharmacist-acceptance/{{$student->id}}'])
Acceptance Form
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
