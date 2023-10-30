@extends('layouts.layout')

@section('title')
@if ($item->exists)
Редактирование товара
@else
Добавление товара
@endif
@endsection

@section('content')

<!-- Breadcrumb -->
<div class="container">
    <nav>
        <ol class="breadcrumb bg-transparent">
            <li class="breadcrumb-item"><a href="products-administration">Администрирование товаров</a></li>
            <li class="breadcrumb-item active" aria-current="page">
                @if ($item->exists)
                Редактирование товара
                @else
                Добавление товара
                @endif
            </li>
        </ol>
    </nav>
</div>
<!-- End Breadcrumb -->

<!-- Product Editing -->
<section class="product-editing">
    <div class="container">
        <div class="row mb-3">
            <div class="col">
                <h3>
                    @if ($item->exists)
                    Редактирование товара
                    @else
                    Добавление товара
                    @endif
                </h3>
            </div>
        </div>

        <div class="row">
            <div class="col col-12 col-lg-6 ">

                @if ($item->exists)
                <form method="POST" action="{{ route('clothes.update', $item->id) }}" enctype="multipart/form-data" id="formEdit">
                    @else
                    <form method="POST" action="{{ route('clothes.add') }}" enctype="multipart/form-data" id="formAdd">
                        @endif
                        @csrf

                        <span class="product-editing__edit-field">
                            <input type="text" class="form-control btn-outline-none" id="clothesName" name="clothesName" placeholder="Наименование" value="{{ old( 'clothesName', $item->clothesName) }}" required>
                        </span>
                        <span class="product-editing__edit-field">
                            <select class="form-control btn-outline-none" id="PK_Category" name="PK_Category" required>
                                @foreach ($categories as $category)
                                <option @if ( $category->id == $item->PK_Category ) selected @endif
                                    id = "CategoryPK" name="CategoryPK" value="{{ $category->id }}">
                                    {{ $category->categoryName }}
                                </option>
                                @endforeach

                            </select>
                        </span>
                        <span class="product-editing__edit-field">
                            <select class="form-control btn-outline-none" id="PK_Size" name="PK_Size" required>
                                @foreach ($sizes as $size)
                                <option @if ( $size->id == $item->PK_Size ) selected @endif
                                    id = "SizePK" name="SizePK" value="{{ $size->id }}">
                                    {{ $size->sizeName }}
                                </option>
                                @endforeach
                            </select>
                        </span>
                        <span class="product-editing__edit-field">
                            <select class="form-control btn-outline-none" id="PK_Color" name="PK_Color" required>
                                @foreach ($colors as $color)
                                <option @if ( $color->id == $item->PK_Color ) selected @endif
                                    id = "ColorPK" name="ColorPK" value="{{ $color->id }}">
                                    {{ $color->colorName }}
                                </option>
                                @endforeach
                            </select>
                        </span>
                        <span class="product-editing__edit-field">
                            <input type="number" class="form-control btn-outline-none" id="price" name="price" placeholder="Цена" min="0" value="{{ old('price', $item->price) }}" required>
                        </span>
                        <span class="product-editing__edit-field">
                            <label for="imagePath">Фото</label>
                            <input type="file" class="form-control-file btn-outline-none" id="imagePath" name="imagePath" value="{{ $item->imagePath }}" required>
                        </span>
                        <span class="product-editing__edit-field">
                            <textarea class="form-control btn-outline-none" id="description" name="description" placeholder="Описание" required>
                            {{ old('description', $item->description) }}
                            </textarea>
                        </span>
                        <span class="product-editing__edit-field">
                            <button type="submit" class="btn btn-block btn-outline-none ">
                                <i class="fa fa-save fa-fw"></i>
                                <span>
                                    @if ($item->exists)
                                    Сохранить
                                    @else
                                    Добавить
                                    @endif
                                </span>
                            </button>
                        </span>
                    </form>
            </div>
        </div>
    </div>
</section>
<!-- Product Editing -->


@endsection