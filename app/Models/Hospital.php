<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hospital extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'address', 'tenaga_medis', 'persentase_ketersediaan_obat_dan_alkes', 'indeks_kebersihan', 'rata_rata_biaya', 'akreditasi', 'other_details'];

    public function facilities()
    {
        return $this->hasMany(HospitalFacility::class);
    }

    public function resultHistories()
    {
        return $this->hasMany(ResultHistory::class);
    }
}
