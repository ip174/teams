@component('mail::message')
# Hi {{ $user->first_name }}!

Did you forget password?

@component('mail::button', ['url' => $reset_link])
    Reset Password
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
