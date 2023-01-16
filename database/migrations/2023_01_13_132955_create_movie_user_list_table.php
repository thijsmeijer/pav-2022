<?php

use App\Models\Movie;
use App\Models\UserList;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('movie_user_list', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(UserList::class);
            $table->foreignIdFor(Movie::class);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('movie_user_list');
    }
};
