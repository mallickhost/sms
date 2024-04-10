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

        Schema::create('students_fees_breakups', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('student_id')->unsigned()->index('students_fees_breakups_student_id_index')->nullable(false);
            $table->foreign('student_id')->references('id')->on('students')->onDelete('cascade');
            $table->integer('fees_master_id')->unsigned()->index('students_fees_breakups_fees_master_id_index')->nullable(false);
            $table->foreign('fees_master_id')->references('id')->on('fees_masters')->onDelete('cascade');
            $table->integer('academic_session_id')->unsigned()->index('students_fees_breakups_academic_session_id_index')->nullable(false);
            $table->foreign('academic_session_id')->references('id')->on('academic_sessions')->onDelete('cascade');
            $table->string('month_name','30');
            $table->float('total_amount', 8, 2);
            $table->float('paid_amount', 8, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('payment_transactions', function(Blueprint $table)
        {
            $table->dropIndex('students_fees_breakups_student_id_index');
            $table->dropIndex('students_fees_breakups_fees_master_id_index');
            $table->dropIndex('students_fees_breakups_academic_session_id_index');
            $table->dropIfExists('dropIfExists');
          
        });
        //Schema::dropIfExists('student_details');
    }
};
