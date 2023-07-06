<?php

namespace App\Http\Controllers;

use App\Http\Requests\BlogRequest;
use App\Models\Author;
use App\Models\Blog;
use Illuminate\Http\Request;

class BlogAuthorController extends Controller
{
    public function createBlog(Request $request) {
        $blog = Blog::create([
            'title' => 'blog 1',
            'body' => 'blog 1 body',
            'comment' => 'blog 1 comment',
        ]);

        $author = Author::create([
            'name' => 'author 1',
        ]);

        $blog->authors()->attach($author->id);
        return 'ok';
    }

    public function createBlog2(BlogRequest $request) {

        return 123;
    }
}
