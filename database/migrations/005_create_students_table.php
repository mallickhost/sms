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
            $table->enum('gender',['MALE', 'FEMALE', 'OTHER'])->nullable();
            $table->string('admission_date','30')->nullable();
            $table->string('father_name','150');
            $table->string('mother_name','150')->nullable();
            $table->string('mobile_no_1','20')->nullable(false);
            $table->string('mobile_no_2','20')->nullable();
            $table->text('address')->nullable();
            $table->string('picture','150')->nullable();
            $table->string('email','200')->nullable();
            $table->string('password','100')->nullable();
            $table->boolean('first_time_login')->default(true);
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
