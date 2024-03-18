<x-mail::message>

<h2>Hello, {{$body['email']}}</h2>


<x-mail::button :url="route('admin.reset-password-view', ['token' => $body['token']])">
Reset Password
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
