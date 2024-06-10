<x-mail::message>
    # From :
    {{ $lead->name }}
    {{ $lead->email }}

    Message :
    {{ $lead->message }}

    {{-- <x-mail::button :url="''">
        Button Text
    </x-mail::button> --}}
</x-mail::message>
