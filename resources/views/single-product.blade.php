@extends('layouts.layout')

@section('title', $singleItem->clothesName)

@section('content')

<!-- Breadcrumb -->
<div class="container">
    <nav>
        <ol class="breadcrumb bg-transparent">
            <li class="breadcrumb-item"><a href="catalog">Каталог</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{$singleItem->name}}</li>
        </ol>
    </nav>
</div>
<!-- End Breadcrumb -->

<!-- Single Product -->
<section class="single-product">
    <div class="single-product__item">
        <div class="container">
            <div class="row">
                <div class="col-md-7">
                    <div class="single-product__item-img">
                        @if ($singleItem->imagePath)
                        <img class="img-fluid" src="{{ asset('/storage/'.$singleItem->imagePath) }}" alt="{{$singleItem->name}}">
                        @else
                        <img class="img-fluid" src="img/empty.png" alt="empty">
                        @endif
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="single-product__item-info">
                        <div class="single-product__item-info-name">{{$singleItem->name}}</div>
                        <div class="single-product__item-info-price">{{$singleItem->price}}&#8381;</div>

                        <div class="single-product__item-info-details">
                            <div class="single-product__item-info-details-label">
                                <span class="single-product__item-info-details-label-text">Размер: </span>
                            </div>
                            <div class="single-product__item-info-details-size-value">{{$singleItem->size->name}}</div>
                        </div>
                        <div class="single-product__item-info-details">
                            <div class="single-product__item-info-details-label">
                                <span class="single-product__item-info-details-label-text">Цвет: </span>
                            </div>
                            <div class="single-product__item-info-details-color-value">{{$singleItem->color->name}}</div>
                        </div>
                    </div>
                    <a href="add-item-to-cart-{{$singleItem->id}}" class="btn btn-block btn-outline-none single-product__item-btn-add-to-cart">
                        <i class="fa fa-shopping-cart fa-fw"></i>
                        <span>Добавить в корзину</span>
                    </a>
                    <div class="single-product__item-description">
                        <h4>ОПИСАНИЕ</h4>
                        <div class="single-product__item-description-text">
                            <?php echo nl2br($singleItem->desc) ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Single Product -->

@endsection
