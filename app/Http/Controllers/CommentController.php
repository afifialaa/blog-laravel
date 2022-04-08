<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Article;

class CommentController extends Controller
{

    // Creates a new comment
    function create(Request $request, $article_id){
        $comment = new Comment;
        $comment->content = $request->content;
        $comment->article_id = $article_id;
        $comment->user_id = $request->user_id;

        $comment->save();
        return response('Comment was created', 201);
    }

    // Delete a comment
    function delete(Request $request, $aricle_id, $id){
        Comment::findOrFail($id)->delete();
        return response('Comment was deleted', 200);
    }

    // Read comments of an article
    function read(Request $request, $article_id){
        $article = Article::find(1);
        return $article->comments;
    }


}


