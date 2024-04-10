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

        Schema::create('student_academic_details', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('student_id')->unsigned()->index('student_academic_details_student_id_index')->nullable(false);
            $table->foreign('student_id')->references('id')->on('students')->onDelete('cascade');
            $table->integer('academic_session_id')->unsigned()->index('student_academic_academic_session_id_index')->nullable(false);
            $table->foreign('academic_session_id')->references('id')->on('academic_sessions');
            $table->integer('academic_class_id')->unsigned()->index('student_academic_details_academic_class_id_index')->nullable(false);
            $table->foreign('academic_class_id')->references('id')->on('academic_classes');
            $table->integer('section_id')->unsigned()->index('student_academic_details_section_id_index')->nullable(false);
            $table->foreign('section_id')->references('id')->on('sections');
            $table->string('roll_number','10');  
            $table->boolean('is_fees_assigned')->default(false);
            $table->integer('academic_status')->unsigned()->default(1)->comment('1= current, 2= passed, 3=failed');;           
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('student_academic_details', function(Blueprint $table)
        {
            $table->dropIndex('student_academic_details_student_id_index');
            $table->dropIndex('student_academic_academic_session_id_index');
            $table->dropIndex('student_academic_details_academic_class_id_index');
            $table->dropIndex('student_academic_details_section_id_index');
            $table->dropIfExists('dropIfExists');
          
        });
        //Schema::dropIfExists('student_details');
    }
};
