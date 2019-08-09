<?php

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use App\Models\User;

class SeedSampleData extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = factory(User::class, 30)->create();
        $categories = factory(Category::class, 15)->create();

        $posts = factory(Post::class, 1000)
            ->create()
            ->each(function ($post) use ($users, $categories) {
                $post->user()->associate($users->random());
                $post->category()->associate($categories->random());
                $post->save();
            });
    }
}
