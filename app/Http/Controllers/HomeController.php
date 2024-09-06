<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{

    public function index()
    {
        // $product = Product::all();
        // If we don't want to display all of the data, just paginate the page
        $product = Product::paginate(3);
        return view('home.userpage', compact('product'));
    }

    public function products()
    {
        $product = Product::paginate(3);
        return view('home.all_products', compact('product'));
    }

    public function redirect()
    {
        $usertype = Auth::user()->usertype;

        if ($usertype == 1) {
            $total_product = Product::all()->count();
            $total_order = Order::all()->count();
            $total_user = User::where('usertype', '=', '0')->count();
            $order = Order::all();

            $total_revenue = 0;
            foreach ($order as $order) {
                if ($order->payment_status == 'Paid') {
                    $total_revenue = $total_revenue + $order->price;
                }
            }

            $total_delivered = Order::where('delivery_status', '=', 'Delivered')->get()->count();
            $total_processing = Order::where('delivery_status', '=', 'Processing')->get()->count();
            return view('admin.home', compact('total_product', 'total_order', 'total_user', 'total_revenue', 'total_delivered', 'total_processing'));
        } else {
            $product = Product::paginate(3);
            return view('home.userpage', compact('product'));
        }
    }

    public function product_details($id)
    {
        $product = Product::find($id);
        return view('home.product_details', compact('product'));
    }

    public function add_cart(Request $request, $id)
    {
        // dd($request);
        $user = Auth::user();
        $userid = $user->id;
        $product = Product::find($id);

        // If the same user added the same product twice, it should show quantity as 2, instead of 1 and 1 in the cart
        // We are checking if the product we are about to add, is already in the carts table
        $product_exist_id = Cart::where('product_id', '=', $id)->where('user_id', '=', $userid)->get('id')->first();

        if ($product_exist_id) {
            $cart = Cart::find($product_exist_id)->first();
            $quantity = $cart->quantity;
            $cart->quantity = $quantity + $request->quantity;

            if ($product->discount_price != null) {
                $cart->price = $product->discount_price * $cart->quantity;
            } else {
                $cart->price = $product->price * $cart->quantity;
            }
            $cart->save();
            return redirect()->back()->With('message', 'Product added successfully');
        } else {
            // Code to add to cart
            $cart = new Cart();
            $cart->name = $user->name;
            $cart->email = $user->email;
            $cart->phone = $user->phone;
            $cart->address = $user->address;
            $cart->user_id = $user->id;

            $cart->product_title = $product->title;
            if ($product->discount_price != null) {
                $cart->price = $product->discount_price * $request->quantity;
            } else {
                $cart->price = $product->price * $request->quantity;
            }

            $cart->image = $product->image;
            $cart->product_id = $product->id;

            $cart->quantity = $request->quantity;

            $cart->save();
            return redirect()->back()->With('message', 'Product added successfully');
        }
    }

    public function show_cart()
    {
        $id = Auth::user()->id;
        $cart = Cart::where('user_id', '=', $id)->get();
        return view('home.show_cart', compact('cart'));
    }

    public function show_order()
    {
        $id = Auth::user()->id;
        $order = Order::where('user_id', '=', $id)->get();
        return view('home.show_order', compact('order'));
    }

    public function remove_cart($id)
    {
        $cart = Cart::find($id);
        $cart->delete();
        return redirect()->back()->With('message', 'Product removed from cart successfully');
    }

    public function cancel_order($id)
    {
        $order = Order::find($id);
        $order->delivery_status = 'Cancelled';
        $order->save();
        return redirect()->back()->With('message', 'Order removed successfully');
    }

    public function cash_order()
    {
        $user = Auth::user();
        $userid = $user->id;
        $data = Cart::where('user_id', '=', $userid)->get();

        foreach ($data as $data) {
            $order = new Order;
            $order->name = $data->name;
            $order->email = $data->email;
            $order->phone = $data->phone;
            $order->address = $data->address;
            $order->user_id = $data->user_id;

            $order->product_title = $data->product_title;
            $order->price = $data->price;
            $order->quantity = $data->quantity;
            $order->image = $data->image;
            $order->product_id = $data->product_id;

            $order->payment_status = 'Cash on delivery';
            $order->delivery_status = 'Processing';
            $order->save();

            // After moving the carts data to the orders table, we no longer need it, so...
            $cart_id = $data->id;
            $cart = Cart::find($cart_id);
            $cart->delete();
        }

        return redirect()->back()->With('message', 'We have received your order successfully and we will connect with you soon');
    }

    // After payment is successfull, we move the details from the carts table to the order table, just like above, copy & paste the code
    public function epay_order()
    {
        return redirect()->back()->With('message', 'Feature will be added soon !');
    }

    public function product_search(Request $request)
    {
        $category = Product::all();
        $search_text = $request->search;
        $product = Product::where('title', 'LIKE', "%$search_text%")->orWhere('category', 'LIKE', "$search_text")->paginate(10);
        return view('home.userpage', compact('product', 'category'));
    }

    public function search_product(Request $request)
    {
        $category = Product::all();
        $search_text = $request->search;
        $product = Product::where('title', 'LIKE', "%$search_text%")->orWhere('category', 'LIKE', "$search_text")->paginate(10);
        return view('home.all_products', compact('product', 'category'));
    }

    public function show_wishlist()
    {
        $id = Auth::user()->id;
        $wishlist = Wishlist::where('user_id', '=', $id)->get();
        return view('home.show_wishlist', compact('wishlist'));
    }

    public function add_wishlist(Request $request, $id)
    {
        // dd($id);
        $temp_product_id = $request->id;
        $product = Product::find($temp_product_id);

        $user = Auth::user();
        $userid = $user->id;

        // We are checking if the product we are about to add, is already in the wishlists table
        $product_exist_id = Wishlist::where('product_id', '=', $temp_product_id)->where('user_id', '=', $userid)->get('id')->first();

        if ($product_exist_id) {
            return redirect()->back()->With('message', 'Product already in Wishlist');
        } else {
            $wishlist = new Wishlist;
            $wishlist->product_id = $product->id;
            $wishlist->user_id = $userid;

            $wishlist->product_title = $product->title;
            $wishlist->quantity = $product->quantity;
            $wishlist->price = $product->discount_price;
            $wishlist->image = $product->image;
            $wishlist->save();

            return redirect()->back()->With('message', 'Product added to wishlist successfully');
        }
    }

    public function remove_wishlist($id)
    {
        $wishlist = Wishlist::find($id);
        $wishlist->delete();
        return redirect()->back()->With('message', 'Product removed from wishlist successfully');
    }
}
