<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Exception;

class CategoryController extends Controller
{
    public function index()
    {
    
        {
            try {
                $categories= Category::all();
                return response()->json(['status' => 200, 'data' => $categories]);
            } catch (Exception $e) {
                return response()->json(['status' => 204, 'message' => $e->getMessage()], 204);
            }
        }
    }

    public function show($id)
    {
        try {
            $category = Category::find($id);
            return response()->json($category, 200);
        } catch (Exception $e) {
            return response()->json(['message' => 'Categoría no encontrada'], 404);
        }
    }

    // Método para crear una nueva categoría
    public function store(Request $request)
    {
        try {
            $category = Category::create($request->all());
            return response()->json($category, 201);
        } catch (Exception $e) {
            return response()->json(['message' => 'Error al crear la categoría'], 500);
        }
    }

    // Método para actualizar una categoría existente por su ID
    public function update(Request $request, $id)
    {
        try {
            $category = Category::find($id);
            $category->update($request->all());
            return response()->json($category, 200);
        } catch (Exception $e) {
            return response()->json(['message' => 'Error al actualizar la categoría'], 500);
        }
    }

    // Método para eliminar una categoría existente por su ID
    public function destroy($id)
    {
        try {
            $category = Category::find($id);
            $category->delete();
            return response()->json(['message' => 'Categoría eliminada correctamente'], 200);
        } catch (Exception $e) {
            return response()->json(['message' => 'Error al eliminar la categoría'], 500);
        }
    }
}

