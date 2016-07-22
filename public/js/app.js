$(function () {
    window.counts = {};
    window.costs = [];

    $('.product-type a').click(function (e) {
        e.preventDefault();
        var productid = $(this).data('productid');

        $.get('/product/sub', {parentId: productid})
            .done(function (data) {
                if (data) {
                    $('.product-list').html(data);
                    $('.product-sub-list').removeClass('hidden');
                }
            });

    });
});
