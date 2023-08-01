<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->text('adout_title')->nullable()->after('email');
            $table->text('adout_short_description')->nullable()->after('adout_title');
            $table->text('adout_full_description')->nullable()->after('adout_short_description');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('adout_title');
            $table->dropColumn('adout_short_description');
            $table->dropColumn('adout_full_description');
        });
    }
};
