<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLinksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('links', function (Blueprint $table) {
            $table->id();
            $table->foreignId('bio_id')->index()->constrained();
            $table->foreignId('link_type_id')->index()->constrained();
            $table->string('title')->nullable();
            $table->string('icon')->nullable();
            $table->string('url')->nullable();
            $table->boolean('is_active')->default(false);
            $table->string('leap_link')->nullable();
            $table->dateTime('schedule')->nullable();
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
        Schema::dropIfExists('links');
    }
}
