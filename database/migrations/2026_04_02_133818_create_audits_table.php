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
        Schema::create('audits', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained();
            $table->string('event'); // login, logout, create, update, delete
            $table->string('auditable_type')->nullable(); // Modelo afectado
            $table->unsignedBigInteger('auditable_id')->nullable(); // ID del registro
            $table->json('old_values')->nullable();
            $table->json('new_values')->nullable();
            $table->string('url');
            $table->ipAddress('ip_address');
            $table->string('user_agent');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('audits');
    }
};
