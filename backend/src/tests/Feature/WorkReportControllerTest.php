<?php

namespace Tests\Feature;

use App\Models\Contractor;
use App\Models\Maker;
use App\Models\Task;
use App\Models\WorkSite;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class WorkReportControllerTest extends TestCase
{
    use RefreshDatabase;

    private function makeContractor(): Contractor
    {
        static $i = 0;
        return Contractor::create([
            'name' => '作業員' . ++$i,
            'date_of_birth' => '1990-01-01',
            'address' => '東京',
        ]);
    }

    private function postWorkReport(array $contractorIds): \Illuminate\Testing\TestResponse
    {
        $site = WorkSite::create(['name' => '現場A', 'address' => '東京']);
        $maker = Maker::create(['name' => 'メーカーA']);
        $task = Task::create(['name' => '作業A', 'unit' => '個']);

        return $this->post('/workReport', [
            'date' => '2026-06-28',
            'contractors' => $contractorIds,
            'work_site' => $site->id,
            'maker' => $maker->id,
            'task' => $task->id,
            'quantity' => 3,
        ]);
    }

    public function test_kanazaki_preset_creates_work_report_for_each_contractor(): void
    {
        $ids = array_map(fn() => $this->makeContractor()->id, range(1, 4));

        $this->postWorkReport($ids);

        $this->assertDatabaseCount('work_reports', 4);
        $this->assertDatabaseCount('work_details', 4);
    }

    public function test_kanazaki_preset_with_duplicate_registers_nothing_and_returns_error(): void
    {
        $c1 = $this->makeContractor();
        $c2 = $this->makeContractor();
        $c3 = $this->makeContractor();
        $c4 = $this->makeContractor();

        $response = $this->postWorkReport([$c1->id, $c2->id, $c3->id, $c4->id, $c1->id]);

        $this->assertDatabaseCount('work_reports', 0);
        $response->assertSessionHas('error');
    }

    public function test_katano_preset_creates_work_report_for_each_contractor(): void
    {
        $ids = array_map(fn() => $this->makeContractor()->id, range(1, 2));

        $this->postWorkReport($ids);

        $this->assertDatabaseCount('work_reports', 2);
        $this->assertDatabaseCount('work_details', 2);
    }

    public function test_katano_preset_with_duplicate_registers_nothing_and_returns_error(): void
    {
        $c1 = $this->makeContractor();
        $c2 = $this->makeContractor();

        $response = $this->postWorkReport([$c1->id, $c2->id, $c1->id]);

        $this->assertDatabaseCount('work_reports', 0);
        $response->assertSessionHas('error');
    }
}
