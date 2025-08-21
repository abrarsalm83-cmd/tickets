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
       Schema::create('ticket_history', function (Blueprint $table) {
    $table->id();
    $table->unsignedBigInteger('ticket_id');
    $table->unsignedBigInteger('updated_by');
    $table->string('status', 50);
    $table->text('comment');
    $table->timestamp('update_at')->useCurrent();

    $table->foreign('ticket_id')->references('id')->on('tickets')->onDelete('cascade');
    $table->foreign('updated_by')->references('id')->on('users')->onDelete('cascade');
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ticket_history');
    }
};
