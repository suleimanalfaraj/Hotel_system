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
        Schema::create('invoices', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('invoice_number', 50)->unique(); 
            $table->date('invoice_Date')->nullable();  
            $table->date('Due_date')->nullable();  
            $table->decimal('Amount_collection', 8, 2)->nullable();  
            $table->decimal('Discount', 8, 2); 
            $table->decimal('Total', 8, 2);  
            $table->text('note')->nullable();  
            $table->date('Payment_Date')->nullable();  
            $table->bigInteger('reservation_id')->unsigned();  
            $table->foreign('reservation_id')->references('id')->on('reservations')->onDelete('cascade'); 
            $table->bigInteger('room_id')->unsigned();  
            $table->foreign('room_id')->references('id')->on('rooms')->onDelete('cascade');  
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};


