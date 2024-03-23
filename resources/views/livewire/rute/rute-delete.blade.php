<div>
   
    <x-dialog-modal wire:model.live="modalRuteDelete" wire:click="$set('modalRuteDelete', false)" submit="edit">
        <x-slot name="title">
            Delete Rute
        </x-slot>

        <x-slot name="content">
        <p>Apakah Anda Ingin Menghapus Data dengan 
            ID:{{ $id }} dan 
            {{ $from_route }}</p>
        </x-slot>

        <x-slot name="footer">
            <x-secondary-button @click="$wire.modalRuteDelete = false" wire:loading.attr="disabled">
                Batal
            </x-secondary-button>

            <x-danger-button @click="$wire.del()" class="ms-3" wire:loading.attr="disabled">
                Delete
            </x-danger-button>
        </x-slot>
    </x-dialog-modal>
</div>
