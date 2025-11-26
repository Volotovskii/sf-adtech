<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('statistics', function (Blueprint $table) {
            $table->id();
            $table->foreignId('offer_id')->nullable()->constrained('offers')->onDelete('set null');
            $table->foreignId('webmaster_id')->nullable()->constrained('users')->onDelete('set null');
            $table->date('date'); // дата
            $table->unsignedInteger('clicks_count')->default(0); // кол-во кликов
            $table->decimal('revenue', 10, 2)->default(0); // доход веб-мастера
            $table->decimal('system_revenue', 10, 2)->default(0); // доход системы
            $table->timestamps();

            $table->unique(['offer_id', 'webmaster_id', 'date']); // уникальность по дню
        });
    }

    public function down()
    {
        Schema::dropIfExists('statistics');
    }
};