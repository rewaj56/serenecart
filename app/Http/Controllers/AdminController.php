<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function view_category()
    {
        $data = Category::all();
        return view('admin.category', compact('data'));
    }

    public function add_category(Request $request)
    {
        $data = new Category;
        $data->category_name = $request->category;
        $data->save();
        return redirect()->back()->With('message', 'Category added successfully');

    }

    public function delete_category($id)
    {
        $data = Category::find($id);
        $data->delete();
        return redirect()->back()->With('message', 'Category deleted successfully');
    }

    public function view_product()
    {
        $category = Category::all();
        // dd($category);
        return view('admin.product', compact('category'));
    }

    public function add_product(Request $request)
    {
        $product = new Product();
        $product->title = $request->title;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->quantity = $request->quantity;
        $product->discount_price = $request->discount_price;
        $product->category = $request->category;

        // Storing image in a variable
        $image = $request->image;
        // Giving a unique image name
        $imagename = time() . '.' . $image->getClientOriginalExtension();
        // Mention where we are going to save the image
        // public folder ko "product" folder bhitra
        $request->image->move('product', $imagename);
        $product->image = $imagename;

        $product->save();
        return redirect()->back()->With('message', 'Product added successfully');
    }

    public function show_product()
    {
        $product = Product::all();
        return view('admin.show_product', compact('product'));
    }

    public function delete_product($id)
    {
        $product = Product::find($id);
        $product->delete();
        return redirect()->back()->With('message', 'Product deleted successfully');
    }

    public function update_product($id)
    {
        $product = Product::find($id);
        $category = Category::all();
        return view('admin.update_product', compact('product', 'category'));
    }

    public function update_product_confirm(Request $request, $id)
    {
        $product = Product::find($id);
        $product->title = $request->title;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->category = $request->category;
        $product->quantity = $request->quantity;
        $product->discount_price = $request->discount_price;
        $image = $request->image;

        // User may not always want to update the image, so...
        if ($image) {
            $imagename = time() . '.' . $image->getClientOriginalExtension();
            $request->image->move('product', $imagename);
            $product->image = $imagename;
        }

        $product->save();
        return redirect()->back()->With('message', 'Product updated successfully');
    }

    public function view_order()
    {
        $order = Order::all();
        return view('admin.view_order', compact('order'));
    }

    public function delivered($id)
    {
        $order = Order::find($id);
        $order->delivery_status = 'Delivered';
        $order->payment_status = 'Paid';
        $order->save();

        // After delivered, product's quantity must be reduced
        $product = Product::find($order->product_id);
        $product->quantity = $product->quantity - $order->quantity;
        $product->save();

        return redirect()->back()->With('message', 'Delivery Status updated successfully');
    }

    public function print_pdf($id)
    {
        $order = Order::find($id);
        // dd($order);
        $pdf = PDF::loadView('admin.pdf', compact('order'));
        return $pdf->stream('order_details.pdf');
    }

    public function searchdata(Request $request)
    {
        $searchText = $request->search;
        $order = Order::where('name', 'LIKE', "%$searchText%")->orWhere('phone', 'LIKE', "%$searchText%")->orWhere('product_title', 'LIKE', "%$searchText%")->get();
        return view('admin.view_order', compact('order'));
    }
}
