<?php

use App\Models\Fiscal\FiscalDepartment;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('cfops', function (Blueprint $table) {
            $table->ulid('id')->primary();
            $table->foreignIdFor(FiscalDepartment::class)->constrained();
            $table->string('cfop_exit_state');
            $table->string('cfop_exit_out_of_state');
            $table->string('cfop_entry_state');
            $table->string('cfop_entry_out_of_state');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cfops');
    }
};
