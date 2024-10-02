<?php

use App\Models\{SkuUnit, Warehouse};
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('sku_warehouse_stocks', function (Blueprint $table) {
            $table->ulid('id')->primary();
            $table->foreignIdFor(SkuUnit::class)->constrained();
            $table->foreignIdFor(Warehouse::class)->constrained();
            $table->integer('quantity');
            $table->string('batch_number')->nullable();
            $table->date('expiry_date')->nullable();
            $table->date('manufacture_date')->nullable();
            $table->string('status')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sku_warehouse_stocks');
    }
};
