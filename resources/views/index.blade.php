@extends('app')

@section('title', '商品一覧')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('js')
<script src="{{ asset('js/search.js') }}"></script>
@endsection

@section('content')

<div class="product__title">
    <h1>商品一覧</h1>
</div><!-- /.product__title -->
<!-- 商品の検索 -->
<form action="{{ route('search') }}" method="GET" class="product__search">
    <div class="product__search--name">
        <input type="text" name="product_name" placeholder="商品名を入力" value="{{ request('product_name') }}">
    </div><!-- /.product__search--name -->
    <div class="product__search--minPrice">
        <input type="number" name="price_min" id="priceMin" placeholder="最低価格" value="{{ request('price_min') }}">
    </div><!-- /.product__search--minPrice -->
    <span>〜</span>
    <div class="product__search--maxPrice">
        <input type="number" name="price_max" id="priceMax" placeholder="最高価格" value="{{ request('price_max') }}">
    </div><!-- /.product__search--maxPrice -->
    <div class="product__btn--group">
        <button type="submit" class="btn product__btn--search">検索</button>
    </div><!-- /.product__search--btn -->
</form>

<!-- 商品の一覧表示 -->
<div id="productList">
    @include('products._list')
</div>
@endsection