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
        Schema::create('booking_ins', function (Blueprint $table) {
            $table->id();
            $table->string('voucher');
            $table->date('check_in');
            $table->date('check_out');
            $table->string('person');
            $table->string('extra');
            $table->string('remark');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('booking_ins');
    }
};
