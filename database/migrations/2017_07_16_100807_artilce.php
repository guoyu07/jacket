<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Artilce extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('article', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title', 128);
            $table->unsignedInteger('user_id');
            $table->string('desc',255);
            $table->string('cover', 128);
            $table->unsignedInteger('category_id');
            $table->text('content');
            $table->text('markdown_content');
            $table->unsignedInteger('votes');
            $table->timestamps();
            $table->engine = 'innodb';
            $table->charset = 'utf8';
            $table->collation = 'utf8_unicode_ci';
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('article');
    }
}
