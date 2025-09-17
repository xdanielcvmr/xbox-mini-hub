<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
{
    Schema::table('reviews', function (Blueprint $table) {
        $table->dropColumn('gamer_score');
    });
}

public function down(): void
{
    Schema::table('reviews', function (Blueprint $table) {
        $table->unsignedTinyInteger('gamer_score')->nullable();
    });
}
};
