<?php


use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DistributorTransaction extends Migration
{
    public function up()
    {
        Schema::create('distributor_transactions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('level_id')->comment('From distributor_levels Table');
            $table->double('total_amount')->comment('Total Amount spend by the user on the product');
            $table->integer('dist_percent')->comment('This is will set by the admin for determine how much percentage referral user\'s will get from the original amount');
            $table->double('dist_amount')->comment('Calculated amount from percentage');
            $table->double('per_user_amount')->comment('Every user will get this amount');
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
        Schema::dropIfExists('distributor_transactions');
    }
}