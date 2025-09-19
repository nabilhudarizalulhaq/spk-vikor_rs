<?php

namespace App\Livewire;

use App\Models\Extracurricular;
use App\Models\Facility;
use App\Models\LearningMethod;
use App\Models\Hospital;
use App\Models\ResultHistory;
use App\Models\VikorResultHistory;
use Livewire\Component;

class Vikor extends Component
{
    // pre-defined weights
    public $selectedBobotFasilitas = 1;
    public $selectedBobotJumlahTenagaMedis = 1;
    public $selectedBobotKetersediaanObatDanAlkes = 1;
    public $selectedBobotRataRataBiaya = 1;
    public $selectedBobotIndeksKebersihan = 1;
    public $selectedBobotAkreditasi = 1;

    public $alternativeResults = [];
    public $normalizedResults = [];
    public $results = [];


    


    public function calculateVikor()
    {
        // dd($this->selectedBobotFasilitas, $this->selectedBobotJumlahTenagaMedis, $this->selectedBobotKetersediaanObatDanAlkes, $this->selectedBobotRataRataBiaya, $this->selectedBobotIndeksKebersihan, $this->selectedBobotAkreditasi);
        // data awal
        $hospitalData = Hospital::with(['facilities'])->get();

        // Nilai kritera
        $criteriaData = $hospitalData->map(function ($hospital) {
            return [
                'id' => $hospital->id,
                'name' => $hospital->name,
                'fasilitas' => $hospital->facilities->count() <= 1 ? 1 : ($hospital->facilities->count() <= 4 ? 2 : ($hospital->facilities->count() <= 7 ? 3 : ($hospital->facilities->count() <= 9 ? 4 : 5))),
                'tenaga_medis' => $hospital->tenaga_medis <= 200 ? 1 : ($hospital->tenaga_medis <= 300 ? 2 : ($hospital->tenaga_medis <= 400 ? 3 : ($hospital->tenaga_medis <= 500 ? 4 : 5))),
                'persentase_ketersediaan_obat_dan_alkes' => $hospital->persentase_ketersediaan_obat_dan_alkes <= 60 ? 1 : ($hospital->persentase_ketersediaan_obat_dan_alkes  <= 70 ? 2 : ($hospital->persentase_ketersediaan_obat_dan_alkes <= 80 ? 3 : ($hospital->persentase_ketersediaan_obat_dan_alkes <= 90 ? 4 : 5))),
                'rata_rata_biaya' => $hospital->rata_rata_biaya <= 75000 ? 5 : ($hospital->rata_rata_biaya <= 199000 ? 4 : ($hospital->rata_rata_biaya <= 299000 ? 3 : ($hospital->rata_rata_biaya <= 399000 ? 2 : 1))),
                'indeks_kebersihan' => $hospital->indeks_kebersihan <= 60 ? 1 : ($hospital->indeks_kebersihan <= 70 ? 2 : ($hospital->indeks_kebersihan <= 80 ? 3 : ($hospital->indeks_kebersihan <= 90 ? 4 : 5))),
                'akreditasi' => $hospital->akreditasi == 'Paripurna' ? 5 : ($hospital->akreditasi == 'Utama' ? 4 : ($hospital->akreditasi == 'Madya' ? 3 : ($hospital->akreditasi == 'Dasar' ? 2 : 1))),
            ];
        });
        $this->alternativeResults = $criteriaData;

        // Normalisasi
        $normalizedData = $this->normalizeData($criteriaData);
        // perhitungan selanjutnya
        $this->results = $this->calculateQValues($normalizedData);

        // store vikor result history
        $this->storeVikorResults($this->results);
    }

    private function normalizeData($data)
    {
        $criteria = ['fasilitas', 'tenaga_medis', 'persentase_ketersediaan_obat_dan_alkes', 'rata_rata_biaya', 'indeks_kebersihan',  'akreditasi'];

        $normalizedData = [];

        foreach ($data as $item) {
            $normalizedItem = [
                'id' => $item['id'],
                'name' => $item['name']
            ];

            foreach ($criteria as $criterion) {
                $worst = collect($data)->min($criterion);
                $best = collect($data)->max($criterion);
                // Rumus Normalisasi
                $normalizedItem[$criterion] = $best == $worst ? 0 : ($best - $item[$criterion]) / ($best - $worst);
            }

            $normalizedData[] = $normalizedItem;
        }
        $this->normalizedResults = $normalizedData;
        return $normalizedData;
    }

