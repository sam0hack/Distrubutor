<?php


    use Illuminate\Database\Migrations\Migration;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Support\Facades\Schema;

    class DistributorLevelSix extends Migration
{
    public function up()
    {
        Schema::create('distributor_level_six', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->comment('under user id');
            $table->integer('level_user_id')->comment('level six Referred users');
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
        Schema::dropIfExists('distributor_level_six');
    }
}
