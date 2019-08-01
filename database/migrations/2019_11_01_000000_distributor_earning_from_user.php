<?php


use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DistributorEarningFromUser extends Migration
{
    public function up()
    {
        Schema::create('distributor_earning_from_users', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->comment('User id from users Table');
            $table->integer('transaction_id')->comment('Earned from Transaction. distributor_amount');
            $table->double('earned')->comment('Earned');
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
        Schema::dropIfExists('distributor_earning_from_users');
    }
}