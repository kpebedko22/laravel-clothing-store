@extends('layouts.layout')
@section('title', 'Администрирование товаров')

@section('content')

<!-- Catalog -->
<section class="catalog-admin bg-light py-5">
    <div class="container">
        <div class="row mb-3">
            <div class="col-12 col-sm-6 col-md-6 col-lg-3">
                <a href="create-item" class="btn btn-block btn-outline-none btn-add-new-item">
                    <i class="fa fa-check fa-fw"></i>
                    <span>Добавить</span>
                </a>
            </div>
        </div>
        <div class="row">
            @foreach ($items as $item)

            <div class="col-12 col-sm-6 col-md-6 col-lg-3" id="item_{{ $item->id }}">
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
                    <div class="col">
                        <a href="edit-item-{{$item->id}}" role="button" class="btn btn-block btn-outline-none btn-edit-item">
                            <i class="fa fa-pencil fa-fw"></i>
                            <span>Изменить</span>
                        </a>
                        <!-- <form method="POST" action="delete-from-db-{{ $item->id }}">
                            @method('DELETE')
                            @csrf
                            <button type="submit" class="btn btn-block btn-outline-none btn-del-item">
                                <i class="fa fa-trash-o fa-fw"></i>
                                <span>Удалить</span>
                            </button>
                        </form> -->

                        <a href="" class="btn btn-block btn-outline-none btn-del-item btn-delete-ajax" data-item-id="{{ $item->id }}">
                            <i class="fa fa-trash-o fa-fw"></i>
                            <span>Удалить</span>
                        </a>
                    </div>
                </div>
            </div>

            @endforeach
        </div>
    </div>
</section>
<!-- End Catalog -->

@endsection