<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Sale extends Model
{
    protected $fillable = [
        'product_id',
        'user_id',
        'quantity'
    ];

    // salesテーブルとusersテーブルのリレーション
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // salesテーブルとproductsテーブルのリレーション
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    // 購入履歴取得
    public function getPurchaseHistory($user_id)
    {
        return self::with('product')
            ->where('user_id', $user_id)
            ->orderBy('created_at', 'asc')
            ->get();
    }

    // 商品購入処理
    public function purchaseProduct($product_id, $quantity, $user_id)
    {
        $product = Product::find($product_id);

        // 在庫不足
        if (!$product || !$product->hasSufficientStock($quantity)) {
            return false;
        }

        DB::beginTransaction();

        try {

            // 購入履歴登録
            self::create([
                'user_id' => $user_id,
                'product_id' => $product_id,
                'quantity' => $quantity
            ]);

            // 在庫減少
            $product->reduceStock($quantity);

            DB::commit();

            return true;

        } catch (\Exception $e) {

            DB::rollback();

            return false;
        }
    }
}