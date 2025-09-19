<?php

namespace App\Livewire;

use App\Models\Hospital;
use Livewire\Component;
use Livewire\WithPagination;

class HospitalList extends Component
{
    use WithPagination;
    protected $paginationTheme = 'tailwind';

    public $hospitals, $hospitalId, $name, $address, $tenaga_medis, $persentase_ketersediaan_obat_dan_alkes, $indeks_kebersihan, $rata_rata_biaya, $akreditasi, $other_details;
    public $showAddModal = false;
    public $showEditModal = false;

    protected $rules = [
        'name' => 'required|string|max:255',
        'address' => 'required|string|max:255',
        'tenaga_medis' => 'required|integer|min:1',
        'persentase_ketersediaan_obat_dan_alkes' => 'required|integer|min:0|max:100',
        'indeks_kebersihan' => 'required|integer|min:0|max:100',
        'rata_rata_biaya' => 'required|integer|min:0',
        'akreditasi' => 'required|string|max:50',
        'other_details' => 'nullable|string'
    ];

    public function mount()
    {
        // $this->hospitals = Hospital::with(['facilities'])->paginate(10);
    }

    public function render()
    {
        $hospital = Hospital::with(['facilities'])->paginate(10);
        // dd($hospital);
        return view('livewire.hospital-list', compact('hospital'));
    }

    public function toogleAddModal()
    {
        $this->resetFields();
        $this->showAddModal = true;
    }

    public function toogleEditModal($id)
    {
        $hospital = Hospital::findOrFail($id);
        $this->hospitalId = $hospital->id;
        $this->name = $hospital->name;
        $this->address = $hospital->address;
        $this->tenaga_medis = $hospital->tenaga_medis;
        $this->persentase_ketersediaan_obat_dan_alkes = $hospital->persentase_ketersediaan_obat_dan_alkes;
        $this->indeks_kebersihan = $hospital->indeks_kebersihan;
        $this->rata_rata_biaya = $hospital->rata_rata_biaya;
        $this->akreditasi = $hospital->akreditasi;
        $this->other_details = $hospital->other_details;
        $this->showEditModal = true;
    }

    public function resetFields()
    {
        $this->hospitalId = null;
        $this->name = '';
        $this->address = '';
        $this->tenaga_medis = '';
        $this->persentase_ketersediaan_obat_dan_alkes = '';
        $this->indeks_kebersihan = '';
        $this->rata_rata_biaya = '';
        $this->akreditasi = '';
        $this->other_details = '';
    }

    public function saveHospital()
    {
        $this->validate();

        Hospital::create([
            'name' => $this->name,
            'address' => $this->address,
            'tenaga_medis' => $this->tenaga_medis,
            'persentase_ketersediaan_obat_dan_alkes' => $this->persentase_ketersediaan_obat_dan_alkes,
            'indeks_kebersihan' => $this->indeks_kebersihan,
            'rata_rata_biaya' => $this->rata_rata_biaya,
            'akreditasi' => $this->akreditasi,
            'other_details' => $this->other_details
        ]);

        $this->showAddModal = false;
        $this->resetPage();
        session()->flash('message', 'Rumah Sakit berhasil ditambahkan.');
    }

    public function updateHospital()
    {
        $this->validate();

        $hospital = Hospital::findOrFail($this->hospitalId);
        $hospital->update([
            'name' => $this->name,
            'address' => $this->address,
            'tenaga_medis' => $this->tenaga_medis,
            'persentase_ketersediaan_obat_dan_alkes' => $this->persentase_ketersediaan_obat_dan_alkes,
            'indeks_kebersihan' => $this->indeks_kebersihan,
            'rata_rata_biaya' => $this->rata_rata_biaya,
            'akreditasi' => $this->akreditasi,
            'other_details' => $this->other_details
        ]);

        $this->showEditModal = false;
        $this->resetPage();
        session()->flash('message', 'Rumah Sakit berhasil diupdate.');
    }

    public function deleteHospital($id)
    {
        $hospital = Hospital::findOrFail($id);
        $hospital->delete();
        $this->resetPage();
        session()->flash('message', 'Rumah Sakit berhasil dihapus.');
    }

    public function closeModals()
    {
        $this->showAddModal = false;
        $this->showEditModal = false;
    }
}
