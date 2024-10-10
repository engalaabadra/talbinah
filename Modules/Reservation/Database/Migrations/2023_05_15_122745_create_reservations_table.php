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
            $table->string('main_lang')->default(localLang());
            $table->unsignedBigInteger('translate_id')->nullable();
            $table->foreign('translate_id')->references('id')->on('reservations')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->unsignedBigInteger('doctor_id');
            $table->foreign('doctor_id')->references('id')->on('users')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->unsignedBigInteger('appointment_id');
            $table->foreign('appointment_id')->references('id')->on('appointments')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->unsignedBigInteger('duration_id');
            $table->foreign('duration_id')->references('id')->on('durations')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->integer('price');
            $table->time('start_time');
            $table->time('end_time');

            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->unsignedBigInteger('communication_id');
            $table->foreign('communication_id')->references('id')->on('communications')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->unsignedBigInteger('reason_cancelation_id')->nullable();
            $table->foreign('reason_cancelation_id')->references('id')->on('reasons_cancelation')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->unsignedBigInteger('reason_rescheduling_id')->nullable();
            $table->foreign('reason_rescheduling_id')->references('id')->on('reasons_rescheduling')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->unsignedBigInteger('payment_id');
            $table->foreign('payment_id')->references('id')->on('payments')->onUpdate('CASCADE')->onDelete('CASCADE');

            $table->string('full_name')->nullable();
            $table->integer('age');
            $table->enum('gender',['0','1'])->nullable();//0:male , 1:female

            $table->text('problem')->nullable();
            $table->date('date');
            $table->text('notes')->nullable();
            $table->text('message')->nullable();
            $table->text('report')->nullable();
            $table->text('link')->nullable();
            $table->text('filename')->nullable();
            $table->enum('is_start',['0','1'])->default('0');//0:not start 1:started
            $table->enum('is_end',['0','1'])->default('0');//0:not end 1:ended


            $table->enum('status',['-1','0','1'])->default('-1');//0:canceled 1:upcoming 2:completed
            $table->enum('active',['0','1'])->default('1');//0:inactive 1:active
            $table->integer('reference_payment_id')->nullable();
            $table->date('deleted_at')->nullable();

            $table->timestamps();
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
