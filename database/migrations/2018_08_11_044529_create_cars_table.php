<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cars', function (Blueprint $table) {
            $table->increments('id');
            $table->string('ime')->nullable(false);
            $table->decimal('cena')->nullable(false);
            $table->integer('godiste')->nullable(false);
            $table->text('opis')->nullable(true);
            $table->bigInteger('kilometraza')->nullable(true);
            $table->string('slika')->nullable(false)->default('avatar.jpg');
            $table->boolean('odobren')->default(false);
            $table->integer('category_id');
            $table->integer('user_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cars');
    }
}
