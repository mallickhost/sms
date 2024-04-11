<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('admins', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name','50');
            $table->string('email','100')->unique();
            $table->string('password','100');
            $table->enum('admin_access_level',['SUPER_ADMIN', 'ACCOUNTANT', 'EXAMINER'])->nullable();
            $table->string('last_login_at','30')->nullable();
            $table->string('last_login_ip','60')->nullable();
            $table->boolean('is_active')->default(true);
            $table->boolean('is_deleted')->default(false);
            $table->rememberToken();
            $table->timestamps();
        });
// best example https://buttercms.com/blog/laravel-migrations-ultimate-guide/#:~:text=Also%2C%20to%20check%20if%20a,email%22%20column...%20%7D

        // Insert some stuff
        DB::table('admins')->insert(
            [
                'name' => 'Super Admin',
                'email' => 'admin@mail.com',
                'password' => Hash::make('123'),
                'admin_access_level'=> 'SUPER_ADMIN'
            ]
        );  
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admins');
    }
};
