<?php

use App\Models\Cnpja\{RegistrationType, Status};
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('registrations', function (Blueprint $table) {
            $table->foreignIdFor(Status::class)->constrained();
            $table->foreignIdFor(RegistrationType::class)->constrained();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('registrations', function (Blueprint $table) {
            $table->dropConstrainedForeignId('status_id');
            $table->dropConstrainedForeignId('registration_type_id');
        });
    }
};
