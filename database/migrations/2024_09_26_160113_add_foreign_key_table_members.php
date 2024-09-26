<?php

use App\Models\Cnpja\{Company, MemberRole, Person};
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('members', function (Blueprint $table) {
            $table->foreignIdFor(Person::class)->constrained();
            $table->foreignIdFor(MemberRole::class)->constrained();
            $table->foreignIdFor(Company::class)->constrained();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('members', function (Blueprint $table) {
            $table->dropConstrainedForeignId('person_id');
            $table->dropConstrainedForeignId('member_role_id');
            $table->dropConstrainedForeignId('company_id');
        });
    }
};
