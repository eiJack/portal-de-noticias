<?php

namespace App\Http\Controllers\Api\Public;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Notice;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function home(Request $request)
    {
        $perCategory = (int) $request->query('per_category', 6);
        $categoryLimit = (int) $request->query('category_limit', 8);

        $perCategory = max(1, min($perCategory, 12));
        $categoryLimit = max(1, min($categoryLimit, 20));

        $highlight = Notice::select(
                'id',
                'category_id',
                'title',
                'description',
                'path_image',
                'slug',
                'created_at',
                'updated_at'
            )
            ->with('category:id,name,slug')
            ->latest()
            ->first();

        $categories = Category::select('id', 'name', 'slug')
            ->latest()
            ->limit($categoryLimit)
            ->get();

        $categories->each(function ($category) use ($perCategory) {
            $notices = Notice::select(
                    'id',
                    'category_id',
                    'title',
                    'description',
                    'path_image',
                    'slug',
                    'created_at',
                    'updated_at'
                )
                ->where('category_id', $category->id)
                ->latest()
                ->limit($perCategory)
                ->get();

            $category->setRelation('notices', $notices);
        });

        return response()->json([
            'data' => [
                'highlight' => $highlight,
                'categories' => $categories,
            ],
        ], 200);
    }

    public function list()
    {
        $categories = Category::select('id', 'name', 'slug')
            ->orderBy('name')
            ->get();

        return response()->json([
            'data' => $categories,
        ], 200);
    }

    public function index(Request $request, string $slug)
    {
        $perPage = (int) $request->query('per_page', 10);
        $perPage = max(1, min($perPage, 20));

        $category = Category::select('id', 'name', 'slug')
            ->where('slug', $slug)
            ->firstOrFail();

        $notices = Notice::select(
                'id',
                'category_id',
                'title',
                'description',
                'path_image',
                'slug',
                'created_at',
                'updated_at'
            )
            ->with('category:id,name,slug')
            ->where('category_id', $category->id)
            ->latest()
            ->paginate($perPage);

        return response()->json([
            'category' => $category,
            'notices' => $notices,
        ], 200);
    }
}
