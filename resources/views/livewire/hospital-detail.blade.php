<div>
    <h1 class="text-3xl font-bold mb-4">{{ $hospital->name }}</h1>
    <p class="text-gray-700">Alamat: <span class="font-semibold">{{ $hospital->address }}</span></p>
    <p class="text-gray-700">Tenaga Medis: <span class="font-semibold">{{ $hospital->tenaga_medis }} orang</span></p>
    <p class="text-gray-700">Ketersediaan Obat dan Alkes: <span class="font-semibold">{{ $hospital->persentase_ketersediaan_obat_dan_alkes }} %</span></p>
    <p class="text-gray-700">Indeks Kebersihan: <span class="font-semibold">{{ $hospital->indeks_kebersihan }}</span></p>
    <p class="text-gray-700">Rata-rata Biaya: <span class="font-semibold">Rp. {{ $hospital->rata_rata_biaya }}</span></p>
    <p class="text-gray-700">Akreditasi: <span class="font-semibold">{{ $hospital->akreditasi }}</span></p>
    <p class="text-gray-700">Detail Lainnya: <span class="font-semibold">{{ $hospital->other_details }}</span></p>
    

    <div class="mt-8">
        <h2 class="text-2xl font-bold mt-4">Fasilitas</h2>
        <ul class="list-disc pl-5 mt-2">
            @foreach($hospital->facilities as $facility)
            <li class="flex justify-between items-center mt-2">
                <div>
                    <span class="font-bold">{{ $facility->name }}: </span>
                    <span class="italic">{{ $facility->description }}</span>
                </div>
                @auth
                @if(Auth::user()->is_admin)
                <button wire:click="deleteFacility({{ $facility->id }})" class="text-red-500 hover:text-red-700 ml-2">Hapus</button>
                @endif
                @endauth
            </li>
            @endforeach
        </ul>
        @auth
        @if(Auth::user()->is_admin)
        <div x-data="{ newFacility: '', newFacilityDesc: '' }" class="mt-4">
            <input type="text" x-model="newFacility" wire:model="newFacility" placeholder="Nama Fasilitas" class="input input-bordered w-full p-2 border border-gray-300 rounded-md focus:border-blue-500 focus:ring-1 focus:ring-blue-500 mb-2" />
            <input type="text" x-model="newFacilityDesc" wire:model="newFacilityDesc" placeholder="Deskripsi Fasilitas" class="input input-bordered w-full p-2 border border-gray-300 rounded-md focus:border-blue-500 focus:ring-1 focus:ring-blue-500" />
            <button wire:click="addFacility; newFacility = ''; newFacilityDesc = '';" class="mt-2 bg-cyan-500 text-white px-4 py-2 rounded-md hover:bg-cyan-600">Tambah Fasilitas</button>
        </div>
        @endif
        @endauth

    </div>
</div>