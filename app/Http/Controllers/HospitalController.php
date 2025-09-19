<?php

namespace App\Http\Controllers;

use App\Models\Hospital;
use Illuminate\Http\Request;

class HospitalController extends Controller
{
    //
    public function index()
    {
        return view('hospitals.index');
    }
    public function show($id)
    {
        $hospitals = Hospital::with(['facilities'])->findOrFail($id);
        return view('hospitals.show', compact('hospitals'));
    }
}
