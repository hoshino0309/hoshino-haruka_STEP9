<table class="product__table">
    <tr>
        <th>商品番号</th>
        <th>商品名</th>
        <th>商品説明</th>
        <th>画像</th>
        <th>料金(¥)</th>
        <th></th>
    </tr>
    @forelse ($products as $product)
    <tr>
        <td>{{ $product->id }}</td>
        <td>{{ $product->product_name }}</td>
        <td>{{ $product->description }}</td>
        <td>
            <img src="{{ asset('storage/' . $product->img_path) }}" class="product__image">
        </td>
        <td>{{ $product->price }}</td>
        <td>
            <a href="{{ route('product.detail', $product->id ) }}" class="btn">
                詳細
            </a>
        </td>
    </tr>
    @empty
    <tr>
        <td colspan="6">該当する商品はありません</td>
    </tr>
    @endforelse
</table>