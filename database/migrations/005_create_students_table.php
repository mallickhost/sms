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

        Schema::create('students', function (Blueprint $table) {
            $table->increments('id');
            $table->string('student_name','150');
            $table->string('student_number','50')->unique();
            $table->string('aadhaar_number','50')->unique();
            $table->string('dob','30')->nullable();
            $table->string('gender','10');
            $table->string('admission_date','30')->nullable();
            $table->string('father_name','150');
            $table->string('mother_name','150')->nullable();
            $table->string('mobile_no_1')->nullable(false);
            $table->string('mobile_no_2')->nullable();
            $table->text('address')->nullable();
            $table->string('picture','50')->nullable();
            $table->string('email')->nullable();
            $table->string('password')->nullable();
            $table->boolean('is_login_enabled')->default(false);
            $table->boolean('is_active')->default(true);
            $table->boolean('is_deleted')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
