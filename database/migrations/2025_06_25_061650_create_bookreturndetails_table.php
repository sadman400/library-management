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
        Schema::create('bookreturndetails', function (Blueprint $table) {
            $table->id('borrow_detail_id');
            $table->unsignedBigInteger('book_id');
            $table->unsignedBigInteger('borrow_id');
            $table->string('borrow_status');
            $table->date('date_return');
            $table->timestamps();
            
            $table->foreign('book_id')->references('book_id')->on('books');
            $table->foreign('borrow_id')->references('borrow_id')->on('bookissuancedetails');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookreturndetails');
    }
};
