<?php

namespace App\Http\Controllers\API\V1;

use App\Models\Sale;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class SalesController extends Controller
{

    public function index()
    {
        return Sale::all();
    }

    public function store(Request $request)
    {
        $amount = 0.0;
        $products_sell = [];
        foreach ($request->products_id as $id)
        {
            $product = DB::select('SELECT * FROM products WHERE id = ?', [$id]);
            $amount += $product[0]->price;
            $products_sell[] = $product;
        }

        $sale = Sale::create([
            "user_id" => $request->user()->id,
            "amount" => $amount,
        ]);

        foreach ($request->products_id as $id)
        {
            $sale->products()->attach($id);
        }

        return response()->json([
            'message' => 'La compra se realizo exitosamente',
            'data' => $sale
        ], 201);
    }

    public function show(Sale $sale)
    {
        return $sale;
    }

    public function destroy(Sale $sale)
    {
        $sale->delete();
        return response()->json([
            'message' => 'La venta ha sido eliminada exitosamente',
            'data' => $sale
        ], 200);
    }

    public function getSalesConfirmed($confirmed)
    {
        if($confirmed === "false") $confirmed = 0;
        if($confirmed === "true") $confirmed = 1;
        if($confirmed)
        {
            $sales = Sale::all();
            $salesConfirmed = $sales->where('confirmed', 1);
            return $salesConfirmed;
        }
        else
        {
            $sales = Sale::all();
            $salesNotConfirmed = $sales->where('confirmed', 0);
            return $salesNotConfirmed;
        }
    }

    public function confirmSell(Sale $sale)
    {
        if($sale->confirmed === 0)
        {
            $sale->confirmed = 1;
            $sale->save();
            return response()->json([
                "message" => "Venta confirmada exitosamente",
                "sale" => $sale
            ], 200);
        }
        else
        {
            $sale->confirmed = 0;
            $sale->save();
            return response()->json([
                "message" => "Venta confirmada cancelada",
                "sale" => $sale
            ], 200);
        }
    }

    public function getUserSales(Request $request)
    {
        $id = $request->user()->id;
        $sales = DB::select('SELECT * FROM sales WHERE user_id = ?', [$id]);
        return $sales;
    }
}
