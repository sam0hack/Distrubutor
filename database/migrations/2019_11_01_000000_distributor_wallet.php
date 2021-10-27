<?php


    use Illuminate\Database\Migrations\Migration;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Support\Facades\Schema;

    class DistributorWallet extends Migration
{
    public function up()
    {
        Schema::create('distributor_wallets', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->comment('User id from users Table');
            $table->double('total_earned')->default(0)->comment('Total Earned by referral');
            $table->double('total_withdrawal')->default(0)->comment('Total withdrawal from refferal earning');
            $table->double('current_balance')->default(0)->comment('Current balance');
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
        Schema::dropIfExists('distributor_wallets');
    }
}
