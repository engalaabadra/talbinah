<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     */
    public function up(): void
    {
        Schema::create('countries', function (Blueprint $table) {
            $table->id();
            $table->string('main_lang')->default(localLang());
            $table->unsignedBigInteger('translate_id')->nullable();
            $table->foreign('translate_id')->references('id')->on('countries')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->string('name',225);
            $table->string('flag');
            $table->string('code');
            $table->string('code2')->nullable();
            $table->string('numcode')->nullable();
            $table->string('phone_code');
            $table->enum('active',['0','1'])->default('1');//0:inactive 1:active 
            $table->date('deleted_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     */
    public function down(): void
    {
        Schema::dropIfExists('countries');
    }
};
