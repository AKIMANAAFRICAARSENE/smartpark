<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Service;

class ServicesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $services = [
            [
                'service_code' => 'ENG001',
                'service_name' => 'Engine Repairing',
                'price' => 150000.00
            ],
            [
                'service_code' => 'TRN001',
                'service_name' => 'Transmission Repair',
                'price' => 50000.00
            ],
            [
                'service_code' => 'OIL001',
                'service_name' => 'Oil Change',
                'price' => 60000.00
            ],
            [
                'service_code' => 'CHN001',
                'service_name' => 'Chain Replacement',
                'price' => 40000.00
            ],
            [
                'service_code' => 'DSC001',
                'service_name' => 'Disc Replacement',
                'price' => 400000.00
            ],
            [
                'service_code' => 'WAL001',
                'service_name' => 'Wheel Alignment',
                'price' => 5000.00
            ]
        ];

        foreach ($services as $service) {
            Service::create($service);
        }
    }
}
