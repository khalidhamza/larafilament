<x-filament-panels::page>
    <form wire:submit="save">
        {{ $this->form }}
        <x-filament::button type="submit" class="mt-3">
            Save
        </x-filament::button>
    </form>
</x-filament-panels::page>

<x-filament-actions::modals />