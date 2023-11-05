@extends('layouts.app')

@section('title', $product->clothesName)

@section('content')

    <div class="container">

        {{ Breadcrumbs::render('product', $product) }}

{{--        <nav>--}}
{{--            <ol class="breadcrumb bg-transparent">--}}
{{--                <li class="breadcrumb-item">--}}
{{--                    <a href="{{ route('web.catalog.index') }}">Каталог</a>--}}
{{--                </li>--}}
{{--                <li class="breadcrumb-item active" aria-current="page">{{ $product->name }}</li>--}}
{{--            </ol>--}}
{{--        </nav>--}}
    </div>

    <section class="single-product">
        <div class="single-product__item">
            <div class="container">
                <div class="row">
                    <div class="col-md-7">
                        <div class="single-product__item-img">
                            <img class="img-fluid"
                                 src="{{ asset($product->imagePath ? '/storage/' . $product->imagePath : 'img/empty.png') }}"
                                 alt="{{$product->name}}"
                            >
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="single-product__item-info">
                            <div class="single-product__item-info-name">{{ $product->name }}</div>
                            <div class="single-product__item-info-price">{{ $product->price }}&#8381;</div>

                            <div class="single-product__item-info-details">
                                <div class="single-product__item-info-details-label">
                                    <span class="single-product__item-info-details-label-text">Размер: </span>
                                </div>
                                <div class="single-product__item-info-details-size-value">{{ $product->size->name }}</div>
                            </div>
                            <div class="single-product__item-info-details">
                                <div class="single-product__item-info-details-label">
                                    <span class="single-product__item-info-details-label-text">Цвет: </span>
                                </div>
                                <div
                                    class="single-product__item-info-details-color-value">{{ $product->color->name }}</div>
                            </div>
                        </div>
                        <a href="add-item-to-cart-{{ $product->id }}"
                           class="btn btn-block btn-outline-none single-product__item-btn-add-to-cart">
                            <i class="fa fa-shopping-cart fa-fw"></i>
                            <span>Добавить в корзину</span>
                        </a>
                        <div class="single-product__item-description">
                            <h4>ОПИСАНИЕ</h4>
                            <div class="single-product__item-description-text">
                                <?php echo nl2br($product->desc) ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
