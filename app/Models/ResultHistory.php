<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResultHistory extends Model
{
    use HasFactory;
    protected $fillable = ['hospital_id', 'vikor_score', 'rank', 'calculated_at'];

    public function hospital()
    {
        return $this->belongsTo(Hospital::class);
    }
}
