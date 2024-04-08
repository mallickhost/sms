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

        Schema::create('student_fees_transactions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('student_fees_id')->unsigned()->index('student_fees_transactions_student_fees_id_index')->nullable(false);
            $table->foreign('student_fees_id')->references('id')->on('student_fees')->onDelete('cascade');
            $table->string('admission_date','30');
            $table->float('total_amount', 8, 2);
            $table->boolean('is_deleted')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('student_fees_transactions', function(Blueprint $table)
        {
            $table->dropIndex('student_fees_transactions_student_fees_id_index');
            $table->dropIfExists('dropIfExists');
          
        });
        //Schema::dropIfExists('student_details');
    }
};
