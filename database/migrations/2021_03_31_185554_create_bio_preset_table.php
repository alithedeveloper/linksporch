<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBioPresetTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bio_preset', function (Blueprint $table) {
            $table->id();
            $table->foreignId('bio_id')->index()->constrained();
            $table->foreignId('preset_id')->index()->constrained();
            $table->string('background_style',50);
            $table->string('text_color', 50);
            $table->string('button_background', 50)->nullable();
            $table->string('button_text_color',50);
            $table->string('button_styles')->nullable();
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
        Schema::dropIfExists('bio_preset');
    }
}
