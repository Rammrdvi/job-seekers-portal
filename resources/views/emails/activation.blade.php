@component('mail::message')
# Account Activated

Hello {{ $user->name }},

Your account has been successfully activated. You can now log in and access your account.

Thank you,<br>
{{ config('app.name') }}
@endcomponent
