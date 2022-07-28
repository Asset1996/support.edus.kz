@component('mail::message')

Здравствуйте, {{$name}}

Для активации вашего аккаунта, кликните по кнопке ниже.
(Данная ссылка переведет вас на страницу активации вашего аккаунта)

@component('mail::button', ['url' => $url])
Активировать
@endcomponent

@endcomponent