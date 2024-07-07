<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('admin_id')->nullable();
            $table->string('name')->nullable();
            $table->string('email')->unique()->nullable();
            $table->string('password')->nullable();
            $table->string('country_code')->nullable();
            $table->string('mobile')->nullable();
            $table->string('role');
            $table->string('otp')->nullable();
            $table->string('pin_number')->nullable();

            $table->string('address')->nullable();
            $table->string('state')->nullable();
            $table->string('city')->nullable();
            $table->string('zip_code')->nullable();
            $table->string('gender')->nullable();
            $table->date('birthdate')->nullable();
            $table->text('about_you')->nullable();

            $table->text('cover_img')->nullable();
            $table->text('profile_img')->nullable();

            $table->string('status');
            $table->string('is_inquiry')->default(0);
            $table->string('device_token')->nullable();
            $table->rememberToken();
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('admin_id')->references('id')->on('users')->onDelete('cascade');
        });

        \Illuminate\Support\Facades\DB::table('users')->insert([
                'name' => 'admin',
                'email' => 'admin@admin.com',
                'password' => bcrypt('123456'),
                'status' =>'active',
                'role' => 'admin'
            ]
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
