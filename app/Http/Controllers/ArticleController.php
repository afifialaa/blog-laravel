<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;

class ArticleController extends Controller
{
	// Creates a new article
    function create(Request $request){
		$article = new Article;

		$article->content = $request->content;
		$article->description = $request->description;
		$article->user_id = $request->user_id;
		$article->view_count = 0;

		$article->save();
		return response('Article was created', 201);
    }

	// Deletes an article
    function delete(Request $request, $id){
		Article::findOrFail($id)->delete();
		return response('Article was deleted', 200);
    }

	// Returns an article by id
	function read(Request $request, $id){
		$article = Article::find($id);
		$article->increment('view_count');
		return $article;
	}
}
