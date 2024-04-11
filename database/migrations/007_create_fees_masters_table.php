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
        Schema::create('fees_masters', function (Blueprint $table) {
            $table->increments('id');
            $table->string('fees_name','150');
            $table->string('no_of_payments_in_a_year','10');
            $table->string('payment_type','100');
            $table->boolean('is_deleted')->default(false);
            $table->timestamps();
        });

        // Insert some stuff
        DB::table('fees_masters')->insert([
                [
                    'fees_name' => 'Tuition Fees',
                    'no_of_payments_in_a_year' => '12',
                    'payment_type' => 'Monthly'
                ],
                [
                    'fees_name' => 'Admission Fees',
                    'no_of_payments_in_a_year' => '1',
                    'payment_type' => 'Yearly'
                ],
                [
                    'fees_name' => 'Examination Fees',
                    'no_of_payments_in_a_year' => '2',
                    'payment_type' => 'Half-Yearly'
                ],
                [
                    'fees_name' => 'Session charges',
                    'no_of_payments_in_a_year' => '1',
                    'payment_type' => 'Yearly'
                ]
            ]
        );
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('fees_masters', function(Blueprint $table)
        {
            $table->dropIndex('fees_masters_fees_type_id');
            $table->dropIfExists('dropIfExists');
          
        });
        //Schema::dropIfExists('student_details');
    }
};
