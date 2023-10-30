@extends('layouts.layout')
@section('title', 'Оформление заказа')

@section('content')

<!-- Cart Header -->
<div class="container pt-5">
    <div class="row cart mb-3">
        <div class="col text-center">
            <h3>Оформление заказа</h3>
            <p>Убедитесь в выбранных товарах до оформления заказа</p>
        </div>
    </div>
</div>
<!-- End Cart Header -->

<!-- Breadcrumb -->
<div class="container">
    <nav>
        <ol class="breadcrumb bg-transparent">
            <li class="breadcrumb-item"><a href="/">Главная</a></li>
            <li class="breadcrumb-item active" aria-current="page">Оформление заказа</li>
        </ol>
    </nav>
</div>
<!-- End Breadcrumb -->

<section class="checkout">
    <div class="container pb-5">
        <div class="row mb-5 justify-content-between">
            <div class="col-lg-7">
                <h5 class="mb-4">Выбранные товары</h5>

                <!-- Items -->
                @foreach ($cartItems as $cartItem)
                <div class="checkout__item">
                    <div class="row">
                        <div class="col-4 col-sm-4 col-md-4 ">
                            @if ($cartItem->imagePath)
                            <img class="img-fluid" src="{{asset('/storage/'.$cartItem->imagePath)}}" alt="{{$cartItem->clothesName}}">
                            @else
                            <img class="img-fluid" src="img/empty.pmg" alt="empty">
                            @endif
                        </div>
                        <div class="col-8 col-sm-8 col-md-8 mt-1">
                            <div class="checkout__item-header">
                                <div class="checkout__item-header-name">{{$cartItem->clothesName}}</div>
                                <div class="checkout__item-header-btn-delete text-right">
                                    <a href="delete-from-cart-{{$cartItem->id}}" class="btn-delete" role="button">
                                        <i class="fa fa-trash-o fa-lg"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="checkout__item-details">
                                <div class="checkout__item-details-label">
                                    <span class="checkout__item-details-label-text">Размер: </span>
                                </div>
                                <div class="checkout__item-details-size-value">{{$cartItem->Size->sizeName}}</div>
                            </div>
                            <div class="checkout__item-details">
                                <div class="checkout__item-details-label">
                                    <span class="checkout__item-details-label-text">Цвет: </span>
                                </div>
                                <div class="checkout__item-details-color-value">{{$cartItem->Color->colorName}}</div>
                            </div>
                            <div class="checkout__item-details">
                                <div class="checkout__item-details-label">
                                    <span class="checkout__item-details-label-text">Цена: </span>
                                </div>
                                <div class="checkout__item-details-price-value">{{$cartItem->price}}&#8381;</div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
                <!-- Items End -->

            </div>

            <div class="col-lg-5">
                <h5 class="mb-4">Общая стоимость</h5>
                <div class="checkout__summary">
                    <div class="checkout__summary-line">
                        <div class="checkout__summary-line-label">{{$cart->totalItems}} товар(ов) на сумму</div>
                        <div class="checkout__summary-line-value">{{$cart->totalPrice}}&#8381;</div>
                    </div>
                    <div class="checkout__summary-line">
                        <div class="checkout__summary-line-label">Доставка</div>
                        <div class="checkout__summary-line-value">Бесплатно</div>
                    </div>
                    <hr>
                    <div class="checkout__summary-line">
                        <div class="checkout__summary-line-label">Всего к оплате</div>
                        <div class="checkout__summary-line-value">{{$cart->totalPrice}}&#8381;</div>
                    </div>
                </div>
                <h5 class="mb-4">Контактные данные</h5>
                <div class="checkout__contacts">
                    <form method="POST" action="{{ route('cart.create') }}" enctype="multipart/form-data" id="formCart">
                        @csrf
                        <input type="number" hidden id="PK_Cart" name="PK_Cart" value="{{$cart->id}}">

                        <span class="checkout__contacts-field">
                            <input type="text" class="form-control btn-outline-none" id="nameClient" name="nameClient" placeholder="Имя" required>
                        </span>
                        <span class="checkout__contacts-field">
                            <input type="tel" class="form-control btn-outline-none" id="phoneClient" name="phoneClient" placeholder="Телефон" required>
                        </span>
                        <span class="checkout__contacts-field">
                            <input type="email" class="form-control btn-outline-none" id="emailClient" name="emailClient" placeholder="E-mail" required>
                        </span>
                        <span>
                            <button type="submit" class="btn btn-block btn-outline-none btn-checkout-order">
                                <i class="fa fa-check fa-fw"></i>
                                <span>Оформить заказ</span>
                            </button>
                        </span>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection