@extends('app')

@section('title', '商品購入画面')

@section('css')
<link rel="stylesheet" href="{{ asset('css/purchase.css') }}">
@endsection

@section('content')
<div class="purchase__title">
    <h1>購入画面</h1>
</div><!-- /.purchase__title -->

<form id="purchaseForm" action="{{ route('purchase') }}" method="POST">
    @csrf
    <div class="purchase__form">
        <label for="product_name">商品名：</label>
        <p>{{ $product->product_name }}</p>
    </div><!-- /.purchase__form -->

    <div class="purchase__form">
        <label for="product_description">説明：</label>
        <p>{{ $product->description }}</p>
    </div><!-- /.purchase__form -->

    <div class="purchase__form">
        <img src="{{ asset('storage/' . $product->img_path) }}" alt="{{ $product->product_name }}" class="product__image">
    </div><!-- /.purchase__form -->

    <div class="purchase__form">
        <input type="hidden" name="id" value="{{ $product->id }}">
        <input type="number" name="quantity" id="quantity" placeholder="数量を入力" value="{{ old('quantity') }}">
    </div><!-- /.purchase__form -->

    <div class="purchase__form">
        <label for="price">金額：</label>
        <p>¥{{ $product->price }}</p>
    </div><!-- /.purchase__form -->

    <div class="purchase__form">
        <label for="stock">残り：</label>
        <p>{{ $product->stock }}</p>
    </div><!-- /.purchase__form -->

    <div class="purchase__form">
        <label for="company_name">会社名：</label>
        <p>{{ $product->company->company_name }}</p>
    </div><!-- /.purchase__form -->

    <div class="purchase__btns">
        @if($product->stock > 0)
        <button type="button" class="btn purchase__btn" id="openModal">購入する</button>
        @else
        <button type="submit" class="btn purchase__btn--dis" disabled>在庫切れ</button>
        @endif
        <a href="{{ route('product.detail', $product->id) }}" class="btn purchase__btn--back">戻る</a>
    </div><!-- /.purchase__btns -->
</form>

<!-- 購入確認モーダル -->
<div id="confirmModal" class="modal">
    <div class="modal__content">
        <p>この商品を購入しますか？</p>
        <button id="confirmPurchase" class="btn purchase__btn">購入する</button>
        <button id="closeModal" class="btn purchase__btn--back">キャンセル</button>
    </div>
</div>

@section('js')
<script src="{{ asset('js/purchase.js') }}"></script>
@endsection

@endsection