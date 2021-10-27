<?php


    use Illuminate\Database\Migrations\Migration;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Support\Facades\Schema;

    class DistributorCode extends Migration
{
    public function up()
    {
        Schema::create('distributor_codes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('user_id')->unique();
            $table->string('referral_code')->unique()->index()->comment('User unique referral code');
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
        Schema::dropIfExists('distributor_codes');
    }
}
