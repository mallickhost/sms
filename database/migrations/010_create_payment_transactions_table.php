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
            $table->bigIncrements('id');
            $table->bigInteger('students_fees_breakup_id')->unsigned()->index('payment_transactions_students_fees_breakup_id_index')->nullable(false);
            $table->foreign('students_fees_breakup_id')->references('id')->on('students_fees_breakups')->onDelete('cascade');
            $table->string('transaction_type','50');
            $table->string('payment_date','50');
            $table->string('txn_number','50');
            $table->float('paid_amount', 8, 2);
            $table->boolean('is_paid')->default(false);
            $table->string('txn_note','255');
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
            $table->dropIndex('payment_transactions_students_fees_breakup_id_index');
            $table->dropIfExists('dropIfExists');
          
        });
        //Schema::dropIfExists('student_details');
    }
};
