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
        Schema::create('times_days', function (Blueprint $table) {
            $table->id();
            $table->string('main_lang')->default(localLang());
            $table->unsignedBigInteger('time_id');
            $table->foreign('time_id')->references('id')->on('times')->onUpday('CASCADE')->onDelete('CASCADE');
            $table->unsignedBigInteger('day_id');
            $table->foreign('day_id')->references('id')->on('days')->onUpday('CASCADE')->onDelete('CASCADE');
            $table->enum('active',['0','1'])->default('1');//0:inactive 1:active 
            $table->date('deleted_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('times_days');
    }
};
