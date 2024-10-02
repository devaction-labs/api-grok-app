<?php

use App\Models\Fiscal\Cfop;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('icms', function (Blueprint $table) {
            $table->ulid('id')->primary();
            $table->foreignIdFor(Cfop::class)->constrained();
            $table->string('uf', 2);
            $table->string('cst')->nullable();
            $table->decimal('icms_rate', 5, 2);
            $table->decimal('fcp_rate', 5, 2)->nullable();
            $table->string('calculation_modality')->nullable();
            $table->decimal('base_reduction', 5, 2)->nullable();
            $table->decimal('st_mva', 5, 2)->nullable();
            $table->decimal('st_base_reduction', 5, 2)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('icms');
    }
};
