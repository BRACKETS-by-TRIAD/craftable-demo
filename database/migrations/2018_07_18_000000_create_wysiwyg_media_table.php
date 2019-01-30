<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWysiwygMediaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wysiwyg_media', function (Blueprint $table) {
            $table->increments('id');
            $table->string('file_path');
            $table->unsignedInteger('wysiwygable_id')->nullable()->index();
            $table->string('wysiwygable_type')->nullable();
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
        Schema::dropIfExists('wysiwyg_media');
    }
}
