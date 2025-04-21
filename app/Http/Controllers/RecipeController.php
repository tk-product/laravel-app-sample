<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\RecipeSearchService;

class RecipeController extends Controller
{
    public function search(Request $request)
    {
        $word = $request->input('voiceInput');
        $results = app(RecipeSearchService::class)->searchRecipes($word);

        return view('recipes.result', compact('results'));
    }
}
