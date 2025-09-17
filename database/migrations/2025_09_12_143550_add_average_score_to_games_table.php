<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
{
    Schema::table('games', function (Blueprint $table) {
        $table->decimal('average_score', 3, 1)->default(0)->after('description');
    });
}

public function down(): void
{
    Schema::table('games', function (Blueprint $table) {
        $table->dropColumn('average_score');
    });
}
};
