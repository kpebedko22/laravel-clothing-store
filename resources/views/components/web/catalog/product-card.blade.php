<div class="col-12 col-sm-6 col-md-6 col-lg-3">
    <div class="catalog__item">
        <a href="{{ route('web.products.show', $item->slug) }}">
            <img src="{{ asset($item->imagePath ? '/storage/' . $item->imagePath : 'img/empty.png') }}"
                 class="catalog__item-img"
                 alt="{{ $item->name }}"
            >
        </a>
        <a href="{{ route('web.catalog.category', $item->category->path) }}">
            {{ $item->category->name }}
        </a>
        <a href="{{ route('web.products.show', $item->slug) }}">
            <div class="catalog__item-info">
                <div class="catalog__item-info-name">{{ $item->name }}</div>
                <div class="catalog__item-info-price">{{ $item->price . '₽' }}</div>
            </div>
        </a>
        <div class="catalog__item-preview text-right">
            <a href="#" class="btn-outline-none btn-item-preview"
               data-bs-target="#previewItem"
               data-iditem="{{ $item->id }}"
            >
                <i class="fa fa-info-circle fa-fw"></i>
            </a>
        </div>
    </div>
</div>

@pushonce('scripts')
    <div class="modal fade"
         id="previewItem"
         tabindex="-1"
         role="dialog"
         aria-labelledby="previewItemLabel"
    >
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="previewItemLabel">Информация о товаре</h4>
                    <button type="button" class="close btn-outline-none" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p id="name"></p>
                    <p id="category"></p>
                    <p id="price"></p>
                    <p id="size"></p>
                    <p id="color"></p>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function () {
            $(".btn-item-preview").click(function (e) {
                e.preventDefault();

                let productId = $(this).data("iditem");

                $.ajax({
                    type: "GET",
                    url: "/preview-item-" + productId,
                    success: function (data) {
                        if (data.status === '1') {
                            $('#name').text("Наименование: " + data.name);
                            $('#color').text("Цвет: " + data.color);
                            $('#size').text("Размер: " + data.size);
                            $('#category').text("Категория: " + data.category);
                            $('#price').text("Цена: " + data.price);

                            $('#previewItem').modal("show");
                        } else {
                            alert("Ошибка: " + data.message);
                        }
                    },
                    error: function (msg) {
                        alert(msg.responseJSON.message);
                        console.log(msg);
                    },
                });
            });
        });
    </script>
@endpushonce
