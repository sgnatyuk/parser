<?php

namespace App\Infrastructure\Domain\Entity;

use App\Domain\Post\Entity\Post;
use App\Domain\Post\Entity\PostRepository;
use Illuminate\Support\Facades\DB;

class LumenPostRepository implements PostRepository
{
    public function findAll(): array
    {
        return DB::table('posts')
            ->orderBy('created_at', 'DESC')
            ->get()
            ->toArray();
    }

    public function findById(string $id): array
    {
        $post = DB::table('posts')
            ->where('id', $id)
            ->get()
            ->first();

        return json_decode(json_encode($post), true);
    }

    public function saveMany(array $entities): bool
    {
        return DB::transaction(
            function () use ($entities) {
                foreach ($entities as $post) {
                    if (!$post instanceof Post) {
                        continue;
                    }

                    $duplicate = DB::table('posts')
                        ->where('url', $post->getUrl())
                        ->first();

                    if ($duplicate) {
                        DB::table('posts')
                            ->where('url', $post->getUrl())
                            ->update(
                                [
                                    'title'      => $post->getTitle(),
                                    'image'      => $post->getImage(),
                                    'short'      => $post->getShort(),
                                    'text'       => json_encode($post->getText()),
                                    'updated_at' => $post->getUpdatedAt(),
                                ]
                            );
                    } else {
                        DB::table('posts')->insert(
                            [
                                'id'         => $post->getId()->getValue(),
                                'url'        => $post->getUrl(),
                                'title'      => $post->getTitle(),
                                'image'      => $post->getImage(),
                                'short'      => $post->getShort(),
                                'text'       => json_encode($post->getText()),
                                'created_at' => $post->getCreatedAt(),
                                'updated_at' => $post->getUpdatedAt(),
                            ]
                        );
                    }
                }

                return true;
            }
        );
    }
}
