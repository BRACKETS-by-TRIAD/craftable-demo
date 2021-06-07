<?php

use App\Models\ArticlesWithRelationship;
use App\Models\Tag;
use Illuminate\Database\Seeder;

class ArticlesWithRelationshipSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() : void
    {
        $tags = Tag::all();
        $articlesWithRelationship = ArticlesWithRelationship::all();

        $articlesWithRelationship->each(function ($articleWithRelationShip) use ($tags) {
            $articleWithRelationShip->tags()->sync(
                $tags->random(rand(1, 3))->pluck('id')->toArray()
            );
        });
    }
}
