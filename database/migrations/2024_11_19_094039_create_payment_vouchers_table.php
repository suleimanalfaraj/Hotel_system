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
        Schema::create('payment_vouchers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('reservation_id')->nullable(); 
            $table->date('date'); 
            $table->time('time'); 
            $table->string('purpose'); 
            $table->string('expense_item'); 
            $table->string('supplier'); 
            $table->decimal('amount', 10, 2); 
            $table->string('payment_method');
            $table->text('notes')->nullable();
            $table->timestamps();

            // ربط المفتاح الأجنبي
            $table->foreign('reservation_id')->references('id')->on('reservations')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payment_vouchers');
    }
};
