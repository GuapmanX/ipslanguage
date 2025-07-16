<x-layout :isadmin="$is_admin ?? false">
    <x-slot:heading>
        Admin Panel
    </x-slot:heading> 
    <x-slot:email>
        {{ $email }}
    </x-slot:email>
    <livewire:UserDisplay :users="$users">
</x-layout>