<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArticlesWithRelationshipsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles_with_relationships', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->text('perex')->nullable();
            $table->date('published_at')->nullable();
            $table->boolean('enabled')->default(false);
            $table->unsignedInteger('author_id')->nullable();
            $table->foreign('author_id')->references('id')->on('authors')->onDelete('cascade');
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
        Schema::dropIfExists('articles_with_relationships');
    }
}
