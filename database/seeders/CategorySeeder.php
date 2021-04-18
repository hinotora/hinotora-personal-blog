<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class CategorySeeder extends Seeder
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
                'name' => 'PHP Series',
                'description' => 'All about PHP language',
                'slug' => 'php-series',
                'preview' => 'https://sun9-70.userapi.com/impg/hOu3gLjMPv6AMf7fAHw68cc1btsKPU_YM1_r9A/-BXDWBA-cSQ.jpg?size=700x392&quality=96&sign=eb60b157b8b3967348231798864a1826',
            ],
            [
                'name' => 'WEB Development',
                'description' => 'What is web development?',
                'slug' => 'web-development',
                'preview' => 'https://sun9-61.userapi.com/impg/526ZcvzYIzCMyzu-NHCSJQO-FXVVV_L7pa6nig/vsXxmp9pndo.jpg?size=700x392&quality=96&sign=290723fb860e67cf7d4154c9967d2c58',
            ],
        ];

        DB::table('categories')->insert($data);
    }
}
