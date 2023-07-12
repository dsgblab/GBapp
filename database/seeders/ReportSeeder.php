<?php

namespace Database\Seeders;

use App\Models\Report;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReportSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Report::create([
            'name' => 'US Sales Analysis',
            'group_id' => 'dd52b766-3b70-4c05-801a-edc9da600c8c',
            'report_id' => 'eae011d1-1ac6-4704-9dd3-88d233c382c0',
            'access_level' => 'View',
            'dataset_id' => '58f0fde6-76b2-4957-8610-23204a178f5e',
            'user_id' => 1,
        ]);

        DB::table('user_reports')
            ->insert([
                'user_id' => 1,
                'report_id' => 1,
            ]);
    }
}
