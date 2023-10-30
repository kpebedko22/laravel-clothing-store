<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartClothes;
use App\Models\Category;
use App\Models\Clothes;
use App\Models\ClothesOrder;
use App\Models\Color;
use App\Models\Size;
use Illuminate\Http\Request;

class ClothingStoreController extends Controller
{
    // Главная
    public function index()
    {
        return view(
            'index',
            [
                'numCartItems' => Cart::all()->last()->totalItems
            ]
        );
    }

    // Каталог товаров
    public function catalog()
    {
        return view(
            'catalog',
            [
                'items' => Clothes::all(),
                'numCartItems' => Cart::all()->last()->totalItems
            ]
        );
    }

    // Администрование товаров
    public function products_administration()
    {
        return view(
            'products-administration',
            [
                'items' => Clothes::all(),
                'numCartItems' => Cart::all()->last()->totalItems
            ]
        );
    }

    // Страница просмотра товара
    public function single_product($id)
    {
        return view(
            'single-product',
            [
                'singleItem' => Clothes::find($id),
                'numCartItems' => Cart::all()->last()->totalItems
            ]
        );
    }

    // Рендеринг формы для добавления товара в БД
    public function createItem()
    {
        return view(
            'product-editing',
            [
                'item' => new Clothes(),
                'categories' => Category::all(),
                'sizes' => Size::all(),
                'colors' => Color::all(),
                'numCartItems' => Cart::all()->last()->totalItems
            ]
        );
    }

    // Добавления товара в БД
    public function addItemToDB(Request $req)
    {
        $data = $req->all();
        $item = new Clothes($data);

        if ($req->file('imagePath')) {
            $imagePath = $req->file('imagePath')->store('uploads', 'public');
            $item->imagePath = $imagePath;
        }

        $item->save();

        if ($item) {
            //return redirect()->route('items.list');

            return response()->json([
                "status" => '1',
                'id' => $item->id,
                'clothesName' => $item->clothesName
            ]);
        } else {
            //return back()->withErrors(['msg' => "Ошибка создания товара..."])->withInput();

            return response()->json([
                "status" => '0',
                "message" => 'Ошибка создания товара...'
            ]);
        }
    }

    // Удалить товар из БД
    public function deleteItemFromDB($id)
    {
        $item = Clothes::find($id);

        if ($item)
            $item->delete();

        return redirect()->route('items.list');
    }

    public function deleteItemFromDBResponse(Request $req)
    {
        $item = Clothes::find($req->get("id"));
        if ($item) {
            $item->delete();
            return response()->json([
                'name' => 'Успешно удалено!',
                'status' => '1'
            ]);
        } else
            return response()->json([
                'name' => 'Ошибка удаления!',
                'status' => '0'
            ]);
    }

    // Рендеринг формы для редактирования товара
    public function editItem($id)
    {
        return view(
            'product-editing',
            [
                'item' => Clothes::find($id),
                'categories' => Category::all(),
                'sizes' => Size::all(),
                'colors' => Color::all(),
                'numCartItems' => Cart::all()->last()->totalItems
            ]
        );
    }

    // Сохранение редактирования товара
    public function updateItem(Request $req, $id)
    {
        $item = Clothes::find($id);

        if (empty($item))
            return back()->withErrors(['msg' => "Ошибка, запись не найдена"])->withInput();

        $data = $req->all();
        $result = $item->fill($data);

        if ($req->file('imagePath') != "") {
            $imagePath = $req->file('imagePath')->store('uploads', 'public');
            $result->imagePath = $imagePath;
        }

        $result->save();

        if ($result)
            return redirect()->route('items.list');
        else
            return back()->withErrors(['msg' => "Ошибка, запись не была изменена"])->withInput();
    }

    // Корзина (оформление заказа)
    public function cart()
    {
        $numCarts = Cart::all()->count();
        if ($numCarts < 1) {
            $newCart = new Cart(['totalItems' => 0, 'totalPrice' => 0]);
            $newCart->save();
        }

        $curCart = Cart::all()->last();

        $clothesIDs = CartClothes::where('PK_Cart', $curCart->id)->get();

        $cartItems = array();
        foreach ($clothesIDs as $clothesID) {
            $cartItems[] = Clothes::find($clothesID->PK_Clothes);
        }

        return view(
            'cart',
            [
                'cartItems' => $cartItems,
                'cart' => $curCart
            ]
        );
    }

    public function addItemToCart($id)
    {
        $numCarts = Cart::all()->count();

        if ($numCarts < 1) {
            $newCart = new Cart(['totalItems' => 0, 'totalPrice' => 0]);
            $newCart->save();
        }

        $curCart = Cart::all()->last();

        $allClothesToCart = CartClothes::where(['PK_Cart' => $curCart->id, 'PK_Clothes' => $id])->get();

        if (count($allClothesToCart) < 1) {

            $newCartClothes = new CartClothes(['PK_Cart' => $curCart->id, 'PK_Clothes' => $id]);
            $newCartClothes->save();

            $curClothes = Clothes::find($id);

            $curCart->totalItems += 1;
            $curCart->totalPrice += $curClothes->price;
            $curCart->save();
        }

        return redirect()->route('cart');
        //return redirect()->route('cart-preview');
    }

    public function deleteItemFromCart($id)
    {
        $cart = Cart::all()->last();

        CartClothes::where(['PK_Cart' => $cart->id, 'PK_Clothes' => $id])->delete();

        $cart->totalItems -= 1;
        $cart->totalPrice -= Clothes::find($id)->price;
        $cart->save();

        return redirect()->route('cart');
    }

    public function createOrder(Request $req)
    {
        $data = $req->all();
        $order = new ClothesOrder($data);

        $order->save();

        $newCart = new Cart(['totalItems' => 0, 'totalPrice' => 0]);
        $newCart->save();

        if ($order)
            return redirect()->route('cart');
        else
            return back()->withErrors(['msg' => "Ошибка создания заказа"])->withInput();
    }


    public function previewCart(Request $req)
    {
        $numCarts = Cart::all()->count();
        if ($numCarts < 1) {
            $newCart = new Cart(['totalItems' => 0, 'totalPrice' => 0]);
            $newCart->save();
        }

        $curCart = Cart::all()->last();

        $clothesIDs = CartClothes::where('PK_Cart', $curCart->id)->get();

        $cartItems = array();
        foreach ($clothesIDs as $clothesID) {
            $cartItems[] = Clothes::find($clothesID->PK_Clothes);
        }

        $myList = array();
        $i = 0;
        foreach ($cartItems as $item) {
            $myList[$i]["id"] = $item->id;
            $myList[$i]["clothesName"] = $item->clothesName;
            $myList[$i]["size"] = $item->Size->sizeName;
            $myList[$i]["price"] = $item->price;
            $myList[$i]["color"] = $item->Color->colorName;
            $myList[$i]["imagePath"] = $item->imagePath;
            $i += 1;
        }

        if ($curCart) {
            return response()->json([
                'status' => '1',
                'cart' => $curCart,
                'cartItems' => $myList
            ]);
        } else
            return response()->json([
                'status' => '0',
                'info' => 'Failed to load cart',
            ]);
    }


    public function previewItem($id)
    {
        $item = Clothes::find($id);

        if ($item) {
            return response()->json([
                'status' => '1',
                'clothesName' => $item->clothesName,
                'color' => $item->Color->colorName,
                'size' => $item->Size->sizeName,
                'category' => $item->Category->categoryName,
                'price' => $item->price
            ]);
        } else
            return response()->json([
                'status' => '0',
                'info' => 'Ошибка загрузки инофрмации о товаре',
            ]);
    }
}
