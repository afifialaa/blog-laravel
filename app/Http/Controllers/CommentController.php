<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Article;

class CommentController extends Controller
{

    // Read comments of an article
    function index(Request $request, $article_id){
        $article = Article::find($article_id);
        $comments = $article->comments;
        return reponse()->json(['comments' => $comments]);
    }

    // Creates a new comment
    function create(Request $request, $article_id){
        $comment = new Comment;
        $comment->content = $request->content;
        $comment->article_id = $article_id;
        $comment->user_id = $request->user_id;

        if($comment->save()){
            return response()->json(['msg' => 'Comment was created'], 200);
        }

        return response()->json(['msg' => 'Comment was not created'], 500);
    }

    // Delete a comment
    function delete(Request $request, $aricle_id, $id){
        Comment::findOrFail($id)->delete();
        $query = Comment::where('id', $id)->where('user_id', $request->user()->id);
        if($query){
            return response()->json(['msg' => 'Comment was deleted'], 200);
        }

        return response()->json(['msg' => 'Comment was not found'], 404);
    }

    


}


