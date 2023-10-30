<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark sticky-top">
    <div class="container">
        <a class="navbar-brand" href="/">
            <img src="img/logo_new.png" alt="store-logo">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mx-auto">
                <li class="nav-item @if ($_SERVER['REQUEST_URI'] == '/') active @endif">
                    <a class="nav-link" href="/">Главная</a>
                </li>
                <li class="nav-item @if ($_SERVER['REQUEST_URI'] == '/catalog') active @endif">
                    <a class="nav-link" href="catalog">Каталог</a>
                </li>
                <li class="nav-item @if ($_SERVER['REQUEST_URI'] == '/products-administration') active @endif">
                    <a class="nav-link" href="products-administration">Администрирование товаров</a>
                </li>
            </ul>
            <div class="nav-shopping-bag">
                <a class="nav-link btn-preview" href="cart" data-bs-toggle="modal" data-bs-target="#previewCart">
                    <i class="fa fa-shopping-cart fa-fw"></i>
                    <span class="hover">Корзина (</span>
                    <span class="nav-shopping-bag__num-items">{{$numCartItems}}</span>
                    <span class="hover">)</span>
                </a>
            </div>
        </div>
    </div>
</nav>
<!-- End Navbar -->

<!-- Modal Preview Cart -->
<div class="modal fade" id="previewCart" tabindex="-1" role="dialog" aria-labelledby="previewCartLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <h4 class="modal-title" id="previewCarLabel">Корзина</h4>
                <button type="button" class="close btn-outline-none" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">

                <div class="checkout__summary">
                    <div class="checkout__summary-line">
                        <div class="checkout__summary-line-label" id='totalItems'></div>
                        <div class="checkout__summary-line-value" id='totalPrice'></div>
                    </div>
                </div>

                <div class='preview-сart__items' id="items"></div>

                <a href="cart" class="btn btn-block btn-outline-none preview-сart__btn-go-to-cart">
                    <i class="fa fa-shopping-cart fa-fw"></i>
                    <span>Перейти в корзину</span>
                </a>
            </div>

        </div>
    </div>
</div>
<!-- End Modal Preview Cart -->