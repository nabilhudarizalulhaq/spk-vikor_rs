<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HospitalFacility extends Model
{
    use HasFactory;
    protected $fillable = ['hospital_id', 'name', 'description'];

    public function hospital()
    {
        return $this->belongsTo(Hospital::class);
    }
}
