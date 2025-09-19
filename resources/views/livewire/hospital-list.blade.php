<div>
    <div class="w-full flex items-center justify-between mb-2">
        <h2 class="text-2xl font-bold mb-4">Daftar Rumah Sakit</h2>
        @auth
        @if(Auth::user()->is_admin)
        <button wire:click="toogleAddModal" class="text-white bg-cyan-500 hover:bg-cyan-600 focus:ring-4 focus:ring-cyan-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2">Tambah Rumah Sakit</button>
        @endif
        @endauth
    </div>

    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500">
            <thead class="text-xs text-gray-50 uppercase bg-cyan-800">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Nama
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Alamat
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Fasilitas
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Jumlah Tenaga Medis
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Persentase Ketersediaan Obat dan Alkes (%)
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Indeks Kebersihan
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Rata-rata Biaya (Rp)
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Akreditasi
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Aksi
                    </th>
                </tr>
            </thead>
            <tbody>
                @if ($hospital->count())
                @foreach ($hospital as $item)
                <tr class="bg-white border-b">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                        {{ $item->name }}
                    </th>
                    <td class="px-6 py-4">
                        {{ $item->address }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $item->facilities->isEmpty() ? '-' : $item->facilities->pluck('name')->join(', ') }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $item->tenaga_medis }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $item->persentase_ketersediaan_obat_dan_alkes }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $item->indeks_kebersihan }}
                    </td>
                    <td class="px-6 py-4">
                        Rp. {{ number_format($item->rata_rata_biaya, 0, ',', '.') }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $item->akreditasi }}
                    </td>
                    
                    <td class="px-6 py-4">
                        <div class="flex flex-col items-center justify-center space-y-2">
                            <a href="/rumah_sakit/{{ $item->id }}" class="inline-block bg-cyan-500 text-white px-4 py-2 rounded-md shadow hover:bg-cyan-600 transition duration-200">Detail</a>
                            @auth
                            @if(Auth::user()->is_admin)
                            <a href="#" wire:click="toogleEditModal({{ $item->id }})" class="inline-block bg-yellow-500 text-white px-4 py-2 rounded-md shadow hover:bg-yellow-600 transition duration-200">Ubah</a>

                            <a href="#" class="inline-block bg-red-500 text-white px-4 py-2 rounded-md shadow hover:bg-red-600 transition duration-200" onclick="confirmDelete({{ $item->id }})">Hapus</a>
                            @endif
                            @endauth
                        </div>

                    </td>
                </tr>
                @endforeach
                @else
                <tr>
                    <td colspan="9" class="text-center py-4">Tidak ada data.</td>
                </tr>
                @endif
            </tbody>
        </table>
    </div>

    {{ $hospital->links() }} <!-- For pagination links -->
    
    @if ($showAddModal || $showEditModal)
    <div class="fixed inset-0 flex items-center justify-center bg-gray-900 bg-opacity-50 z-50">
        <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-4xl mx-4">
            <div class="flex justify-between items-center mb-6 max-h-[80vh] overflow-y-auto">
                <h3 class="text-2xl font-semibold text-gray-800">{{ $showAddModal ? 'Tambah Rumah Sakit' : 'Edit Rumah Sakit' }}</h3>
                <button type="button" class="text-gray-500 hover:text-gray-700" wire:click="closeModals">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <form wire:submit.prevent="{{ $showAddModal ? 'saveHospital' : 'updateHospital' }}">
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Nama</label>
                        <input type="text" wire:model="name" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-cyan-500 focus:ring-cyan-500 sm:text-sm" placeholder="Masukkan nama rumah sakit" />
                        @error('name') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Alamat</label>
                        <input type="text" wire:model="address" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-cyan-500 focus:ring-cyan-500 sm:text-sm" placeholder="Masukkan alamat rumah sakit" />
                        @error('address') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Jumlah Tenaga Medis</label>
                        <input type="number" wire:model="tenaga_medis" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-cyan-500 focus:ring-cyan-500 sm:text-sm" placeholder="Masukkan total tenaga medis" />
                        @error('tenaga_medis') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Persentase Ketersediaan Obat dan Alkes</label>
                        <input type="number" wire:model="persentase_ketersediaan_obat_dan_alkes" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-cyan-500 focus:ring-cyan-500 sm:text-sm" placeholder="Masukkan persentase ketersediaan obat dan alkes" />
                        @error('persentase_ketersediaan_obat_dan_alkes') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Indeks Kebersihan</label>
                        <input type="number" wire:model="indeks_kebersihan" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-cyan-500 focus:ring-cyan-500 sm:text-sm" placeholder="Masukkan indeks kebersihan" />
                        @error('indeks_kebersihan') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Rata-Rata Biaya</label>
                        <input type="number" wire:model="rata_rata_biaya" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-cyan-500 focus:ring-cyan-500 sm:text-sm" placeholder="Masukkan rata-rata biaya" />
                        @error('rata_rata_biaya') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Akreditasi</label>
                        <select wire:model="akreditasi" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-cyan-500 focus:ring-cyan-500 sm:text-sm">
                            <option value="">Pilih Akreditasi</option>
                            <option value="Paripurna">Paripurna</option>
                            <option value="Utama">Utama</option>
                            <option value="Madya">Madya</option>
                            <option value="Dasar">Dasar</option>
                            <option value="Tidak Terakreditasi">Tidak Terakreditasi</option>
                        </select>
                        @error('akreditasi') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Detail</label>
                        <textarea wire:model="other_details" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-cyan-500 focus:ring-cyan-500 sm:text-sm" placeholder="Masukkan Detail lainnya"></textarea>
                        @error('other_details') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="mt-6 flex justify-end space-x-2">
                    <button type="button" class="py-2 px-4 bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500" wire:click="closeModals">
                        Cancel
                    </button>
                    <button type="submit" class="py-2 px-4 bg-cyan-500 text-white rounded-md hover:bg-cyan-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-cyan-500">
                        {{ $showAddModal ? 'Add' : 'Update' }}
                    </button>
                </div>
            </form>
        </div>
    </div>

    @endif
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function confirmDelete(hospitalId) {
        Swal.fire({
            title: 'Hapus Data?',
            text: 'aksi ini akan menghapus data secara permanen!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Iya',
            cancelButtonText: 'Tidak'
        }).then((result) => {
            if (result.isConfirmed) {
                // Call the Livewire delete method with the ID after confirmation
                @this.call('deleteHospital', hospitalId);
            }
        });
    }
</script>