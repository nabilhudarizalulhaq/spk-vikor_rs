<div>
    <form wire:submit.prevent="calculateVikor" class="bg-white p-8 w-full mx-auto">
        <h2 class="text-2xl font-semibold text-gray-700 mb-6 text-center">Tentukan kriteria Rumah Sakit</h2>

        <div class="mb-5 grid grid-cols-1 md:grid-cols-2 gap-4">

        <div class="mb-5 flex flex-col md:flex-row items-center md:items-start">
            <img src="{{ asset('images/fasilitas_rs.jpg') }}" alt="Akreditasi" class="w-52 h-52 mx-auto object-cover">
            <div class="md:flex-1 md:ml-10">
                <!-- Starts component -->
                <div x-data="{ bobot_fasilitas: 1 }" class="w-full">

                    <label class="block text-cyan-700 font-black text-lg">Fasilitas</label>
                    <div class="flex flex-col gap-y-2 mt-2">
                        <label class="flex items-center gap-x-2">
                            <input type="radio" name="bobot_fasilitas" wire:model="selectedBobotFasilitas" x-model="bobot_fasilitas" value="1" class="border-gray-300 text-gray-700 focus:ring">
                            <span>Bukan Prioritas</span>
                        </label>
                        <label class="flex items-center gap-x-2">
                            <input type="radio" name="bobot_fasilitas" wire:model="selectedBobotFasilitas" x-model="bobot_fasilitas" value="2" class="border-gray-300 text-gray-700 focus:ring">
                            <span>Prioritas Rendah</span>
                        </label>
                        <label class="flex items-center gap-x-2">
                            <input type="radio" name="bobot_fasilitas" wire:model="selectedBobotFasilitas" x-model="bobot_fasilitas" value="3" class="border-gray-300 text-gray-700 focus:ring">
                            <span>Prioritas Menengah</span>
                        </label>
                        <label class="flex items-center gap-x-2">
                            <input type="radio" name="bobot_fasilitas" wire:model="selectedBobotFasilitas" x-model="bobot_fasilitas" value="4" class="border-gray-300 text-gray-700 focus:ring">
                            <span>Prioritas Tinggi</span>
                        </label>
                        <label class="flex items-center gap-x-2">
                            <input type="radio" name="bobot_fasilitas" wire:model="selectedBobotFasilitas" x-model="bobot_fasilitas" value="5" class="border-gray-300 text-gray-700 focus:ring">
                            <span>Sangat Prioritas</span>
                        </label>
                    </div>

                    <!-- Display Selected Value -->
                    <!-- <div class="mt-4 flex items-center gap-x-2 w-full">
                        <input type="number" id="inputBobotAkreditasi" x-model="bobot_akreditasi" min="1" max="5" class="border border-gray-300 rounded-lg px-2 py-1 h-10 w-14 text-gray-700 outline-none focus:ring">
                        /<span x-text="bobot_akreditasi == 5 ? 'Sangat Prioritas' : bobot_akreditasi == 4 ? 'Prioritas Tinggi' : bobot_akreditasi == 3 ? 'Prioritas Menengah' : bobot_akreditasi == 2 ? 'Prioritas Rendah' : 'Bukan Prioritas'"></span>
                    </div> -->

                </div> <!-- Ends component -->
            </div>
        </div>

        <div class="mb-5 flex flex-col md:flex-row items-center md:items-start">
            <img src="{{ asset('images/tenaga_rs.jpg') }}" alt="Jumlah Santri" class="w-52 h-52 mx-auto object-cover">
            <div class="md:flex-1 md:ml-10">
                <div x-data="{ bobot_jumlah_tenaga_medis: 1 }" class="w-full">
                    
                    <label class="block text-cyan-700 font-black text-lg">Jumlah Tenaga Medis</label>
                    <div class="flex flex-col gap-y-2 mt-2">
                        <label class="flex items-center gap-x-2">
                            <input type="radio" name="bobot_jumlah_tenaga_medis" wire:model="selectedBobotJumlahTenagaMedis" x-model="bobot_jumlah_tenaga_medis" value="1" class="border-gray-300 text-gray-700 focus:ring">
                            <span>Bukan Prioritas</span>
                        </label>
                        <label class="flex items-center gap-x-2">
                            <input type="radio" name="bobot_jumlah_tenaga_medis" wire:model="selectedBobotJumlahTenagaMedis" x-model="bobot_jumlah_tenaga_medis" value="2" class="border-gray-300 text-gray-700 focus:ring">
                            <span>Prioritas Rendah</span>
                        </label>
                        <label class="flex items-center gap-x-2">
                            <input type="radio" name="bobot_jumlah_tenaga_medis" wire:model="selectedBobotJumlahTenagaMedis" x-model="bobot_jumlah_tenaga_medis" value="3" class="border-gray-300 text-gray-700 focus:ring">
                            <span>Prioritas Menengah</span>
                        </label>
                        <label class="flex items-center gap-x-2">
                            <input type="radio" name="bobot_jumlah_tenaga_medis" wire:model="selectedBobotJumlahTenagaMedis" x-model="bobot_jumlah_tenaga_medis" value="4" class="border-gray-300 text-gray-700 focus:ring">
                            <span>Prioritas Tinggi</span>
                        </label>
                        <label class="flex items-center gap-x-2">
                            <input type="radio" name="bobot_jumlah_tenaga_medis" wire:model="selectedBobotJumlahTenagaMedis" x-model="bobot_jumlah_tenaga_medis" value="5" class="border-gray-300 text-gray-700 focus:ring">
                            <span>Sangat Prioritas</span>
                        </label>
                    </div>
                </div> <!-- Ends component -->
            </div>
        </div>

        <div class="mb-5 flex flex-col md:flex-row items-center md:items-start">
            <img src="{{ asset('images/obat_rs.jpg') }}" alt="Biaya Bulanan" class="w-52 h-52 mx-auto object-cover">
            <div class="md:flex-1 md:ml-10">
                <div x-data="{ bobot_ketersediaan_obat_dan_alkes: 1 }" class="w-full">
                    
                    <label class="block text-cyan-700 font-black text-lg">Ketersediaan Obat dan Alkes</label>
                    <div class="flex flex-col gap-y-2 mt-2">
                        <label class="flex items-center gap-x-2">
                            <input type="radio" name="bobot_ketersediaan_obat_dan_alkes" wire:model="selectedBobotKetersediaanObatDanAlkes" x-model="bobot_ketersediaan_obat_dan_alkes" value="1" class="border-gray-300 text-gray-700 focus:ring">
                            <span>Bukan Prioritas</span>
                        </label>
                        <label class="flex items-center gap-x-2">
                            <input type="radio" name="bobot_ketersediaan_obat_dan_alkes" wire:model="selectedBobotKetersediaanObatDanAlkes" x-model="bobot_ketersediaan_obat_dan_alkes" value="2" class="border-gray-300 text-gray-700 focus:ring">
                            <span>Prioritas Rendah</span>
                        </label>
                        <label class="flex items-center gap-x-2">
                            <input type="radio" name="bobot_ketersediaan_obat_dan_alkes" wire:model="selectedBobotKetersediaanObatDanAlkes" x-model="bobot_ketersediaan_obat_dan_alkes" value="3" class="border-gray-300 text-gray-700 focus:ring">
                            <span>Prioritas Menengah</span>
                        </label>
                        <label class="flex items-center gap-x-2">
                            <input type="radio" name="bobot_ketersediaan_obat_dan_alkes" wire:model="selectedBobotKetersediaanObatDanAlkes" x-model="bobot_ketersediaan_obat_dan_alkes" value="4" class="border-gray-300 text-gray-700 focus:ring">
                            <span>Prioritas Tinggi</span>
                        </label>
                        <label class="flex items-center gap-x-2">
                            <input type="radio" name="bobot_ketersediaan_obat_dan_alkes" wire:model="selectedBobotKetersediaanObatDanAlkes" x-model="bobot_ketersediaan_obat_dan_alkes" value="5" class="border-gray-300 text-gray-700 focus:ring">
                            <span>Sangat Prioritas</span>
                        </label>
                    </div>
                </div> <!-- Ends component -->
            </div>
        </div>

        <div class="mb-5 flex flex-col md:flex-row items-center md:items-start">
            <img src="{{ asset('images/biaya_rs.jpeg') }}" alt="Fasilits" class="w-52 h-52 mx-auto object-cover">
            <div class="md:flex-1 md:ml-10">
                <div x-data="{ bobot_rata_rata_biaya: 1 }" class="w-full">
                    
                    <label class="block text-cyan-700 font-black text-lg">Rata-rata Biaya</label>
                    <div class="flex flex-col gap-y-2 mt-2">
                        <label class="flex items-center gap-x-2">
                            <input type="radio" name="bobot_rata_rata_biaya" wire:model="selectedBobotRataRataBiaya" x-model="bobot_rata_rata_biaya" value="1" class="border-gray-300 text-gray-700 focus:ring">
                            <span>Bukan Prioritas</span>
                        </label>
                        <label class="flex items-center gap-x-2">
                            <input type="radio" name="bobot_rata_rata_biaya" wire:model="selectedBobotRataRataBiaya" x-model="bobot_rata_rata_biaya" value="2" class="border-gray-300 text-gray-700 focus:ring">
                            <span>Prioritas Rendah</span>
                        </label>
                        <label class="flex items-center gap-x-2">
                            <input type="radio" name="bobot_rata_rata_biaya" wire:model="selectedBobotRataRataBiaya" x-model="bobot_rata_rata_biaya" value="3" class="border-gray-300 text-gray-700 focus:ring">
                            <span>Prioritas Menengah</span>
                        </label>
                        <label class="flex items-center gap-x-2">
                            <input type="radio" name="bobot_rata_rata_biaya" wire:model="selectedBobotRataRataBiaya" x-model="bobot_rata_rata_biaya" value="4" class="border-gray-300 text-gray-700 focus:ring">
                            <span>Prioritas Tinggi</span>
                        </label>
                        <label class="flex items-center gap-x-2">
                            <input type="radio" name="bobot_rata_rata_biaya" wire:model="selectedBobotRataRataBiaya" x-model="bobot_rata_rata_biaya" value="5" class="border-gray-300 text-gray-700 focus:ring">
                            <span>Sangat Prioritas</span>
                        </label>
                    </div>
                </div> <!-- Ends component -->
            </div>
        </div>

        <div class="mb-5 flex flex-col md:flex-row items-center md:items-start">
            <img src="{{ asset('images/kebersihan_rs.jpg') }}" alt="Ekstrakurikuler" class="w-52 h-52 mx-auto object-cover">
            <div class="md:flex-1 md:ml-10">
                <div x-data="{ bobot_indeks_kebersihan: 1 }" class="w-full">
                    
                    <label class="block text-cyan-700 font-black text-lg">Indeks Kebersihan</label>
                    <div class="flex flex-col gap-y-2 mt-2">
                        <label class="flex items-center gap-x-2">
                            <input type="radio" name="bobot_indeks_kebersihan" wire:model="selectedBobotIndeksKebersihan" x-model="bobot_indeks_kebersihan" value="1" class="border-gray-300 text-gray-700 focus:ring">
                            <span>Bukan Prioritas</span>
                        </label>
                        <label class="flex items-center gap-x-2">
                            <input type="radio" name="bobot_indeks_kebersihan" wire:model="selectedBobotIndeksKebersihan" x-model="bobot_indeks_kebersihan" value="2" class="border-gray-300 text-gray-700 focus:ring">
                            <span>Prioritas Rendah</span>
                        </label>
                        <label class="flex items-center gap-x-2">
                            <input type="radio" name="bobot_indeks_kebersihan" wire:model="selectedBobotIndeksKebersihan" x-model="bobot_indeks_kebersihan" value="3" class="border-gray-300 text-gray-700 focus:ring">
                            <span>Prioritas Menengah</span>
                        </label>
                        <label class="flex items-center gap-x-2">
                            <input type="radio" name="bobot_indeks_kebersihan" wire:model="selectedBobotIndeksKebersihan" x-model="bobot_indeks_kebersihan" value="4" class="border-gray-300 text-gray-700 focus:ring">
                            <span>Prioritas Tinggi</span>
                        </label>
                        <label class="flex items-center gap-x-2">
                            <input type="radio" name="bobot_indeks_kebersihan" wire:model="selectedBobotIndeksKebersihan" x-model="bobot_indeks_kebersihan" value="5" class="border-gray-300 text-gray-700 focus:ring">
                            <span>Sangat Prioritas</span>
                        </label>
                    </div>
                </div> <!-- Ends component -->
            </div>
        </div>

        <div class="mb-5 flex flex-col md:flex-row items-center md:items-start">
            <img src="{{ asset('images/akreditasi_rs.png') }}" alt="Ekstrakurikuler" class="w-52 h-52 mx-auto object-cover">
            <div class="md:flex-1 md:ml-10">
                <div x-data="{ bobot_akreditasi: 1 }" class="w-full">
                    
                    <label class="block text-cyan-700 font-black text-lg">Akreditasi</label>
                    <div class="flex flex-col gap-y-2 mt-2">
                        <label class="flex items-center gap-x-2">
                            <input type="radio" name="bobot_akreditasi" wire:model="selectedBobotAkreditasi" x-model="bobot_akreditasi" value="1" class="border-gray-300 text-gray-700 focus:ring">
                            <span>Bukan Prioritas</span>
                        </label>
                        <label class="flex items-center gap-x-2">
                            <input type="radio" name="bobot_akreditasi" wire:model="selectedBobotAkreditasi" x-model="bobot_akreditasi" value="2" class="border-gray-300 text-gray-700 focus:ring">
                            <span>Prioritas Rendah</span>
                        </label>
                        <label class="flex items-center gap-x-2">
                            <input type="radio" name="bobot_akreditasi" wire:model="selectedBobotAkreditasi" x-model="bobot_akreditasi" value="3" class="border-gray-300 text-gray-700 focus:ring">
                            <span>Prioritas Menengah</span>
                        </label>
                        <label class="flex items-center gap-x-2">
                            <input type="radio" name="bobot_akreditasi" wire:model="selectedBobotAkreditasi" x-model="bobot_akreditasi" value="4" class="border-gray-300 text-gray-700 focus:ring">
                            <span>Prioritas Tinggi</span>
                        </label>
                        <label class="flex items-center gap-x-2">
                            <input type="radio" name="bobot_akreditasi" wire:model="selectedBobotAkreditasi" x-model="bobot_akreditasi" value="5" class="border-gray-300 text-gray-700 focus:ring">
                            <span>Sangat Prioritas</span>
                        </label>
                    </div>
                </div> <!-- Ends component -->
            </div>
        </div>

        </div>

        <button type="submit" class="w-full bg-cyan-500 text-white font-medium py-3 rounded-lg shadow hover:bg-cyan-600 focus:bg-cyan-600 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:ring-offset-2 transition ease-in-out duration-150">Ajukan Rekomendasi</button>
    </form>
    @if($results)
    <h3 class="text-lg font-semibold mt-8">Alternatif:</h3>
    <table class="table-auto w-full mt-4">
        <thead>
            <tr class="bg-gray-100">
                <th class="px-4 py-2">No.</th>
                <th class="px-4 py-2">Alternatif</th>
                <th class="px-4 py-2">Fasilitas(C1)</th>
                <th class="px-4 py-2">Jumlah Tenaga Medis(C2)</th>
                <th class="px-4 py-2">Ketersediaan Obat dan Alkes(C3)</th>
                <th class="px-4 py-2">Rata-rata Biaya(C5)</th>
                <th class="px-4 py-2">Indeks Kebersihan(C4)</th>
                <th class="px-4 py-2">Akreditasi(C6)</th>
            </tr>
        </thead>
        <tbody>
            @foreach($alternativeResults as $index => $result)
            <tr>
                <td class="border px-4 py-2">{{ $index + 1 }}</td>
                <td class="border px-4 py-2">{{ $result['name'] }}</td>
                <td class="border px-4 py-2">{{ $result['fasilitas'] }}</td>
                <td class="border px-4 py-2">{{ $result['tenaga_medis'] }}</td>
                <td class="border px-4 py-2">{{ $result['persentase_ketersediaan_obat_dan_alkes'] }}</td>
                <td class="border px-4 py-2">{{ $result['rata_rata_biaya'] }}</td>
                <td class="border px-4 py-2">{{ $result['indeks_kebersihan'] }}</td>
                <td class="border px-4 py-2">{{ $result['akreditasi'] }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <h3 class="text-lg font-semibold mt-8">Normalisasi:</h3>
    <table class="table-auto w-full mt-4">
        <thead>
            <tr class="bg-gray-100">
                <th class="px-4 py-2">No.</th>
                <th class="px-4 py-2">Alternatif</th>
                <th class="px-4 py-2">Fasilitas</th>
                <th class="px-4 py-2">Jumlah Tenaga Medis</th>
                <th class="px-4 py-2">Ketersediaan Obat dan Alkes</th>
                <th class="px-4 py-2">Indeks Kebersihan</th>
                <th class="px-4 py-2">Rata-rata Biaya</th>
                <th class="px-4 py-2">Akreditasi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($normalizedResults as $index => $normalized)
            <tr>
                <td class="border px-4 py-2">{{ $index + 1 }}</td>
                <td class="border px-4 py-2">{{ $normalized['name'] }}</td>
                <td class="border px-4 py-2">{{ number_format($normalized['fasilitas'], 2) }}</td>
                <td class="border px-4 py-2">{{ number_format($normalized['tenaga_medis'], 2) }}</td>
                <td class="border px-4 py-2">{{ number_format($normalized['persentase_ketersediaan_obat_dan_alkes'], 2) }}</td>
                <td class="border px-4 py-2">{{ number_format($normalized['indeks_kebersihan'], 2) }}</td>
                <td class="border px-4 py-2">{{ number_format($normalized['rata_rata_biaya'], 2) }}</td>
                <td class="border px-4 py-2">{{ number_format($normalized['akreditasi'], 2) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <h3 class="text-lg font-semibold mt-8">Hasil:</h3>
    <table class="table-auto w-full mt-4">
        <thead>
            <tr class="bg-gray-100">
                <th class="px-4 py-2">Rank</th>
                <th class="px-4 py-2">Nama Rumah Sakit</th>
                <th class="px-4 py-2">VIKOR (Q)</th>
            </tr>
        </thead>
        <tbody>
            @foreach($results as $index => $result)
            <tr>
                <td class="border px-4 py-2">{{ $index + 1 }}</td>
                <td class="border px-4 py-2">{{ $result['name'] }}</td>
                <td class="border px-4 py-2">{{ number_format($result['Q'], 4) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @else
    <p class="text-gray-600 mt-4">Belum ada rekomendasi, Pastikan anda menentukan bobot kriteria dan klik tombol Ajukan Rekomendasi.</p>
    @endif
</div>
<script>
</script>