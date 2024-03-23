<div>
    <x-slot name="header">
        <h1 class='text-3xl mb-5'> {{ __('Rute') }}</h1>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="p-4 bg-white overflow-hidden shadow-xl sm:rounded-lg">

            <livewire:rute.rute-create/>
            <livewire:rute.rute-edit/>
            <livewire:rute.rute-delete/>
            <livewire:rute.rute-tabel/>
            </div>

        </div>
    </div>
</div>

