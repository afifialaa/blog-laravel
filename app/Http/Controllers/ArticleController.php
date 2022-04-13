<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;

class ArticleController extends Controller
{

	// Returns all articles 5 by 5
	function index(Request $request){
		// $articles = Article::all()->paginate(5);
		$articles = Article::paginate(5);
		return response()->json(['articles' => $articles], 200);
	}

	function paginate(Request $request, $page){
		$articles = Article::paginate()->url($page);
		$pagination = $articles->url($page);
		return response()->json(['articles' => $articles], 200);
	}


	// Creates a new article
    function create(Request $request){
		$article = new Article;

		$article->content = $request->content;
		$article->description = $request->description;
		$article->user_id = $request->user()->id;
		$article->view_count = 0;

		$article->save();
		return response()->json(['msg' => 'Article was created'], 201);
    }

	// Deletes an article
    function delete(Request $request, $id){
		$query = Article::where('id', $id)->where('user_id', $request->user()->id)->delete();
		if($query){
			return response()->json(['msg' => 'Article was deleted'], 200);
		}

		return response()->json(['msg' => 'Aritcle was not found'], 404);
    }

	// Returns an article by id
	function read(Request $request, $id){
		$article = Article::find($id);
		$article->increment('view_count');
		return response()->json(['article' => article], 200);
	}
}
