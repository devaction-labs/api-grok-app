<x-mail::message>
    # Olá, {{ $user->name }}

    Bem-vindo à nossa plataforma! Estamos felizes por tê-lo conosco.

    <x-mail::button :url="''">
        Acessar Plataforma
    </x-mail::button>

    Atenciosamente,<br>
    {{ config('app.name') }}
</x-mail::message>
