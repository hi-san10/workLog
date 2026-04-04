<?php

namespace App\Http\Controllers;

use App\Models\Contractor;
use App\Models\Payment;
use Carbon\CarbonImmutable;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index()
    {
        $contractors = Contractor::all();
        $payment_method = [
            '現金',
            '銀行振込',
        ];

        return view('payment_record', compact('contractors', 'payment_method'));
    }

    public function store(Request $request)
    {
        $date = CarbonImmutable::parse($request->target_date)->format('Y-m');
        Payment::create([
            'contractors_id' => $request->contractor,
            'target_month' => $date,
            'amount' => $request->amount,
            'payment_method' => $request->payment_method,
        ]);

        return back();
    }
}
