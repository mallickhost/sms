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

        Schema::create('academic_fees', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('fees_master_id')->unsigned()->index('academic_fees_fees_master_id_index')->nullable(false);
            $table->foreign('fees_master_id')->references('id')->on('fees_masters')->onDelete('cascade');
            $table->integer('academic_session_id')->unsigned()->index('academic_fees_academic_session_id_index')->nullable(false);
            $table->foreign('academic_session_id')->references('id')->on('academic_sessions')->onDelete('cascade');
            $table->integer('class_master_id')->unsigned()->index('academic_fees_class_master_id_index')->nullable(false);
            $table->foreign('class_master_id')->references('id')->on('class_masters')->onDelete('cascade');
            $table->float('total_fees_amount', 8, 2);
            $table->boolean('is_deleted')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('academic_fees', function(Blueprint $table)
        {
            $table->dropIndex('academic_fees_fees_master_id_index');
            $table->dropIndex('academic_fees_academic_session_id_index');
            $table->dropIndex('academic_fees_class_master_id_index');            
            $table->dropIfExists('dropIfExists');
          
        });
        //Schema::dropIfExists('student_details');
    }
};
