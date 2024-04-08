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
        Schema::create('sections', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name','20');
            $table->boolean('is_deleted')->default(false);
            $table->timestamps();
        });

         // Insert some stuff
         DB::table('sections')->insert([
                [
                    'name' => 'Sec A'
                ],
                [
                    'name' => 'Sec B'
                ]
         ]
        );
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sections');
    }
};
