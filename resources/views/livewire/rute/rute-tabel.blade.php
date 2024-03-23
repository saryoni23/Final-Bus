<div>
    <x-select wire:model.live='paginate' class='text-xs mt-8'>
        <option value="5">5</option>
        <option value="10">10</option>
        <option value="20">20</option>
        <option value="50">50</option>
        <option value="100">100</option>
    </x-select>
<table class="w-full mt-2">
    <thead>
        <tr>
            <th class='p-2 border border-spacing-1'>#</th>
            <th class='p-2 whitespace-nowrap border border-spacing-1'>Action</th>

                 <x-sort :$sortDirection :$sortBy :field="'id'"/></th>
            <th @click="$wire.sortField('from_route')" class='p-2 whitespace-nowrap border border-spacing-1 cursor-pointer'> <x-sort :$sortDirection :$sortBy :field="'from_route'" />Lokasi Berangkat</th>
            <th @click="$wire.sortField('to_route')" class='p-2 whitespace-nowrap border border-spacing-1 cursor-pointer'><x-sort :$sortDirection :$sortBy :field="'to_route'" />Lokasi Tujuan</th>
        </tr>
        <tr>
            <td></td>
            <td></td>

            <td class="p-2 border border-spacing-1"><x-input wire:model.live="form.from_route"   type="search" class="w-full text-sm"/></td>
            <td class="p-2 border border-spacing-1"><x-input wire:model.live="form.to_route"     type="search" class="w-full text-sm"/></td>
        </tr>
    </thead>
    <tbody>
        @isset($data)
        @foreach ($data as $rute)
        <tr>
            <td class='p-2 text-center border border-spacing-1'>{{ $loop->iteration }}.</td>
            <td class='p-2 border border-spacing-1'> 
                <x-button @click="$dispatch('dispatch-rute-table-edit', { id:  '{{ $rute->id }}'  })" type='button' class='text-sm'>Edit</x-button>
                <x-danger-button @click="$dispatch('dispatch-rute-table-delete', { id:  '{{ $rute->id }}', asal:  '{{ $rute->kota_asal }} Ke {{ $rute->kota_tujuan }}'})">Delete</x-danger-button>
            </td>
            <td class='p-2 border border-spacing-1'>{{ $rute->from_route }}</td>
            <td class='p-2 border border-spacing-1'>{{ $rute->to_route }}</td>   
        </tr>
        @endforeach
        @endisset
    </tbody>
</table>
<div class="mt-3">{{ $data->onEachSide(1)->links() }}</div>
</div>
