<?php

use App\Models\Order;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('order_biddings', function (Blueprint $table) {
            $table->ulid('id')->primary();
            $table->foreignIdFor(Order::class)->constrained();
            $table->string('bidding_number')->unique();
            $table->string('supply_order')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_biddings');
    }
};
