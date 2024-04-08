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

        Schema::create('student_fees', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('student_id')->unsigned()->index('student_fees_student_id_index')->nullable(false);
            $table->foreign('student_id')->references('id')->on('students')->onDelete('cascade');
            $table->integer('academic_fees_id')->unsigned()->index('student_fees_academic_fees_id_index')->nullable(false);
            $table->foreign('academic_fees_id')->references('id')->on('academic_fees')->onDelete('cascade');
            $table->float('total_amount', 8, 2);
            $table->float('paid_amount', 8, 2);
            $table->float('unpaid_amount', 8, 2);
            $table->boolean('is_deleted')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('student_fees', function(Blueprint $table)
        {
            $table->dropIndex('fees_masters_fees_type_id');
            $table->dropIfExists('dropIfExists');
          
        });
        //Schema::dropIfExists('student_details');
    }
};
