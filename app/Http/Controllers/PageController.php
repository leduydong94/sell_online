<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\ProductType;
use Session;
use App\Cart;
use App\Customer;
use App\Bill;
use App\BillDetail;
use App\Slide;
use \Validator;
use Auth;

class PageController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->keyword;

        if ($keyword) {
            $new_products = Product::where('new',1)->where('name', 'like', "%{$keyword}%")->paginate(8);

            $sale_products = Product::where('sale_price', '<>', "0")->where('name', 'like', "%{$keyword}%")->paginate(8);
        } else {
            $new_products = Product::where('new',1)->paginate(8);

             $sale_products = Product::where('sale_price', '<>', "0")->paginate(8);
        }
        // dd($new_products);
        $slides = Slide::where('status', '=', 1)->get();
        // dd($slides);

    	return view('page.index', compact('new_products', 'sale_products', 'slides'));
    }

    public function product_type(Request $request, $typeId)
    {
        $keyword = $request->keyword;

        

        $typeId = $request->typeId;

        $productType = ProductType::find($typeId);

        $productTypes = ProductType::all();

        if ($keyword) {
            $product_types = Product::where('type_id', '=', "{$typeId}")->where('name', 'like', "%{$keyword}%")->paginate(9);

            $others_product = Product::where('type_id', '<>', "{$typeId}")->where('name', 'like', "%{$keyword}%")->paginate(3);
        } else {
            $product_types = Product::where('type_id', '=', "{$typeId}")->paginate(9);

            $others_product = Product::where('type_id', '<>', "{$typeId}")->paginate(3);
        }

    	return view('page.product_type', compact('product_types', 'productType', 'productTypes', 'others_product'));
    }

    public function product_detail(Request $request)
    {
        $productId = $request->productId;

        $product = Product::find($productId);

        $keyword = $request->keyword;

        if ($keyword) {
            $relatedProducts = Product::where('type_id', '=', $product->type_id)->where('name', 'like', "%{$keyword}%")->paginate(6);
        } else {
            $relatedProducts = Product::where('type_id', '=', $product->type_id)->paginate(6);
        }

        $newProducts = Product::where('new', 1)->orderByDesc('id')->limit(6)->get();

        $saleProducts = Product::where('sale_price','<>', 0)->orderByDesc('id')->limit(6)->get();

        // dd($saleProducts);

    	return view('page.product_detail', compact('product', 'relatedProducts', 'newProducts', 'saleProducts'));
    }

    public function add_to_cart(Request $request, $productId)
    {
        $product = Product::find($productId);

        $oldCart = session('cart') ? Session::get('cart') : null;

        // dd(count($oldCart->items));
        $qty = $request->qty != null ? $request->qty : 1;

        $cart = new Cart($oldCart);

        // dd(count($cart->items));

        $cart->add($product, $productId, $qty);

        $request->session()->put('cart', $cart);

        return redirect()->back();
    }

    public function delete_cart(Request $request, $productId)
    {
        $product = Product::find($productId);

        $oldCart = session('cart') ? Session::get('cart') : null;

        $cart = new Cart($oldCart);

        $cart->removeItem($productId);

        if (count($cart->items) > 0) {
            $request->session()->put('cart', $cart);
        } else {
            Session::forget('cart');
        }

        return redirect()->back();
    }

    public function checkout()
    {

        // $user = Auth::user() != null ? Auth::user() : '';
        // $email = $user->email;
        // dd($email);
        if (Auth::check()) {
            $email = Auth::user()->email;
            $data = Customer::where('email', '=', "{$email}")->first();
            if ($data) {
                return view('page.checkout', compact('data'));
            }
        } else {
            return view('page.checkout'); 
        }        
    }

    public function postCheckOut(Request $request)
    {
        $data = $request->only('name', 'gender', 'email', 'address', 'phone', 'notes');

        $validator = Validator::make($data, [
            'email' => 'required|min:6',
            'name' => 'required|min:5',
            'address' => 'required|min:4',
            'phone' => 'required|min:10'
        ], [
            'email.required' => 'Email is required',
            'email.min' => 'Email is at least 6 characters',
            'name.required' => 'Name is required',
            'name.min' => 'Name is at least 5 characters',
            'address.required' => 'Address is required',
            'address.min' => 'Address is at least 4 characters',
            'phone.required' => 'Phone is required',
            'phone.min' => 'Phone is at least 10 characters'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $cart = Session::get('cart');

         // dd($cart);

        $name = $request->name;
        $gender = $request->gender;
        $email = $request->email;
        $address = $request->address;
        $phone = $request->phone;
        $notes = $request->notes;

        // dd($gender);

        $data = Customer::where('email', '=', "{$email}")->first();

        $customer = new Customer;

        if (!$data) {
            $customer->name = $name;
            $customer->gender = $gender;
            $customer->email = $email;
            $customer->address = $address;
            $customer->phone = $phone;

            $customer->save();

            $customer_id = $customer->id;
        } else {
            $data->gender = $gender;
            $data->address = $address;
            $data->phone = $phone;

            $data->save();

            $customer_id = $data->id;
        }
        
        $order_date = date('Y-m-d H:i:s');
        $total = $cart->totalPrice;
        $payment = $request->payment_method;

        $bill = new Bill();

        $bill->customer_id = $customer_id;
        $bill->order_date = $order_date;
        $bill->total = $total;
        $bill->payment = $payment;
        $bill->note = $notes; 

        $bill->save();

        

        foreach ($cart->items as $key => $value) {
            $billDetail = new BillDetail;

            $billDetail->bill_id = $bill->id;
            $billDetail->product_id = $key;
            $billDetail->quantity =  $value['quantity'];
            $billDetail->unit_price = $value['sale_price'] != null ? $value['sale_price'] : $value['price'];

            $billDetail->save();
        }

        Session::forget('cart');

        $request->session()->flash('success', 'Successfully Purchase !');
          
        return redirect()->route('index');
    }

    public function contact()
    {
    	return view('page.contact');
    }

    public function about()
    {
    	return view('page.about');
    }

    public function x(Request $request)
    {
        $request->session()->flush();

         return redirect()->route('index');
    }
}
