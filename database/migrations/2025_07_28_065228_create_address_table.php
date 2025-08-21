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
        Schema::create('address', function (Blueprint $table) {
            $table->id();
            // المفتاح الخارجي الذي يربط العنوان بالمستخدم
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            // تفاصيل العنوان
            $table->string('country')->nullable();         // الدولة
            $table->string('city')->nullable();            // المدينة
            $table->string('street')->nullable();          // الشارع
            $table->string('postal_code')->nullable();     // الرمز البريدي
            $table->text('details')->nullable();           // أي تفاصيل إضافية

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('address');
    }
};