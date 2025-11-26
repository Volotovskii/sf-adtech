<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('clicks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('offer_id')->constrained('offers')->onDelete('cascade');
            $table->foreignId('webmaster_id')->constrained('users')->onDelete('cascade');
            $table->string('ip_address')->nullable(); // IP клиента
            $table->text('user_agent')->nullable(); // браузер клиента
            $table->timestamp('redirected_at')->nullable(); // время редиректа
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('clicks');
    }
};