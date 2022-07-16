@component('mail::message')
# Bem-vindo ao {{ config('app.name') }}

Oi, {{ $details['name'] }}!
A sua conta foi criada e você já pode começar a salvar as suas tarefas.

@component('mail::button', ['url' => config('app.url')])
Acessar
@endcomponent

Obrigado,<br>
Equipe {{ config('app.name') }}
@endcomponent
