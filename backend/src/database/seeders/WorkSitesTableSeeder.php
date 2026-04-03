<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WorkSitesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $content = [
            'name' => 'カンザキ(大黒埠頭営業所)',
            'address' => '神奈川県横浜市鶴見区大黒埠頭1',
        ];
        DB::table('work_sites')->insert($content);

        $content = [
            'name' => '片野工業(山下埠頭営業所)',
            'address' => '神奈川県横浜市中区山下町279 5号上屋',
        ];
        DB::table('work_sites')->insert($content);

        $content = [
            'name' => '片野工業(本牧埠頭営業所)',
            'address' => '神奈川県横浜市中区本牧埠頭 B-5上屋',
        ];
        DB::table('work_sites')->insert($content);

    }
}
