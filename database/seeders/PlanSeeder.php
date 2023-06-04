<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PlanSeeder extends Seeder
{
    public function run(): void
    {
        $test = app()->environment('production') ? 0 : 1;

        DB::table('plans')->insert(
            [
                [
                    'type'          => 'RECURRING',
                    'name'          => 'Free',
                    'price'         => 0.00,
                    'interval'      => 'EVERY_30_DAYS',
                    'test'          => $test,
                    'capped_amount' => 0.01,
                    'terms'         => 'FREE plan, no charge',
                    'on_install'    => true,
                    'created_at'    => now(),
                    'updated_at'    => now(),
                ],
                [
                    'type'          => 'RECURRING',
                    'name'          => 'Premium',
                    'price'         => 2.99,
                    'interval'      => 'EVERY_30_DAYS',
                    'test'          => $test,
                    'capped_amount' => null,
                    'terms'         => null,
                    'on_install'    => false,
                    'created_at'    => now(),
                    'updated_at'    => now(),
                ],
            ]
        );
    }
}
