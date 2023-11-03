<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartProduct;
use App\Models\Category;
use App\Models\Color;
use App\Models\Order;
use App\Models\Product;
use App\Models\Size;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ClothingStoreController extends Controller
{
    // Главная
    public function index(): View
    {
        return view('index', [
            'numCartItems' => 0
        ]);
    }

    // Каталог товаров
    public function catalog(): View
    {
        return view('catalog', [
            'items' => Product::all(),
            'numCartItems' => 0
        ]);
    }

    // Администрование товаров
    public function products_administration(): View
    {
        return view('products-administration', [
            'items' => Product::all(),
            'numCartItems' => 0
        ]);
    }

    // Страница просмотра товара
    public function single_product($id): View
    {
        return view('single-product', [
            'singleItem' => Product::find($id),
            'numCartItems' => 0
        ]);
    }

    // Рендеринг формы для добавления товара в БД
    public function createItem(): View
    {
        return view('product-editing', [
            'item' => new Product(),
            'categories' => Category::all(),
            'sizes' => Size::all(),
            'colors' => Color::all(),
            'numCartItems' => 0
        ]);
    }

    // Добавления товара в БД
    public function addItemToDB(Request $req): JsonResponse
    {
        $data = $req->all();
        $item = new Product($data);

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
    public function deleteItemFromDB($id): RedirectResponse
    {
        $item = Product::find($id);

        if ($item) {
            $item->delete();
        }

        return redirect()->route('items.list');
    }

    public function deleteItemFromDBResponse(Request $req): JsonResponse
    {
        $item = Product::find($req->get("id"));

        if ($item) {
            $item->delete();

            return response()->json([
                'name' => 'Успешно удалено!',
                'status' => '1'
            ]);
        } else {
            return response()->json([
                'name' => 'Ошибка удаления!',
                'status' => '0'
            ]);
        }
    }

    // Рендеринг формы для редактирования товара
    public function editItem($id): View
    {
        return view('product-editing', [
            'item' => Product::find($id),
            'categories' => Category::all(),
            'sizes' => Size::all(),
            'colors' => Color::all(),
            'numCartItems' => 0
        ]);
    }

    // Сохранение редактирования товара
    public function updateItem(Request $req, $id): RedirectResponse
    {
        $item = Product::find($id);

        if (empty($item)) {
            return back()->withErrors(['msg' => "Ошибка, запись не найдена"])->withInput();
        }

        $data = $req->all();
        $result = $item->fill($data);

        if ($req->file('imagePath') != "") {
            $imagePath = $req->file('imagePath')->store('uploads', 'public');
            $result->imagePath = $imagePath;
        }

        $result->save();

        return $result
            ? redirect()->route('items.list')
            : back()->withErrors(['msg' => "Ошибка, запись не была изменена"])->withInput();
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

        $clothesIDs = CartProduct::where('PK_Cart', $curCart->id)->get();

        $cartItems = [];

        foreach ($clothesIDs as $clothesID) {
            $cartItems[] = Product::find($clothesID->PK_Clothes);
        }

        return view('cart', [
            'cartItems' => $cartItems,
            'cart' => $curCart
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

        $clothesIDs = CartProduct::where('PK_Cart', $curCart->id)->get();

        $cartItems = array();
        foreach ($clothesIDs as $clothesID) {
            $cartItems[] = Product::find($clothesID->PK_Clothes);
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
        $item = Product::find($id);

        if ($item) {
            return response()->json([
                'status' => '1',
                'clothesName' => $item->clothesName,
                'color' => $item->Color->colorName,
                'size' => $item->Size->sizeName,
                'category' => $item->Category->categoryName,
                'price' => $item->price
            ]);
        } else {
            return response()->json([
                'status' => '0',
                'info' => 'Ошибка загрузки инофрмации о товаре',
            ]);
        }
    }
}
