<?php

namespace App\Http\Controllers;

use App\Models\ResultHistory;
use App\Models\VikorResultHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    //
    public function index($limit = 5)
    {
        // Fetch the top rumah sakit with the best VIKOR scores (lowest scores)
        $topHospital = ResultHistory::select('hospital_id', DB::raw('AVG(vikor_score) as avg_score'))
            ->groupBy('hospital_id')
            ->orderBy('avg_score', 'asc') // Order by average score (lowest is best)
            ->limit($limit)
            ->get();

        // eager load
        $topHospital->load('hospital');
        return view('dashboard', compact('topHospital'));
    }
}
