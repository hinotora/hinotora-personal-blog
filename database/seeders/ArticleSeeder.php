<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'user_ID'=> 1,
                'category_ID'=> 1,
                'published'=> 1,
                'title'=> 'You first PHP hello world script',
                'slug'=> 'you-first-php-hello-world-script',
                'description'=> 'Let\' make your first hello world application on PHP',
                'preview'=> 'https://sun9-70.userapi.com/impg/hOu3gLjMPv6AMf7fAHw68cc1btsKPU_YM1_r9A/-BXDWBA-cSQ.jpg?size=700x392&quality=96&sign=eb60b157b8b3967348231798864a1826',
                'content'=> '<p> Wow, much html, such text </p>',
                'views'=> 100,
                'created_at'=> now(),
            ],
            [
                'user_ID'=> 1,
                'category_ID'=> 2,
                'published'=> 1,
                'title'=> 'Let\'s hack somebody using python',
                'slug'=> 'lets-hack-somebody-using-python',
                'description'=> 'Actually, no, just write your first program',
                'preview'=> 'https://res.cloudinary.com/practicaldev/image/fetch/s--4qOOlINZ--/c_imagga_scale,f_auto,fl_progressive,h_420,q_auto,w_1000/https://cdn-images-1.medium.com/max/1600/0%2AGEsDQGQ1BucUNW1g',
                'content'=> '<p> Wow, much html, such text </p>',
                'views'=> 10,
                'created_at'=> now(),
            ]
        ];

        DB::table('articles')->insert($data);
    }
}
