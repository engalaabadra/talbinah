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
        Schema::table('reservations', function (Blueprint $table) {
            $table->enum('created_by',['user','admin'])->default('user')->after('reference_payment_id');
            $table->string('finance_attach')->nullable()->after('created_by');
            $table->boolean('notified')->default(false)->after('finance_attach');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('reservations', function (Blueprint $table) {
            $table->dropColumn('created_by');
            $table->dropColumn('finance_attach');
            $table->dropColumn('notified');
        });
    }
};
