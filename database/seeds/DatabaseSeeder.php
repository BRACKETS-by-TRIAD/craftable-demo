<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Models\Article::class, 100)->create();
        factory(\App\Models\Post::class, 20)->create();
        factory(\App\Models\TranslatableArticle::class, 20)->create();
        factory(\App\Models\Export::class, 20)->create();
    }
}
