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
        Schema::create('reservations', function (Blueprint $table) {
            $table->id(); 
            $table->string('reservation_number')->unique();
            $table->string('name'); 
            $table->string('phone')->unique();
            $table->enum('gender', ['ذكر', 'أنثى']); 
            $table->string('nationality'); 
            $table->string('national_id')->unique(); 
            $table->enum('rental_type', ['يومي', 'أسبوعي', 'شهري']);
            $table->date('check_in')->nullable();
            $table->date('check_out')->nullable();
            $table->unsignedBigInteger('room_id');
            $table->string('status')->default('جديد');
            $table->timestamps();
            // إضافة العلاقة مع جدول الغرف
            $table->foreign('room_id')->references('id')->on('rooms')->onDelete('cascade');
            });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};




