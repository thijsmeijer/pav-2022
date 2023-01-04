<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('profiles', function (Blueprint $table) {
            $table->dropColumn('date_of_birth');
            $table->dropColumn('phone');
            $table->dropColumn('phone_verified_at');
            $table->dropColumn('bio');
            $table->text('about')->after('name')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('profiles', function (Blueprint $table) {
            $table->date('date_of_birth')->nullable();
            $table->string('phone')->nullable();
            $table->dateTime('phone_verified_at')->nullable();
            $table->text('bio')->nullable();
            $table->dropColumn('about');
        });
    }
};
