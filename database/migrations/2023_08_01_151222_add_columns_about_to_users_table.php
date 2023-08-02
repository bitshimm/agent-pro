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
            $table->text('about_title')->nullable()->after('email');
            $table->text('about_short_description')->nullable()->after('about_title');
            $table->text('about_full_description')->nullable()->after('about_short_description');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('about_title');
            $table->dropColumn('about_short_description');
            $table->dropColumn('about_full_description');
        });
    }
};
