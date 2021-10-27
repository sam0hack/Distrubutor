<?php


    use Illuminate\Database\Migrations\Migration;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Support\Facades\Schema;

    class DistributorLevel extends Migration
{
    public function up()
    {
        Schema::create('distributor_levels', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('distributed_by')->comment('User who spend amount');
            $table->integer('level_1')->comment('First upper level user from the distributor_by');
            $table->integer('level_2')->comment('Upper level user from the level_1 user');
            $table->integer('level_3')->comment('Upper level user from the level_2 user');
            $table->integer('level_4')->comment('Upper level user from the level_3 user');
            $table->integer('level_5')->comment('Upper level user from the level_4 user');
            $table->integer('level_6')->comment('Upper level user from the level_5 user');
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
        Schema::dropIfExists('distributor_levels');
    }
}
