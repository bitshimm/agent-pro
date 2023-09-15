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
		Schema::create('themes', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->unsignedBigInteger('user_id')->nullable()->default(null);

			$table->string('name');

			$table->string('background');
			$table->string('background_thumb');

			$table->text('properties');;

			$table->timestamps();

			$table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void
	{
		Schema::dropIfExists('themes');
	}
};
