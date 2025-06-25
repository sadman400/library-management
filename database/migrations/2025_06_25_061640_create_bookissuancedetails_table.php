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
        Schema::create('bookissuancedetails', function (Blueprint $table) {
            $table->id('borrow_id');
            $table->unsignedBigInteger('member_id');
            $table->date('date_borrow');
            $table->date('due_date');
            $table->timestamps();
            
            $table->foreign('member_id')->references('member_id')->on('members');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookissuancedetails');
    }
};
