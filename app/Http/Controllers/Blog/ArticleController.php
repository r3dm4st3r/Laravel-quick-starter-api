<?php

namespace App\Http\Controllers\Blog;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateOrUpdateArticleRequest;
use App\Models\Article;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class ArticleController extends Controller
{

    protected function fetchArticles(): JsonResponse
    {
        $articles = DB::table('articles')->orderByDesc('created_at')->get();
        $count = count($articles);

        if ($count > 0) {
            return response()->json([
                'data' => $articles,
                'total' => $count
            ]);
        } else {
            return response()->json([
                'message' => 'No articles found'
            ]);
        }
    }

// For front end
    public function index(): JsonResponse
    {
       return $this->fetchArticles();
    }

// For backend
    public function articles(): JsonResponse
    {
        return $this->fetchArticles();
    }

    public function createArticle(CreateOrUpdateArticleRequest $request): JsonResponse
    {
        Article::create($request->validated());
        return response()->json([
            'message' => 'Article created',
        ], 200);
    }


}


