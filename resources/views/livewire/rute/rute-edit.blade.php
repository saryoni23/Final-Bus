<div>
   
    <x-dialog-modal wire:model.live="modalRuteEdit" wire:click="$set('modalRuteEdit', false)" submit="edit">
        <x-slot name="title">
            Form Edit Rute
        </x-slot>

        <x-slot name="content">
           <div class="grid grid-col-12 gap-4">

            <!-- kota_asal -->
            <div class="col-span-12">
                <x-label for="form.from_route" value="Lokasi Berangkat"/>
                <x-input wire:model="form.from_route" id="form.from_route" type="text" class="mt-1 w-full" require autocomplete="form.from_route"/>
                <x-input-error for="form.judul" class="mt-1"/>
            </div>

            <!-- kota_tujuan -->
            <div class="col-span-12">
                <x-label for="form.to_route" value="Lokasi Tujuan"/>
                <x-input wire:model="form.to_route" id="form.to_route" class="mt-1 block w-full" name="form.to_route" required autocomplete="form.to_route" rows="5"></x-input>
                <x-input-error for="form.to_route" class="mt-1"/>
            </div>

            
           </div>
        </x-slot>

        <x-slot name="footer">
            <x-secondary-button @click="$wire.modalRuteEdit = false" wire:loading.attr="disabled">
                Batal
            </x-secondary-button>

            <x-button class="ms-3" wire:loading.attr="disabled">
                Update
            </x-button>
        </x-slot>
    </x-dialog-modal>
</div>
