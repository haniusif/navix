<?php

// Newsroom articles — ordered newest-first; the first entry is the featured story.
// Text (title, body, dateline, signatories…) lives in lang/{locale}/news.php under
// articles.{key}.*  — this file holds only structural metadata.
return [
    'articles' => [
        'navix-m5azn-partnership' => [
            'slug' => 'navix-m5azn-partnership',
            'key' => 'm5azn',
            'date' => '2026-06-23',
            'cover' => 'images/news/main.jpeg',
            'gallery' => ['images/news/1.jpeg', 'images/news/2.jpeg', 'images/news/3.jpeg'],
        ],
    ],
];
