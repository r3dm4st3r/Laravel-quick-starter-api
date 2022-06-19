<?php

namespace App\Http\Controllers\Blog;

use App\Http\Controllers\Controller;
use App\Models\Tags;
use Illuminate\Http\JsonResponse;

class TagController extends Controller
{
    public function index(): JsonResponse
    {
        $tags = Tags::withCount('articles')->orderBydesc('created_at')->get();
        if ($tags) {
            return response()->json([
                'data' => $tags,
            ]);
        }
        return response()->json([
            'message' => 'No tags found'
        ], 404);
    }


    public function viewTag(Tags $tag, $slug): JsonResponse
    {
        $tag = $tag->where('slug', $slug)->get();

        if (count($tag) > 0) {
            $tag = $tag->load('articles')->loadCount('articles');
            return response()->json([
                'data' => $tag,
            ]);
        }
        return response()->json([
            'message' => 'No tags found'
        ]);
    }


}
