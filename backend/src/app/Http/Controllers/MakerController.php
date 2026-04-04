<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Maker;

class MakerController extends Controller
{
    public function store(Request $request)
    {
        Maker::create([
            'name' => $request->name,
        ]);

        return back();
    }
}
