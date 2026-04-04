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
        $tasks = Task::all();

        return view('work_report', compact('contractors', 'work_sites', 'makers', 'tasks'));
    }

    public function store(Request $request)
    {
        DB::transaction(function () use(
            $request,
        ) {
            $work_report = WorkReport::create([
                'date' => $request->date,
                'contractors_id' => $request->contractor,
                'work_sites_id' => $request->work_site,
            ]);

            WorkDetail::create([
                'work_reports_id' => $work_report->id,
                'makers_id' => $request->maker,
                'tasks_id' => $request->task,
                'quantity' => $request->quantity,
            ]);
        });

        return back();
    }
}
