$(document).ready(function () {

    // Превью товара
    $(".btn-item-preview").click(function (e) {
        e.preventDefault();

        id_item = $(this).data("iditem");

        $.ajax({
            type: "GET",
            url: "/preview-item-" + id_item,
            success: function (data) {
                if (data.status === '1') {
                    $('#clothesName').text("Наименование: " + data.clothesName);
                    $('#color').text("Цвет: " + data.color);
                    $('#size').text("Размер: " + data.size);
                    $('#category').text("Категория: " + data.category);
                    $('#price').text("Цена: " + data.price);

                    $('#previewItem').modal("show");
                }
                else {
                    alert("Ошибка: " + data.message);
                }
            },
            error: function (msg) {
                alert(msg.responseJSON.message);
                console.log(msg);
            },
        });
    });

    // Добавление нового товара в БД
    $("#formAdd").submit(function (e) {
        e.preventDefault();

        $.ajax({
            type: "POST",
            url: "/add-item-to-db",
            data: new FormData(this),
            contentType: false,
            processData: false,

            success: function (data) {
                //если запись успешно добавлена, выводим сообщение об этом
                if (data.status == '1') {
                    $("#formAdd").after(
                        '<div class="alert alert-success" role="alert">' +
                        '<h3>Товар ' + data.clothesName + ' успешно добавлен</h3>' +
                        '<p><a href="single-product-' + data.id + '" class="alert-link">Перейти на страницу добавленного товара</a></p>' +
                        '</div>'
                    );
                }
                else {
                    //иначе выводим информацию об ошибке
                    alert(data.message);
                }
            },
            error: function (msg) {
                alert(msg.responseJSON.message);
            },
        });
    });

    // Удаление элемента из БД
    $(".btn-delete-ajax").click(function (e) {
        e.preventDefault();
        id = $(this).data("item-id");

        $.ajax({
            type: "DELETE",
            url: "/delete-response-from-db",
            headers: { 'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content') },
            data: { "id": id },
            success: function (data) {
                if (data.status == '1') {
                    $("#item_" + id).html(
                        '<div class="alert alert-success" role="alert">' +
                        data.name +
                        '</div>'
                    );
                }
                else {
                    alert("Error deleting item");
                }
            },
            error: function (msg) {
                alert(msg.responseJSON.message);
            },

        });
    });

    // Превью корзины с товарами
    $(".btn-preview").click(function (e) {
        e.preventDefault();

        $.ajax({
            type: "GET",
            url: "/preview-cart",
            success: function (data) {
                if (data.status === '1') {
                    $('#totalItems').text(data.cart.totalItems + ' товар(ов) на сумму');
                    $('#totalPrice').text(data.cart.totalPrice + '₽');

                    /* очистка блока с товарами корзины */
                    $('#items').empty();

                    /* заполнение блока с товарами корзины */
                    data.cartItems.forEach(function (item) {
                        var imagePath = item["imagePath"];
                        if (imagePath === "") imagePath = 'empty.png';
                        // item - один элемент массива, можно его рендерить как-угодно, например:
                        $('#items').append(
                            '<div class="preview-сart__item">' +
                            '<div class="row">' +
                            '<div class="col-4">' +
                            '<img class="img-fluid" src="/storage/' + imagePath + '" alt="' + item.clothesName + '"></img>' +
                            '</div>' +
                            '<div class="col-8">' +
                            '<div class="checkout__item-header">' + item["clothesName"] + '</div>' +
                            '<div class="checkout__item-details">' + item["price"] + '</div>' +
                            '<div class="checkout__item-details">' + item["size"] + '</div>' +
                            '<div class="checkout__item-details">' + item["color"] + '</div>' +
                            '</div>' +
                            '</div>' +
                            '</div>'
                        );
                    });

                    $('#previewCart').modal("show");
                }
                else {
                    alert("Ошибка: " + data.message);
                }
            },
            error: function (msg) {
                alert(msg.responseJSON.message);
                console.log(msg);
            },
        });
    });
})