<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    public function getSub(Request $request)
    {
        if (!$request->ajax()) {
            abort(404);
        }

        $parentId = $request->get('parentId');

        if (!$parentId) {
            echo 'Ничего нет(';
            exit();
        }

        $products = Product::where('parent_id', $parentId)->get();

        if (!count($products)) {
            $products = Product::where('id', $parentId)->get();
        }

        $view = view('products.list');
        $view->with('products', $products);

        echo $view;
        exit();
    }
}

