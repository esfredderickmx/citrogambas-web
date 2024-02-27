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
    Schema::create('orders', function (Blueprint $table) {
      $table->id();
      $table->unsignedBigInteger('user_id');
      $table->unsignedBigInteger('promotion_id')->nullable();
      $table->unsignedBigInteger('table_id')->nullable();
      $table->text('note')->nullable();
      $table->enum('type', ['take_in', 'to_go']);
      $table->enum('status', ['creating', 'pending', 'preparing', 'ready', 'completed', 'cancelled'])->default('creating');
      $table->float('total', 8, 2);
      $table->enum('paid', ['pending', 'done'])->default('pending');
      $table->enum('rating', [1, 2, 3, 4, 5])->nullable();
      $table->timestamps();

      $table->foreign('user_id')->references('id')->on('users')->cascadeOnUpdate()->cascadeOnDelete();
      $table->foreign('promotion_id')->references('id')->on('promotions')->cascadeOnUpdate()->cascadeOnDelete();
      $table->foreign('table_id')->references('id')->on('tables')->cascadeOnUpdate()->cascadeOnDelete();
    });

    // Tabla pivot para relacionar platillos y órdenes
    Schema::create('order_dish', function (Blueprint $table) {
      $table->id();
      $table->unsignedBigInteger('order_id');
      $table->unsignedBigInteger('dish_id');
      $table->integer('quantity');
      $table->timestamps();

      $table->foreign('order_id')->references('id')->on('orders')->cascadeOnUpdate()->cascadeOnDelete();
      $table->foreign('dish_id')->references('id')->on('dishes')->cascadeOnUpdate()->cascadeOnDelete();
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down() {
    Schema::dropIfExists('orders');
    Schema::dropIfExists('order_dish');
  }
};
