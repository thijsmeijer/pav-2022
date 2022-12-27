<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('user_lists', function (Blueprint $table) {
            $table->string('excerpt')->after('name')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('user_lists', function (Blueprint $table) {
            $table->dropColumn('excerpt');
        });
    }
};
