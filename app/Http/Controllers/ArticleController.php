<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;

class ArticleController extends Controller
{
    // Muestra una lista de todos los artículos
    public function index()
    {
        $articles = Article::all();
        return response()->json(['articles' => $articles], 200);
    }

    // Muestra un artículo específico
    public function show($id)
    {
        $article = Article::find($id);
        if (!$article) {
            return response()->json(['message' => 'Artículo no encontrado'], 404);
        }
        return response()->json(['article' => $article], 200);
    }

    // Crea un nuevo artículo
    public function store(Request $request)
    {
        $article = new Article();
        $article->fill($request->all());
        $article->save();
        return response()->json(['article' => $article], 201);
    }

    // Actualiza un artículo existente
    public function update(Request $request, $id)
    {
        $article = Article::find($id);
        if (!$article) {
            return response()->json(['message' => 'Artículo no encontrado'], 404);
        }
        $article->fill($request->all());
        $article->save();
        return response()->json(['article' => $article], 200);
    }

    // Elimina un artículo existente
    public function destroy($id)
    {
        $article = Article::find($id);
        if (!$article) {
            return response()->json(['message' => 'Artículo no encontrado'], 404);
        }
        $article->delete();
        return response()->json(['message' => 'Artículo eliminado correctamente'], 200);
    }
}
