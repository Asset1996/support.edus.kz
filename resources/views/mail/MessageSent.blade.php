@component('mail::message')

Здравствуйте, для вас новое сообщение от {{$sender}}

Сообщение: {{$message}}

Для того, чтобы ответить клиенту перейдите по указанной ссылке


@component('mail::button', ['url' => $url])
    Перейти
@endcomponent

@endcomponent
