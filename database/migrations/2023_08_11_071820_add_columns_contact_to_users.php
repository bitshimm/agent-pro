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
            $table->string('contact_phone')->nullable()->after('email');
            $table->string('contact_phone_second')->nullable()->after('contact_phone');
            $table->string('contact_email')->nullable()->after('contact_phone_second');
            $table->string('contact_address')->nullable()->after('contact_email');
            $table->string('contact_opening_hours')->nullable()->after('contact_address');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('contact_phone');
            $table->dropColumn('contact_phone_second');
            $table->dropColumn('contact_email');
            $table->dropColumn('contact_address');
            $table->dropColumn('contact_opening_hours');
        });
    }
};
