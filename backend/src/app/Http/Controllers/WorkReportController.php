<?php

namespace App\Http\Controllers;

use App\Models\Contractor;
use App\Models\Maker;
use App\Models\Task;
use App\Models\WorkReport;
use App\Models\WorkSite;
use App\Models\WorkDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class WorkReportController extends Controller
{
    public function index()
    {
        $contractors = Contractor::all();
        $work_sites = WorkSite::all();
        $makers = Maker::all();
        $tasks = Task::orderBy('sort_order')->get();

        return view('work_report', compact('contractors', 'work_sites', 'makers', 'tasks'));
    }

    // 日次記録作成
    public function store(Request $request)
    {
        if (count($request->contractors) !== count(array_unique($request->contractors))) {
            return back()->withInput()->with('error', '外注先が重複しています');
        }

        DB::transaction(function () use ($request) {
            foreach ($request->contractors as $contractors_id) {
                $work_report = WorkReport::create([
                    'date' => $request->date,
                    'contractors_id' => $contractors_id,
                    'work_sites_id' => $request->work_site,
                ]);

                WorkDetail::create([
                    'work_reports_id' => $work_report->id,
                    'makers_id' => $request->maker,
                    'tasks_id' => $request->task,
                    'quantity' => $request->quantity,
                ]);
            }
        });

        return back()
            ->withInput()
            ->with('success', '登録完了');
    }
}
