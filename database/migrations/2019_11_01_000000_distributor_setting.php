<?php


    use Illuminate\Database\Migrations\Migration;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Support\Facades\Schema;

    class DistributorSetting extends Migration
{
    public function up()
    {
        Schema::create('distributor_settings', function (Blueprint $table) {
            $table->increments('id');
            $table->string('meta')->index();
            $table->string('value')->index();
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
        Schema::dropIfExists('distributor_settings');
    }
}
