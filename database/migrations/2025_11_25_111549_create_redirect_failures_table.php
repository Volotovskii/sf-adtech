<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

// редирект от вебмастера который не подписан на офер
return new class extends Migration
{
    public function up()
    {
        Schema::create('redirect_failures', function (Blueprint $table) {
            $table->id();
            $table->foreignId('webmaster_id')->nullable()->constrained('users')->onDelete('set null');
            $table->foreignId('offer_id')->nullable()->constrained('offers')->onDelete('set null');
            $table->string('ip_address')->nullable();
            $table->text('user_agent')->nullable();
            $table->string('reason')->nullable(); // причина отказа
            $table->timestamp('created_at');
        });
    }

    public function down()
    {
        Schema::dropIfExists('redirect_failures');
    }
};