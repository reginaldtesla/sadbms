<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('personels', function (Blueprint $table) {
            $table->string('company_location')->nullable()->after('institution_name');
        });
    }

    public function down(): void
    {
        Schema::table('personels', function (Blueprint $table) {
            $table->dropColumn('company_location');
        });
    }
};
