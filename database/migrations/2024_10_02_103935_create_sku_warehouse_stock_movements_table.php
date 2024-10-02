<?php

use App\Models\Fiscal\{Cfop, FiscalDepartment, Icms};
use App\Models\{Branch, Product};
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('sku_warehouse_stock_movements', function (Blueprint $table) {
            $table->ulid('id')->primary();
            $table->foreignIdFor(Product::class)->constrained()->onDelete('cascade');
            $table->foreignIdFor(Branch::class, 'origin_branch_id')->nullable()->constrained()->onDelete('cascade');
            $table->foreignIdFor(Branch::class, 'destination_branch_id')->nullable()->constrained()->onDelete('cascade');
            $table->foreignIdFor(FiscalDepartment::class)->constrained()->onDelete('cascade');
            $table->integer('quantity');
            $table->enum('movement_type', ['transfer', 'internal', 'sale', 'adjustment']);
            $table->string('batch_number')->nullable();
            $table->string('status')->nullable();
            $table->foreignIdFor(Cfop::class)->nullable()->constrained()->onDelete('cascade');
            $table->foreignIdFor(Icms::class)->nullable()->constrained()->onDelete('cascade');
            $table->decimal('tax_value', 15, 2)->nullable();
            $table->decimal('base_value', 15, 2);
            $table->text('remarks')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sku_warehouse_stock_movements');
    }
};
