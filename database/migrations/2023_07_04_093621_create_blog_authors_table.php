<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blog_authors', function (Blueprint $table) {
            $table->integer('blog_id')->unsigned();
            $table->integer('author_id')->unsigned();
            // $table->foreign('blog_id')->references('id')->on('blogs')->onDelete('cascade');
            // $table->foreign('author_id')->references('id')->on('authors')->onDelete('cascade');
            $table->unique(['blog_id', 'author_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('blog_authors');
    }
};
