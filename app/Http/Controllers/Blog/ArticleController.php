<?php

namespace App\Http\Controllers\Blog;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateOrUpdateArticleRequest;
use App\Models\Article;
use App\Models\Tags;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ArticleController extends Controller
{

    protected function fetchArticles(): JsonResponse
    {
        $articles = Article::with('tags')->withCount('tags')->orderByDesc('created_at')->get();
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

    // Increase count
    protected function viewIncrease(Article $article) {
        $article->increment('views', 1);
        $article->update();
    }
    // Increase like

    protected function likeIncrease(Article $article) {
        $article->increment('likes', 1);
    }



// For front end
    public function index(): JsonResponse
    {
       return $this->fetchArticles();
    }

    public function viewArticle(Article $article, $slug): JsonResponse
    {
        $article = $article->where('slug', $slug)->first();
        $article = $article->load('tags')->loadCount('tags');
        $this->viewIncrease($article);
        if ($article) {
            return response()->json([
                'article' => $article
            ], 200);
        }
        return response()->json([
            'message' => 'No articles found'
        ]);
    }

    public function likeArticle(Article $article, $slug, Request $request): JsonResponse
    {
        $validated = $request->validate(['likes' => 'boolean']);
        $article = $article->where('slug', $slug)->first();

        if ($validated['likes'] && $article) {
            $this->likeIncrease($article);
            return response()->json([
                "liked" => $validated['likes'],
                "count" => $article->likes,
                "article" => $article
            ]);
        } else {
            return response()->json([
                "liked" => $validated['likes'],
                "count" => $article->likes,
                "article" => $article
            ], 200);
        }
    }




// For backend
    public function articles(): JsonResponse
    {
        return $this->fetchArticles();
    }

    public function createArticle(CreateOrUpdateArticleRequest $request): JsonResponse
    {
        $article = Article::create($request->validated());

        if ($article) {
            $tags = $request->get('tags');
            $tagIds = [];

            foreach ($tags as $tag) {
                $tag = Tags::firstOrCreate(['name' => $tag['name']]);
                if ($tag) {
                    $tagIds[] = $tag->id;
                }
            }

            $article->tags()->sync($tagIds);
        }

        return response()->json([
            'message' => 'Article created',
        ], 200);
    }


}


