@component('mail::message')

Здравствуйте, {{$name}}

Для активации вашего обращения(тикета), вам нужно активировать ваш аккаунт.
Ваш пароль (после активации можете его поменять):
@component('mail::panel')
    {{$password}}
@endcomponent
Для активации вашего аккаунта, кликните по кнопке ниже.
(Данная ссылка переведет вас на страницу активации вашего аккаунта)

@component('mail::button', ['url' => $url])
    Активировать
@endcomponent

@endcomponent