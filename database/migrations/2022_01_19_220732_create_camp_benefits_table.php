<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCampBenefitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('camp_benefits', function (Blueprint $table) {
            $table->id();
            /**
             * cara pertama
             * menambahkan unsigned untuk field camp_id menjadi foreign key untuk relasi data atau
             * menambahkan unsignedBigInteger untuk field camp_id menjadi foreign key untuk relasi data
             *  $table->bigInteger('camp_id')->unsigned();
             *  $table->unsignedBigInteger('camp_id');
             */

            // cara ke dua
            $table->foreignId('camp_id')->constrained();
            $table->string('name');
            $table->timestamps();

            /**
             * membuat foreign key dengan cara pertama
             *$table->foreign('camp_id')->references('id')->on('camps')->onDelete('cascade');
             *kalau dengan cara ke dua kita tidak membutuhkan langkah ini
             */
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('camp_benefits');
    }
}
