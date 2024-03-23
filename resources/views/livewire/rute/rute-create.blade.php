<div>
    <x-button @click="$wire.modalRuteCreate = true">Create Rute</x-button>

    <x-dialog-modal wire:model.live="modalRuteCreate" wire:click="$set('modalRuteCreate', false)" submit="save">
        <x-slot name="title">
            Form Rute
        </x-slot>

        <x-slot name="content">
            <div class="grid grid-col-12 gap-4">

                <!-- kota_asal -->
                <div class="col-span-12">
                    <x-label for="form.kota_asal" value="Kota Asal" />
                    <x-input wire:model="form.kota_asal" id="form.kota_asal" type="text" class="mt-1 w-full" require
                        autocomplete="form.kota_asal" />
                    <x-input-error for="form.kota_asal" class="mt-1" />
                </div>

                <!-- Kota Tujuan -->
                <div class="col-span-12">
                    <x-label for="form.kota_tujuan" value="Kota Tujuan" />
                    <x-input wire:model="form.kota_tujuan" id="form.kota_tujuan" type="text" class="mt-1 w-full" require
                        autocomplete="form.kota_tujuan" />
                    <x-input-error for="form.kota_tujuan" class="mt-1" />
                </div>

                <!-- jam Berangkat -->
                <div class="col-span-12">
                    <x-label for="form.jam_berangkat" value="Jam Berangkat" />
                    <x-input wire:model="form.jam_berangkat" id="form.jam_berangkat" type="time" class="mt-1 w-full" require
                        autocomplete="form.jam_berangkat" />
                    <x-input-error for="form.jam_berangkat" class="mt-1" />
                </div>

                <div>
                    <x-input wire:model="form.is_active" id="form.is_active" type="hidden" />
                </div>


            </div>
        </x-slot>

        <x-slot name="footer">
            <x-secondary-button @click="$wire.modalRuteCreate = false" wire:loading.attr="disabled">
                Batal
            </x-secondary-button>

            <x-button class="ms-3" wire:loading.attr="disabled">
                Simpan
            </x-button>
        </x-slot>
    </x-dialog-modal>
</div>
