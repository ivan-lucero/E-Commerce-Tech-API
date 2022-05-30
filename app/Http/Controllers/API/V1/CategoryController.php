<?php

namespace App\Http\Controllers\API\V1;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Category::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules =[
            'name' => 'required|max:30',
            'description' => 'max:255',
        ];
        $messages = [
            'required' => 'Este campo es obligatorio'
        ];
        $validator = Validator::make($request->all(), $rules, $messages);

        if($validator->fails())
        {
            return response()->json([
                'validation_errors' => $validator->messages()
            ], 422);
        }
        else
        {
            Category::create($request->all());
            return response()->json([
                'message' => 'Categoria creada exitosamente'
            ], 201);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        return $category;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $rules =[
            'name' => 'required|max:30',
            'description' => 'max:255',
        ];
        $messages = [
            'required' => 'Este campo es obligatorio'
        ];
        $validator = Validator::make($request->all(), $rules, $messages);

        if($validator->fails())
        {
            return response()->json([
                'validation_errors' => $validator->messages()
            ], 422);
        }
        else
        {
            $category->update($request->all());
            return response()->json([
                'message' => 'Categoria actualizada exitosamente'
            ], 200);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return response()->json([
            'message' => 'Categoria eliminada exitosamente'
        ], 200);
    }
}
