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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name',30);
            $table->string('last_name',30);
            $table->string('email',50)->unique();
            $table->string('phone_number',10);
            $table->string('password');
            $table->string('code',300)->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->foreignId('rol_id')->nullable()->constrained('roles')->onDelete('cascade')->onUpdate('cascade');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
