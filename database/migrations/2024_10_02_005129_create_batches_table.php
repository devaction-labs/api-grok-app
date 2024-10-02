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
        Schema::create('batches', function (Blueprint $table) {
            $table->ulid('id')->primary();
            $table->foreignIdFor(SkuUnit::class)->constrained();
            $table->foreignIdFor(Warehouse::class)->constrained();
            $table->string('batch_number');
            $table->date('manufacturing_date');
            $table->date('expiry_date');
            $table->integer('initial_quantity');
            $table->integer('available_quantity')->comment('Quantidade disponível para venda');
            $table->integer('reserved_quantity')->nullable()->comment('Quantidade disponível para venda');
            $table->integer('blocked_quantity')->nullable()->comment('Quantidade bloqueada (ex. avaria)');
            $table->integer('damaged_quantity')->nullable()->comment('Quantidade danificada');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('batches');
    }
};
