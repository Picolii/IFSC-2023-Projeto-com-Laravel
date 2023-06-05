<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('_sensor_bejo', function (Blueprint $table) {
            $table->id();
            $table->string('nome',100);
            $table->string('contador',100);
            $table->timestamps();
        });

        Schema::disableForeignKeyConstraints();

        Schema::table('_leitura_bejo', function (Blueprint $table) {
            $table->foreignId('_sensor_bejo_id')->nullable()->constrained('_sensor_bejo')->default(null);
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('_sensor_bejo');
    }
};
