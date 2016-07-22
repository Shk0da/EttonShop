@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Выберите товары для заказа</div>

                    <div class="panel-body text-center">
                        <div class="row product-type-list">
                            @foreach($products as $product)
                                <div class="col-md-3 product-type">
                                    <a href="#" data-productid="{{ $product->getId() }}">{{ $product->getName() }}</a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="panel panel-info product-sub-list hidden">
                    <div class="panel-body product-list"></div>
                </div>

                <form action="" method="post">
                <div class="panel panel-success cart-list hidden">
                    <div class="panel-heading">Ваш заказ</div>
                    <div class="panel-body cart-list-added">
                        <p class="text-right">Итого: <span class="sum-cart"></span></p>
                    </div>
                </div>
                <div class="text-right create-order hidden">
                    {{ csrf_field() }}
                    <input type="hidden" name="data" value="">
                    <button type="submit" class="btn btn-success">Оформить</button>
                </div>
                </form>
            </div>
        </div>
    </div>
@endsection
