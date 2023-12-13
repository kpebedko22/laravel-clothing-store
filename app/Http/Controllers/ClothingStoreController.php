<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartProduct;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class ClothingStoreController extends Controller
{
    // Корзина (оформление заказа)
    public function cart()
    {
        $numCarts = Cart::all()->count();

        if ($numCarts < 1) {
            $newCart = new Cart(['totalItems' => 0, 'totalPrice' => 0]);
            $newCart->save();
        }

        $curCart = Cart::all()->last();

        $clothesIDs = CartProduct::where('PK_Cart', $curCart->id)->get();

        $cartItems = [];

        foreach ($clothesIDs as $clothesID) {
            $cartItems[] = Product::find($clothesID->PK_Clothes);
        }

        return view('cart', [
            'cartItems' => $cartItems,
            'cart' => $curCart,
        ]);
    }

    public function addItemToCart($id)
    {
        $numCarts = Cart::all()->count();

        if ($numCarts < 1) {
            $newCart = new Cart(['totalItems' => 0, 'totalPrice' => 0]);
            $newCart->save();
        }

        $curCart = Cart::all()->last();

        $allClothesToCart = CartProduct::where(['PK_Cart' => $curCart->id, 'PK_Clothes' => $id])->get();

        if (count($allClothesToCart) < 1) {

            $newCartClothes = new CartProduct(['PK_Cart' => $curCart->id, 'PK_Clothes' => $id]);
            $newCartClothes->save();

            $curClothes = Product::find($id);

            $curCart->totalItems += 1;
            $curCart->totalPrice += $curClothes->price;
            $curCart->save();
        }

        return redirect()->route('cart');
    }

    public function deleteItemFromCart($id)
    {
        $cart = Cart::all()->last();

        CartProduct::where(['PK_Cart' => $cart->id, 'PK_Clothes' => $id])->delete();

        $cart->totalItems -= 1;
        $cart->totalPrice -= Product::find($id)->price;
        $cart->save();

        return redirect()->route('cart');
    }

    public function createOrder(Request $req)
    {
        $data = $req->all();
        $order = new Order($data);

        $order->save();

        $newCart = new Cart(['totalItems' => 0, 'totalPrice' => 0]);
        $newCart->save();

        if ($order) {
            return redirect()->route('cart');
        } else {
            return back()->withErrors(['msg' => 'Ошибка создания заказа'])->withInput();
        }
    }

    public function previewCart(Request $req)
    {
        $numCarts = Cart::all()->count();
        if ($numCarts < 1) {
            $newCart = new Cart(['totalItems' => 0, 'totalPrice' => 0]);
            $newCart->save();
        }

        $curCart = Cart::all()->last();

        $clothesIDs = CartProduct::where('PK_Cart', $curCart->id)->get();

        $cartItems = [];
        foreach ($clothesIDs as $clothesID) {
            $cartItems[] = Product::find($clothesID->PK_Clothes);
        }

        $myList = [];
        $i = 0;
        foreach ($cartItems as $item) {
            $myList[$i]['id'] = $item->id;
            $myList[$i]['clothesName'] = $item->clothesName;
            $myList[$i]['size'] = $item->Size->sizeName;
            $myList[$i]['price'] = $item->price;
            $myList[$i]['color'] = $item->Color->colorName;
            $myList[$i]['imagePath'] = $item->imagePath;
            $i += 1;
        }

        if ($curCart) {
            return response()->json([
                'status' => '1',
                'cart' => $curCart,
                'cartItems' => $myList,
            ]);
        } else {
            return response()->json([
                'status' => '0',
                'info' => 'Failed to load cart',
            ]);
        }
    }

    public function previewItem($id)
    {
        $item = Product::find($id);

        if ($item) {
            return response()->json([
                'status' => '1',
                'name' => $item->name,
                'color' => $item->color->name,
                'size' => $item->size->name,
                'category' => $item->category->name,
                'price' => $item->price,
            ]);
        } else {
            return response()->json([
                'status' => '0',
                'info' => 'Ошибка загрузки инофрмации о товаре',
            ]);
        }
    }
}
