<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Favorite;
use App\Models\Article;

class FavoriteController extends Controller
{
    //

    function create(Request $request, $article_id)
    {
        $fav = new Favorite;
        $fav->user_id = request()->user()->id;
        $fav->article_id = $article_id;

        try {
            $fav->save();
            return response()->json(['msg' => 'Item was created']);
        } catch (\Illuminate\Database\QueryException $e){
            $errorCode = $e->errorInfo[1];
            if($errorCode == '1062'){
                return response()->json(['msg' => 'Item already exists'], 409);
            }
        }

    }

    function index(Request $request)
    {
        $favs = Favorite::where('user_id', $request->user()->id)->get('article_id');
        return response()->json(['favorites' => $favs], 200);
    }

    function read(Request $request, $article_id)
    {
        $fav = Favorite::where('article_id', $article_id)->where('user_id', request()->user()->id)->firstOrFail();
        return response()->json(['fav' => $fav], 200);
    }

    function delete(Request $request, $article_id)
    {
        $fav = Favorite::where('user_id', request()->user()->id)->where('article_id', $article_id)->firstOrFail();
        if($fav->delete()){
            return response()->json(['msg' => 'Item was deleted'], 200);
        }
        return response()->json(['msg' => 'Item was not deleted'], 500);
    }
}
