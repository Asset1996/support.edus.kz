@component('mail::message')

Здравствуйте, {{$name}}

Для восстановления пароля вашего аккаунта, кликните по кнопке ниже.
(Данная ссылка переведет вас на страницу восстановления пароля вашего аккаунта)

@component('mail::button', ['url' => $url])
Активировать
@endcomponent

@endcomponent