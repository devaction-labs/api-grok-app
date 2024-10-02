<?php

use App\Models\{PriceList, SkuUnit, Tenant};
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('price_lists', function (Blueprint $table) {
            $table->ulid('id')->primary();
            $table->foreignIdFor(Tenant::class)->constrained();
            $table->string('name');
            $table->timestamps();
        });

        // Pivot table for price_list and sku_units
        Schema::create('price_list_sku', function (Blueprint $table) {
            $table->ulid('id')->primary();
            $table->foreignIdFor(SkuUnit::class)->constrained();
            $table->foreignIdFor(PriceList::class)->constrained();
            $table->decimal('price', 15, 2);
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('price_lists');
        Schema::dropIfExists('price_list_sku');
    }
};
