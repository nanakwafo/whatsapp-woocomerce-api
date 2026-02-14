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
        Schema::create('licenses', function (Blueprint $table) {
            $table->id();
            $table->string('email');
            $table->string('key')->unique();
            $table->string('reference')->unique();
            $table->string('status')->default('active'); // active, revoked, expired
            $table->timestamp('expires_at')->nullable();
            $table->integer('activation_count')->default(0);
            $table->integer('max_activations')->default(1);
            $table->json('activated_domains')->nullable();
            $table->string('first_activated_ip')->nullable();
            $table->timestamp('first_activated_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('licenses');
    }
};
