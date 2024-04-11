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

        Schema::create('students_academic_details', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('student_id')->unsigned()->index('students_academic_details_student_id_index')->nullable(false);
            $table->foreign('student_id')->references('id')->on('students')->onDelete('cascade');
            $table->integer('academic_session_id')->unsigned()->index('students_academic_academic_session_id_index')->nullable(false);
            $table->foreign('academic_session_id')->references('id')->on('academic_sessions');
            $table->integer('class_master_id')->unsigned()->index('students_academic_details_class_master_id_index')->nullable(false);
            $table->foreign('class_master_id')->references('id')->on('class_masters');
            $table->integer('section_id')->unsigned()->index('students_academic_details_section_id_index')->nullable(false);
            $table->foreign('section_id')->references('id')->on('sections');
            $table->string('roll_number','10');
            $table->enum('academic_status',['RUNNING', 'PASSED', 'FAILED'])->nullable();           
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('students_academic_details', function(Blueprint $table)
        {
            $table->dropIndex('students_academic_details_student_id_index');
            $table->dropIndex('students_academic_academic_session_id_index');
            $table->dropIndex('students_academic_details_class_master_id_index');
            $table->dropIndex('students_academic_details_section_id_index');
            $table->dropIfExists('dropIfExists');
          
        });
        //Schema::dropIfExists('student_details');
    }
};
