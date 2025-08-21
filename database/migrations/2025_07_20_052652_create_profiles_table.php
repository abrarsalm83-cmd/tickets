<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**C
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();

            // 🔑 المفتاح الأجنبي الذي يربط بجدول users
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            
           // $table->foreignId('user_id')->references('id')->on('users')->onDelete('cascade');


            // ✏️ بيانات إضافية (مثال: سيرة ذاتية وعنوان)
            $table->string('bio')->nullable();
            $table->string('address')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profiles');
    }
};
