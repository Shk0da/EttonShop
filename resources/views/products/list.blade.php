<table class="table table-hover">
    <thead>
    <tr>
        <th>#</th>
        <th>Название</th>
        <th>Цена</th>
        <th></th>
        <th></th>
    </tr>
    </thead>
    <tbody>
    @foreach($products as $id => $product)
        <tr>
            <th scope="row">{{ ++$id }}</th>
            <td>{{ $product->getName() }}</td>
            <td>{{ $product->getCost() }}</td>
            <td>
                <a class="add-in-cart" href="#"
                   data-id="{{ $product->getId() }}"
                   data-name="{{ $product->getName() }}"
                   data-cost="{{ $product->getCost() }}">
                    Добавить
                </a>
            </td>
            <td>
                <a class="del-from-cart" href="#"
                   data-id="{{ $product->getId() }}"
                   data-name="{{ $product->getName() }}"
                   data-cost="{{ $product->getCost() }}">
                    Убрать
                </a>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>

<script>
    $(function () {
        $('.add-in-cart').click(function (e) {
            e.preventDefault();
            var id = $(this).data('id');
            var name = $(this).data('name');
            var cost = $(this).data('cost');

            counts[id] = counts[id] ? counts[id] + 1 : 1;
            costs[id] = costs[id] ? costs[id] + cost : cost;

            if ($('#prod-row-'+id)) {
                $('#prod-row-'+id).remove();
            }

            var row = '<p id="prod-row-' + id + '">' + name + ' - ' + counts[id] + 'шт., стоимостью ' + (Math.round(costs[id] * 100) / 100) + '</p>';
            $('.cart-list-added').prepend(row);
            $('.sum-cart').html((Math.round(sum() * 100) / 100));
            $('.cart-list').removeClass('hidden');

            var dataInput = $('input[name="data"]');
            dataInput.val(JSON.stringify(counts));
            $('.create-order').removeClass('hidden');
        });

        $('.del-from-cart').click(function (e) {
            e.preventDefault();
            var id = $(this).data('id');
            var name = $(this).data('name');
            var cost = $(this).data('cost');

            counts[id] = counts[id] ? counts[id] - 1 : 0;
            costs[id] = (costs[id] > 0) ? costs[id] - cost : 0;

            if ($('#prod-row-'+id)) {
                $('#prod-row-'+id).remove();
            }

            if (counts[id] && costs[id]) {
                var row = '<p id="prod-row-' + id + '">' + name + ' - ' + counts[id] + 'шт., стоимостью ' + (Math.round(costs[id] * 100) / 100) + '</p>';
                $('.cart-list-added').prepend(row);
            }

            if (sum() > 0) {
                $('.sum-cart').html((Math.round(sum() * 100) / 100));
            } else {
                $('.create-order').addClass('hidden');
                $('.cart-list').addClass('hidden');
            }

            var dataInput = $('input[name="data"]');
            dataInput.val(JSON.stringify(counts));
        });

        function sum() {
            return costs.reduce(function(a, b) {
                return a + b;
            });
        }
    })
</script>