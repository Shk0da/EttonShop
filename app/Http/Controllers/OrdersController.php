<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class OrdersController extends HomeController
{

    public function getIndex(Request $request)
    {
        $view = $this->view;
        $listView = view('orders.list');

        $orders = $this->user->orders;

        if ($request->has('sort')) {
            $sort = $request->get('sort');

            switch ($sort) {
                case 'date_desc':
                    $orders = $this->user->orders()->orderBy('created_at', 'desc')->get();
                    break;
                case 'date_asc':
                    $orders = $this->user->orders()->orderBy('created_at', 'asc')->get();
                    break;
                case 'count_desc':
                    $orders = $this->user->orders()->orderBy('count', 'desc')->get();
                    break;
                case 'count_asc':
                    $orders = $this->user->orders()->orderBy('count', 'asc')->get();
                    break;
            }
        }

        $listView->with('orders', $orders);
        $view->with('content', $listView);

        return $view;
    }

    public function getNew()
    {
        $view = $this->view;
        $products = Product::NotParent()->get();
        $content = view('orders.new');
        $content->with('products', $products);
        $view->with('content', $content);

        return $view;
    }

    public function postNew(Request $request)
    {
        $data = $request->get('data');
        $data = json_decode($data);

        $sum_count = 0;
        $order_data = [];
        foreach ($data as $id => $count) {
            $product = Product::find($id);

            if (!$product || !$count) continue;

            $order_data[] = [
                'id' => $id,
                'name' => $product->getName(),
                'cost' => $product->getCost(),
                'count' => $count,
            ];

            $sum_count += $count;
        }

        $data = json_encode($order_data);

        $order = new Order;
        $order->id = $this->createId();
        $order->user_id = $this->user->id;
        $order->data = $data;
        $order->count = $sum_count;
        $order->save();

        return redirect()->action('OrdersController@getIndex');
    }

    protected function createId()
    {
        return hash('fnv164', $this->user->id . time());
    }

}

