<?php


use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Distributor extends Migration
{
    public function up()
    {
        Schema::create('distributors', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->comment('User id from users Table');
            $table->string('code')->index()->comment('Referral code. All referral codes are in the distributor_codes Tables');
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
        Schema::dropIfExists('distributors');
    }
}