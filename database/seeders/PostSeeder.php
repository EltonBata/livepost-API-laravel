<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Database\Factories\Helper\FactoryHelper;
use Database\Factories\PostFactory;
use Database\Seeders\Traits\DisableForeignKey;
use Database\Seeders\Traits\TruncateTable;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{

    use TruncateTable, DisableForeignKey;
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->disableForeignKey();

        $this->truncate('posts');

        $posts = Post::factory(3)
            ->has(Comment::factory(3), 'comments')
            ->create();

        $posts->each(function (Post $post) {
            $post->users()->sync(FactoryHelper::getRandomModelId(User::class));
        });

        $this->enableForeignKey();
    }
}