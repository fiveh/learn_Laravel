@component('mail::message')
#Introduction
Hello, <strong> {{ $user->name }} </strong> !


    # Rules
* one
* two
- three

The body of your message.

@component('mail::button', ['url' => 'http://127.0.0.1:8000/'])
go to local
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
