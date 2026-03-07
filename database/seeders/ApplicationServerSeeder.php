<?php

namespace Database\Seeders;

use App\Models\Application;
use App\Models\OperatingSystem;
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

        $linux = OperatingSystem::updateOrCreate(['name' => 'Ubuntu 22.04'], ['is_active' => true]);
        $windows = OperatingSystem::updateOrCreate(['name' => 'Windows Server 2022'], ['is_active' => true]);

        $environments = ['Test', 'Pre-Prod', 'Prod'];

        foreach ($apps as $name => $description) {
            $application = Application::updateOrCreate(['name' => $name], ['description' => $description]);

            foreach ($environments as $index => $environment) {
                $application->servers()->updateOrCreate(
                    ['name' => strtolower($name) . '-' . strtolower(str_replace('-', '', $environment)) . '-srv'],
                    [
                        'ip_address' => '10.0.' . ($application->id + 10) . '.' . ($index + 10),
                        'operating_system_id' => $index % 2 === 0 ? $linux->id : $windows->id,
                        'environment_type' => $environment,
                        'notes' => $name . ' için ' . $environment . ' ortamı.',
                    ]
                );
            }
        }
    }
}
