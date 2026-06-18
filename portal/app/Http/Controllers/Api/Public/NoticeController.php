<?php


namespace App\Http\Controllers\Api\Public;

use App\Http\Controllers\Controller;
use App\Models\Notice;
use Illuminate\Http\Request;

class NoticeController extends Controller
{
    public function latest(Request $request)
    {
        $perPage = (int) $request->query('per_page', 12);
        $perPage = max(1, min($perPage, 24));

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
            ->latest()
            ->paginate($perPage);

        return response()->json($notices, 200);
    }

    public function search(Request $request)
    {
        $term = $request->query('term');

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
            ->where('title', 'like', "%{$term}%")
            ->orWhere('description', 'like', "%{$term}%")
            ->orWhere('notice', 'like', "%{$term}%")
            ->paginate(12);

        return response()->json($notices, 200);
    }

    public function show(string $slug)
    {
        $notice = Notice::select(
                'id',
                'category_id',
                'title',
                'description',
                'notice',
                'path_image',
                'slug',
                'created_at',
                'updated_at'
            )
            ->with('category:id,name,slug')
            ->where('slug', $slug)
            ->firstOrFail();

        return response()->json([
            'data' => $notice,
        ], 200);
    }
}
