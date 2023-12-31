<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ArticleRequest;
use App\Http\Resources\ArticleResource;
use Illuminate\Support\Facades\Storage;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $articles = Article::orderBy('created_at', 'desc')->paginate(3);
        
        $articlesResource = ArticleResource::collection($articles);

        $paginationData = [
            'prev_page_url' => $articles->previousPageUrl(),
            'next_page_url' => $articles->nextPageUrl(),
            'current_page' => $articles->currentPage(),
        ];

        $data = collect($paginationData)->merge(['articles' => $articlesResource]);

        return response()->json($data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'required|image',
            'content' => 'required|string',
            'short_description' => 'required|string',
        ]);
        
        $imagePath = $request->file('image')->store('public/articles');

        $validatedData['user_id'] = Auth::id();
        $validatedData['image'] = Storage::url($imagePath);

        Article::create($validatedData);

        return response()->json([
            'message' => 'Article successfully created',
        ]); 
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $article = new ArticleResource(Article::with(['comments' => function ($query) {
            $query->orderBy('created_at', 'desc');
        }, 'comments.user'])->find($id));
        
        $additional = [
            'commentable_type' => (new Article())->getMorphClass(),
        ];

        $data = collect($additional)->merge($article);

        return response()->json($data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    { 
        $article = Article::find($id);

        $validations = [
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'short_description' => 'required|string',
        ];

        if(asset($article->image) !== $request->image) {
            $validations['image'] = 'required|image';
        }
        
        $validatedData = $request->validate($validations);

        if($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('public/articles');
            
            $validatedData['image'] = Storage::url($imagePath);
        }

        $validatedData['user_id'] = Auth::id();

        $article->update($validatedData);

        return response()->json([
            'message' => 'Article successfully updated',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Article::destroy($id);
    }
}
