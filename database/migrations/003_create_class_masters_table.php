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

        //todo need to insert data as this table does no have ui for edit/add
        Schema::create('class_masters', function (Blueprint $table) {
            $table->increments('id');
            $table->string('class_name','30');
            $table->string('class_roman_name','10');
            $table->boolean('is_deleted')->default(false);
            $table->timestamps();
        });

        // Insert some stuff
        $data = [[
            'class_name' => 'Lower KG',
            'class_roman_name' => 'LKG'
        ],
        [
            'class_name' => 'Upper KG',
            'class_roman_name' => 'UKG'
        ],
        [
            'class_name' => 'Standard One',
            'class_roman_name' => 'I'
        ],
        [
            'class_name' => 'Standard Two',
            'class_roman_name' => 'II'
        ],
        [
            'class_name' => 'Standard Three',
            'class_roman_name' => 'III'
        ],
        [
            'class_name' => 'Standard Four',
            'class_roman_name' => 'IV'
        ]];
        
        DB::table('class_masters')->insert($data); 
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('class_masters');
    }
};
