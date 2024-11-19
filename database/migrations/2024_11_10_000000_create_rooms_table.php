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
        Schema::create('rooms', function (Blueprint $table) {
            $table->id();
            $table->string('room_number')->unique(); 
            $table->string('room_type'); 
            $table->decimal('price', 10, 2); 
            $table->enum('status', ['available', 'reserved', 'maintenance'])->default('available'); // حالة الغرفة
            $table->text('description')->nullable(); 
            $table->timestamp('last_updated')->useCurrent(); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rooms');
    }
};



// $table->id();
// $table->string('room_number')->unique(); // رقم الغرفة
// $table->string('room_type'); // نوع الغرفة مثل (Single, Double, Suite)
// $table->decimal('price', 10, 2); // سعر الغرفة
// $table->enum('status', ['available', 'reserved', 'maintenance'])->default('available'); // حالة الغرفة
// $table->text('description')->nullable(); // وصف الغرفة (اختياري)
// $table->timestamp('last_updated')->useCurrent(); // تاريخ آخر تحديث للغرفة
// $table->timestamps();