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

        Schema::create('payment_transactions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('transaction_type','50');
            $table->float('paid_amount', 8, 2);
            $table->boolean('is_paid')->default(false);
            $table->boolean('is_deleted')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('payment_transactions', function(Blueprint $table)
        {
            $table->dropIndex('fees_masters_fees_type_id');
            $table->dropIfExists('dropIfExists');
          
        });
        //Schema::dropIfExists('student_details');
    }
};
