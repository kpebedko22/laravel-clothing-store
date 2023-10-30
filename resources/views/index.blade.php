@extends('layouts.layout')
@section('title', 'Главная')

@section('content')

<!-- Banner -->
<div class="banner">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="banner-message">
                    <h1>Магазин одежды</h1>
                    <h3>Мужская и женская одежда</h3>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Banner -->

<!-- Advantages -->
<div class="advantages">
    <div class="container">
        <div class="row">
            <div class="col-sm advantage">
                <div class="advantage-icon">
                    <i class="fa fa-truck fa-3x"></i>
                </div>
                <div class="advantage-text">
                    <h4>Безопасная доставка</h4>
                    <p>Курьером на дом и бесконтактно в постамат</p>
                </div>
            </div>
            <div class="col-sm advantage">
                <div class="advantage-icon">
                    <i class="fa fa-repeat fa-3x"></i>
                </div>
                <div class="advantage-text">
                    <h4>Легкий возврат</h4>
                    <p>Возвращайте товары в течение 30 дней после покупки</p>
                </div>
            </div>
            <div class="col-sm advantage">
                <div class="advantage-icon">
                    <i class="fa fa-money fa-3x"></i>
                </div>
                <div class="advantage-text">
                    <h4>Удобная оплата</h4>
                    <p>Наличными или банковской картой</p>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Advantages -->

@endsection