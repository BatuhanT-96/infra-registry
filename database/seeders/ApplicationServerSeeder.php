<?php

namespace Database\Seeders;

use App\Models\Application;
use Illuminate\Database\Seeder;

class ApplicationServerSeeder extends Seeder
{
    public function run(): void
    {
        $apps = [
            'CRM' => 'Müşteri ilişkileri yönetimi.',
            'ERP' => 'Kurumsal kaynak planlama.',
            'Mail Gateway' => 'Kurumsal e-posta ağ geçidi.',
        ];

        $environments = ['Test', 'Pre-Prod', 'Prod'];

        foreach ($apps as $name => $description) {
            $application = Application::updateOrCreate(['name' => $name], ['description' => $description]);

            foreach ($environments as $index => $environment) {
                $application->servers()->updateOrCreate(
                    ['name' => strtolower($name) . '-' . strtolower(str_replace('-', '', $environment)) . '-srv'],
                    [
                        'ip_address' => '10.0.' . ($application->id + 10) . '.' . ($index + 10),
                        'operating_system' => $index % 2 === 0 ? 'Ubuntu 22.04' : 'Windows Server 2022',
                        'environment_type' => $environment,
                        'notes' => $name . ' için ' . $environment . ' ortamı.',
                    ]
                );
            }
        }
    }
}
