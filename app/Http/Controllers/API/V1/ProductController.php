<?php

namespace App\Http\Controllers\API\V1;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Product::all();
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
            'price' => 'required',
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
            Product::create($request->all());
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
    public function show(Product $product)
    {
        return $product;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $rules =[
            'name' => 'required|max:30',
            'description' => 'max:255',
            'price' => 'required',
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
            $product->update($request->all());
            return response()->json([
                'message' => 'Producto actualizado exitosamente'
            ], 200);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return response()->json([
            'message' => 'Producto eliminado exitosamente'
        ], 200);
    }
}
