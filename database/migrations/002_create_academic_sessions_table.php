<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('academic_sessions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('session_name','30');
            $table->string('session_year','10');
            $table->string('session_start_month','10');
            $table->string('session_end_month','10');
            $table->boolean('is_current')->default(false);
            $table->boolean('is_deleted')->default(false);
            $table->timestamps();
        });

        // Insert some stuff
        DB::table('academic_sessions')->insert([
                [
                    'session_name' => '2022-2023',
                    'session_year' => '2023',
                    'session_start_month' => 'Mar',
                    'session_end_month' => 'Feb',
                    'is_current'=>false
                ],
                [
                    'session_name' => '2023-2024',
                    'session_year' => '2024',
                    'session_start_month' => 'Mar',
                    'session_end_month' => 'Feb',
                    'is_current'=>true
                ]
            ]
        ); 
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('academic_sessions');
    }
};
