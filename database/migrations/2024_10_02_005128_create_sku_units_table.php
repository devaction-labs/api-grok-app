<?php

use App\Models\Tenant;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('sku_units', function (Blueprint $table) {
            $table->ulid('id')->primary();
            $table->foreignIdFor(Tenant::class)->constrained();
            $table->string('sku_code')->unique();
            $table->string('variation');
            $table->decimal('price');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sku_units');
    }
};
