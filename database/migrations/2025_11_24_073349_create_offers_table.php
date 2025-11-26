<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('offers', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // название оффера
            $table->string('target_url'); // целевой URL
            $table->decimal('cost_per_click', 8, 2); // стоимость за клик TODO вынести как настройку?
            $table->string('category')->nullable(); // категория сайта
            $table->string('status')->default('draft'); // дрэг энд дроп
            $table->boolean('is_active')->default(true); // активен ли оффер
            $table->foreignId('advertiser_id')->constrained('users')->onDelete('cascade'); // кто создал
            $table->timestamps();
             $table->timestamp('deleted_at')->nullable(); // Добавляем колонку
        });
    }

    public function down()
    {
        Schema::dropIfExists('offers');
    }
};