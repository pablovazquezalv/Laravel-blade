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
        Schema::create('codes_access', function (Blueprint $table) {
            $table->id();
            $table->string('code', 6)->unique();
            $table->boolean('status')->default(false);
            $table->string('user_public_key', 300);
            //$table->string('user_private_key', 300);
            $table->foreignId('user_id')->constrained('users');
            $table->dateTime('expiration_date');            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('codes_access');
    }
};
