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
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('member_id');
            $table->unsignedBigInteger('session_id');
            $table->boolean('is_attended')->default(false);
            $table->date('booking_date')->nullable();
            $table->timestamps();
            $table->foreign('member_id')->references('id')->on('members')->onDelete('cascade');
            $table->foreign('session_id')->references('id')->on('training_sessions')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
