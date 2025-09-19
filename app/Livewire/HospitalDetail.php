<?php

namespace App\Livewire;

use App\Models\Hospital;
use Livewire\Component;

class HospitalDetail extends Component
{
    public $hospital;
    public $newFacility, $newFacilityDesc;

    public function mount($id)
    {
        $this->hospital = Hospital::with(['facilities'])->findOrFail($id);
    }
    public function addFacility()
    {
        if ($this->newFacility) {
            $this->hospital->facilities()->create(['name' => $this->newFacility, 'description' => $this->newFacilityDesc]);
            $this->newFacility = ''; // Clear input
            $this->hospital->refresh();
        }
    }

    public function deleteFacility($facilityId)
    {
        $this->hospital->facilities()->where('id', $facilityId)->delete();
        $this->hospital->refresh();
    }

    public function render()
    {
        return view('livewire.hospital-detail');
    }
}
