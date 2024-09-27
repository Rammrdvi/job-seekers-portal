@component('mail::message')
# Account Deactivated

Hello {{ $user->name }},

Your account has been deactivated. If you believe this is a mistake, please contact support for assistance.

Thank you,<br>
{{ config('app.name') }}
@endcomponent
