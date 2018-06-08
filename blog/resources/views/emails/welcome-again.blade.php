@component('mail::message')
#Intro
Hello {{ $user->name }}!


    # Rules
* one
* two
- three

The body of your message.

@component('mail::button', ['url' => 'localhost'])
go to local
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
