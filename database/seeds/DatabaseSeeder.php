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
        factory(\App\Models\Author::class, 5)->create();
        factory(\Brackets\AdminAuth\Models\AdminUser::class, 5)->create();
        factory(\App\Models\Article::class, 100)->create();
        factory(\App\Models\Post::class, 20)->create();
        factory(\App\Models\TranslatableArticle::class, 20)->create();
        factory(\App\Models\Export::class, 20)->create();
        factory(\App\Models\ArticlesWithRelationship::class, 20)->create();
        factory(\App\Models\BulkAction::class, 20)->create();
        factory(\App\Models\Tag::class, 10)->create();
        $this->call(ArticlesWithRelationshipSeeder::class);
    }
}
