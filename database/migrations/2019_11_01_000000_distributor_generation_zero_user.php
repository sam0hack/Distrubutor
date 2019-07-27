<?php


use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DistributorGenerationZeroUser extends Migration
{
    public function up()
    {
        Schema::create('distributor_generation_zero_users', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->comment('This contentians higher level users. which we called generation zero users');
            $table->timestamps();
            $table->index('created_at');
            $table->index('updated_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('distributor_generation_zero_users');
    }
}