<x-filament-panels::page>
    <form wire:submit="save">
        {{ $this->form }}
        
        {{-- {{ $this->formActions }} --}}
        <x-filament::button type="submit" class="mt-3">
            Change Password
        </x-filament::button>

        {{-- <x-filament::button type="cancel" class="mt-3">
            Cancel
        </x-filament::button> --}}
    </form>
</x-filament-panels::page>
