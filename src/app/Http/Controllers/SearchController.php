<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Elastic\Elasticsearch\Client;


class SearchController extends Controller
{
    public function search(Request $request)
    {
        $query = $request->input('query');
        if(!$query){
            return redirect()->route('product.index');
        }

        $products = Product::search($query, ['name', 'description',]);
        return view('products.index', compact('products'))->with('query', $query);
    }
}
