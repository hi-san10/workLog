<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contractor;
use Carbon\CarbonImmutable;

class ContractorController extends Controller
{
    public function index()
    {
        return view('register');
    }

    public function store(Request $request)
    {
        $date = $request->year.'-'.$request->month.'-'.$request->day;
        $birth = CarbonImmutable::parse($date);
        Contractor::create([
            'name' => $request->name,
            'date_of_birth' => $birth,
            'address' => $request->address,
        ]);

        return back();
    }
}
