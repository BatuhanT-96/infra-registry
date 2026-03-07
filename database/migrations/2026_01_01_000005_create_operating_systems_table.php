<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('operating_systems', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        Schema::table('servers', function (Blueprint $table) {
            $table->foreignId('operating_system_id')->nullable()->after('ip_address')->constrained('operating_systems')->nullOnDelete();
        });

        $names = DB::table('servers')->select('operating_system')->distinct()->pluck('operating_system')->filter();

        foreach ($names as $name) {
            $id = DB::table('operating_systems')->insertGetId([
                'name' => $name,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            DB::table('servers')
                ->where('operating_system', $name)
                ->update(['operating_system_id' => $id]);
        }

        Schema::table('servers', function (Blueprint $table) {
            $table->dropColumn('operating_system');
        });
    }

    public function down(): void
    {
        Schema::table('servers', function (Blueprint $table) {
            $table->string('operating_system')->nullable()->after('ip_address');
        });

        $serverRows = DB::table('servers')
            ->leftJoin('operating_systems', 'operating_systems.id', '=', 'servers.operating_system_id')
            ->select('servers.id', 'operating_systems.name as os_name')
            ->get();

        foreach ($serverRows as $row) {
            DB::table('servers')->where('id', $row->id)->update([
                'operating_system' => $row->os_name ?? 'Unknown',
            ]);
        }

        Schema::table('servers', function (Blueprint $table) {
            $table->dropConstrainedForeignId('operating_system_id');
        });

        Schema::dropIfExists('operating_systems');
    }
};
