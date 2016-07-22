@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Панель управления</div>

                    <div class="panel-body text-center">
                        <p>Вы успешно авторизовались!</p>
                        <p>Теперь вы можете создать новый заказ: </p>
                        <p><a href="{{ url('/orders/new') }}" class="btn btn-success">Создать заказ</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
