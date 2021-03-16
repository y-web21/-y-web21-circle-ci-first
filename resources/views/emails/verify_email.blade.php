@component('mail::message')

@if (!empty($user->name))
    <p style="font-weight: bold;">@lang('Hello!') {{ $user->name }} さん</p>
@endif

@lang('Please click the button below to verify your email address.')

@component('mail::button', ['url' => $url])
@lang('Verify Email Address.')
@endcomponent

---

@lang('If you did not create an account, no further action is required.')

---

@if (!empty($url))
<p style="font-weight: bold; font-size: 12px; margin-top: 10px;">
@lang('If you’re having trouble clicking the verify email button, copy and paste the URL below')<br>
<a href="{{ $url }}">{{ $url }}</a></p>
@endif
@endcomponent
