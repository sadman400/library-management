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
        Schema::create('books', function (Blueprint $table) {
            $table->id('book_id');
            $table->string('book_title');
            $table->unsignedBigInteger('category_id');
            $table->string('author');
            $table->integer('book_copies');
            $table->string('book_pub');
            $table->string('publisher_name');
            $table->string('ISBN');
            $table->year('copyright_year');
            $table->date('date_receiver');
            $table->date('date_added');
            $table->string('status');
            $table->timestamps();
            
            $table->foreign('category_id')->references('category_id')->on('categories');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
