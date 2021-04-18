<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->id('ID');

            $table->foreignId('user_ID')
                ->constrained()
                ->onDelete('cascade')
                ->on('users');

            $table->foreignId('category_ID')
                ->constrained()
                ->onDelete('cascade')
                ->on('categories');

            $table->boolean('published');
            $table->string('title', 150);
            $table->string('slug', 150);
            $table->string('description', 250);
            $table->string('preview', 250);
            $table->longText('content');

            $table->integer('views')->default(0);

            $table->date('created_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('articles');
    }
}
