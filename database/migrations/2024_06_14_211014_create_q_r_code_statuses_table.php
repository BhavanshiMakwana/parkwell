<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQRCodeStatusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('q_r_code_statuses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('qr_code_id');
            $table->integer('is_sale')->default(0);
            $table->integer('is_register')->default(0);
            $table->integer('is_active')->default(0);
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('qr_code_id')->references('id')->on('q_r_code_records')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('q_r_code_statuses');
    }
}
