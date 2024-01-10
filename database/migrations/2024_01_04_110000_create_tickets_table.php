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
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->text('issue');
            $table->foreignId('status_id')->constrained('statuses');
            $table->text('resolution')->nullable();
            $table->text('mop')->nullable();
            $table->unsignedBigInteger('shift_id')->nullable(); // If applicable
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('mop_id')->nullable(); // If applicable
            $table->timestamps();

            // Foreign keys (if applicable)
            $table->foreign('shift_id')->references('id')->on('shifts');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('mop_id')->references('id')->on('m_o_p_s');
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
};
