<x-mail::message>
    # Introduction
    {{ $lead->name }}
    {{ $lead->email }}
    {{ $lead->message }}

    {{-- <x-mail::button :url="''">
        Button Text
    </x-mail::button> --}}

    Thanks,<br>
    {{ config('app.name') }}
</x-mail::message>
