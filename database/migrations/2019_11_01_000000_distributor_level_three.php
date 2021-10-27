<?php


    use Illuminate\Database\Migrations\Migration;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Support\Facades\Schema;

    class DistributorLevelThree extends Migration
{
    public function up()
    {
        Schema::create('distributor_level_three', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->comment('user user id');
            $table->integer('level_user_id')->comment('level three Referred users');
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
        Schema::dropIfExists('distributor_level_three');
    }
}
