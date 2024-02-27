<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up() {
    Schema::create('dishes', function (Blueprint $table) {
      $table->id();
      $table->string('name')->unique();
      $table->string('image')->nullable();
      $table->text('description');
      $table->float('price', 8, 2);
      $table->enum('audience', ['general', 'childlike', 'mature', 'elder'])->default('general');
      $table->enum('season', ['any', 'winter', 'spring', 'summer', 'autumn', 'hot', 'cold'])->default('any');
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down() {
    Schema::dropIfExists('dishes');
  }
};
