<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArticlesWithRelationShipTagTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles_with_relationship_tag', function (Blueprint $table) {
            $table->unsignedInteger('articles_with_relationship_id');
            $table->foreign('articles_with_relationship_id', 'foreign_key_name')
                ->references('id')
                ->on('articles_with_relationships')
                ->onDelete('cascade');
            $table->unsignedInteger('tag_id');
            $table->foreign('tag_id')
                ->references('id')
                ->on('tags')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('articles_with_relationship_tag');
    }
}
