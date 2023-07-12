<?php

namespace Database\Seeders;

use App\Models\DesignState;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DesignStateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $states = [
            'Pendiente', 'Por Entrega', 'Entregado', 'Rechazado'
        ];

        foreach ($states as $state) {
            DesignState::create([
                'name' => $state,
                'created_id' => 1,
                'updated_id' => 1,
            ]);
        }
    }
}
