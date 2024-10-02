<?php

use App\Models\{Branch, Cnpja\Company, Tenant};
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('fiscal_departments', function (Blueprint $table) {
            $table->ulid('id')->primary();
            $table->foreignIdFor(Tenant::class)->constrained();
            $table->foreignIdFor(Branch::class)->constrained();
            $table->foreignIdFor(Company::class)->constrained();
            $table->string('name');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fiscal_departments');
    }
};
