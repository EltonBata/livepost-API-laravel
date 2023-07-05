<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Post;
use Database\Seeders\Traits\DisableForeignKey;
use Database\Seeders\Traits\TruncateTable;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CommentSeeder extends Seeder
{

    use TruncateTable, DisableForeignKey;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->disableForeignKey();

        $this->truncate('comments');

        Comment::factory(3)
            // ->for(Post::factory(1), 'post')
            ->create();

        $this->enableForeignKey();
    }
}