    private function calculateQValues($data)
    {

        $dataCollection = collect($data);
        // rumus bobot
        $total_w = $this->selectedBobotFasilitas + $this->selectedBobotJumlahTenagaMedis + $this->selectedBobotKetersediaanObatDanAlkes + $this->selectedBobotRataRataBiaya + $this->selectedBobotIndeksKebersihan + $this->selectedBobotAkreditasi;
        $weights = [
            'fasilitas' => $this->selectedBobotFasilitas / $total_w,
            'tenaga_medis' => $this->selectedBobotJumlahTenagaMedis / $total_w,
            'persentase_ketersediaan_obat_dan_alkes' => $this->selectedBobotKetersediaanObatDanAlkes / $total_w,
            'rata_rata_biaya' => $this->selectedBobotRataRataBiaya / $total_w,
            'indeks_kebersihan' => $this->selectedBobotIndeksKebersihan / $total_w,
            'akreditasi' => $this->selectedBobotAkreditasi / $total_w,
        ];

        // Calculate the minimum and maximum values for each criterion
        $f_star = [
            'fasilitas' => $dataCollection->min('fasilitas'),
            'tenaga_medis' => $dataCollection->min('tenaga_medis'),
            'persentase_ketersediaan_obat_dan_alkes' => $dataCollection->min('persentase_ketersediaan_obat_dan_alkes'),
            'rata_rata_biaya' => $dataCollection->min('rata_rata_biaya'),
            'indeks_kebersihan' => $dataCollection->min('indeks_kebersihan'),
            'akreditasi' => $dataCollection->min('akreditasi'),
        ];

        $f_neg = [
            'fasilitas' => $dataCollection->max('fasilitas'),
            'tenaga_medis' => $dataCollection->max('tenaga_medis'),
            'persentase_ketersediaan_obat_dan_alkes' => $dataCollection->max('persentase_ketersediaan_obat_dan_alkes'),
            'rata_rata_biaya' => $dataCollection->max('rata_rata_biaya'),
            'indeks_kebersihan' => $dataCollection->max('indeks_kebersihan'),
            'akreditasi' => $dataCollection->max('akreditasi'),
        ];

        $S = [];
        $R = [];
        $Q = [];

        // hitung nilai R dan S
        foreach ($data as $item) {
            $S_val = 0;
            $R_val = -INF;

            foreach ($weights as $criterion => $weight) {
                $f = $item[$criterion];
                // Ensure no division by zero
                if ($f_neg[$criterion] != $f_star[$criterion]) {
                    $s = $weight * ($f - $f_star[$criterion]) / ($f_neg[$criterion] - $f_star[$criterion]);
                } else {
                    $s = 0;
                }

                $S_val += $s;
                $R_val = max($R_val, $s);
            }

            $S[$item['id']] = $S_val;
            $R[$item['id']] = $R_val;
        }

        $S_star = min($S);
        $S_neg = max($S);
        $R_star = min($R);
        $R_neg = max($R);
        // nilai R dan S selesai


        // perangkinang nilai Q
        foreach ($data as $item) {
            $S_val = $S[$item['id']];
            $R_val = $R[$item['id']];

            $S_denominator = $S_neg - $S_star;
            $R_denominator = $R_neg - $R_star;

            $S_term = $S_denominator != 0 ? ($S_val - $S_star) / $S_denominator : 0;
            $R_term = $R_denominator != 0 ? ($R_val - $R_star) / $R_denominator : 0;

            $Q[$item['id']] = 0.5 * $S_term + 0.5 * $R_term;
        }

        // kirim data akhir ke tampilan
        return collect(array_map(function ($item) use ($Q) {
            $item['Q'] = $Q[$item['id']];
            return $item;
        }, $data))->sortBy('Q')->values()->all();
    }

    // simpan data hasil perhitungan vikor
    private function storeVikorResults($sortedResults)
    {
        foreach ($sortedResults as $rank => $result) {
            ResultHistory::create([
                'hospital_id' => $result['id'],
                'vikor_score' => $result['Q'],
                'rank' => $rank + 1, // Rank starts at 1
                'calculated_at' => now(),
            ]);
        }
    }


    public function render()
    {
        return view('livewire.vikor', ['results' => $this->results, 'alternativeResults' => $this->alternativeResults, 'normalizedResults' => $this->normalizedResults]);
    }
}
