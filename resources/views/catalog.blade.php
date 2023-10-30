@extends('layouts.layout')
@section('title', 'Каталог')

@section('content')

<!-- Catalog -->
<section class="catalog bg-light py-5">
    <div class="container">
        <div class="row mb-3">
            <div class="col">
                <h3>Все товары</h3>
            </div>
        </div>
        <div class="row">

            @foreach ($items as $item)

            <div class="col-12 col-sm-6 col-md-6 col-lg-3">
                <div class="catalog__item">
                    <a href="single-product-{{$item->id}}">
                        @if ($item->imagePath)
                        <img src="{{asset('/storage/'.$item->imagePath)}}" class="catalog__item-img" alt="{{$item->clothesName}}">
                        @else
                        <img src="img/empty.png" class="catalog__item-img" alt="empty">
                        @endif
                    </a>
                    <a href="single-product-{{$item->id}}">
                        <div class="catalog__item-info">
                            <div class="catalog__item-info-name">{{$item->clothesName}}</div>
                            <div class="catalog__item-info-price">{{$item->price}}&#8381;</div>
                        </div>
                    </a>
                    <div class="catalog__item-preview text-right">
                        <a href="#" class="btn-outline-none btn-item-preview" data-bs-target="#previewItem" data-iditem="{{ $item->id }}">
                            <i class="fa fa-info-circle fa-fw"></i>
                        </a>
                    </div>
                </div>
            </div>

            @endforeach
        </div>
    </div>
</section>
<!-- End Catalog -->

<!-- Modal Preview Item -->
<div class="modal fade" id="previewItem" tabindex="-1" role="dialog" aria-labelledby="previewItemLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <h4 class="modal-title" id="previewItemLabel">Информация о товаре</h4>
                <button type="button" class="close btn-outline-none" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">

                <p id="clothesName"></p>
                <p id="category"></p>
                <p id="price"></p>
                <p id="size"></p>
                <p id="color"></p>

            </div>

        </div>
    </div>
</div>
<!-- End Modal Preview Item -->


@endsection