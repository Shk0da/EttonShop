@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Ваши заказы</div>

                    <div class="panel-body">
                        @if (!count($orders))
                            Вы еще не делали заказов
                        @else
                            <p>Сортировка: <a href="?sort=date_desc" class="date-sort">новые</a>,
                            <a href="?sort=date_asc" class="date-sort">старые</a>,
                            <a href="?sort=count_desc" class="count-sort">много позиций</a>,
                            <a href="?sort=count_asc" class="count-sort">мало позиций</a>,
                            </p>
                            @foreach($orders as $id => $order)
                                <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                                    <div class="panel panel-default">
                                        <div class="panel-heading" role="tab" id="headingThree">
                                            <h4 class="panel-title">
                                                <a class="collapsed" role="button" data-toggle="collapse"
                                                   data-parent="#accordion" href="#collapse{{ $id }}" aria-expanded="false"
                                                   aria-controls="collapseThree">
                                                    {{ $order->getDate() }}
                                                </a>
                                            </h4>
                                        </div>
                                        <div id="collapse{{ $id }}" class="panel-collapse collapse" role="tabpanel"
                                             aria-labelledby="headingThree">
                                            <div class="panel-body">
                                                <table class="table table-hover">
                                                    <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Название</th>
                                                        <th>Кол-во</th>
                                                        <th>Цена</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($order->getData() as $id => $product)
                                                        <tr>
                                                            <th scope="row">{{ ++$id }}</th>
                                                            <td>{{ $product->name }}</td>
                                                            <td>{{ $product->count }}</td>
                                                            <td>{{ $product->cost }}</td>
                                                        </tr>
                                                    @endforeach
                                                    </tbody>
                                                </table>
                                                <p class="text-right">Итого: <span class="sum-cart">{{ $order->getSum() }}</span></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
