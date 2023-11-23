<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Carbon;

use App\Models\User;

use App\Models\Product;

use App\Models\Cart;

use App\Models\Order;

use App\Models\Catagory;

use Session;

use Stripe;

class HomeController extends Controller
{


    public function index()
    {
        $product=product::paginate(9);
        $catagory=catagory::all();
        return view('home.userpage',compact('product','catagory'));
    }

    public function redirect()
    {
        $totalProducts = product::count();
        $totalCategories = catagory::count();

        $totalAllusers = user::count();
        $totalUser = user::where('usertype',0)->count();
        $totalAdmin = user::where('usertype',1)->count();

        $todayDate = Carbon::now()->format('d-m-Y');
        $thisMonth = Carbon::now()->format('m');
        $thisYear = Carbon::now()->format('Y');

        $totalOrder = order::count();
        $todayOrder = order::whereDate('created_at',$todayDate)->count();
        $thisMonthOrder = order::whereMonth('created_at',$thisMonth)->count();
        $thisYearOrder = order::whereYear('created_at',$thisYear)->count();

        $usertype=Auth::user()->usertype;

        if($usertype=='1')
        {
            return view('admin.home',compact('totalProducts','totalCategories','totalAllusers','totalUser','totalAdmin','totalOrder','todayOrder','thisMonthOrder','thisYearOrder'));
        }
        else
            {
                $catagory=catagory::all();
                $product=product::paginate(12);
                return view('home.userpage',compact('product','catagory'));
            }
    }
    public function product_details($id)
    {
        $product=product::find($id);
        $catagory=catagory::all();

        return view('home.product_details',compact('product','catagory'));
    }
    public function add_cart(Request $request, $id)
    {
        if (Auth::id())
        {
            $user=Auth::user();

            $product=product::find($id);

            $cart=new cart;

            $cart->name=$user->name;

            $cart->email=$user->email;

            $cart->phone=$user->phone;

            $cart->address=$user->address;

            $cart->user_id=$user->id;

            $cart->product_title=$product->title;

            if ($product->discount_price!==null)
            {
                $cart->price=$product->discount_price * $request->quantity;
            }

            else
            {
                $cart->price=$product->price * $request->quantity;
            }


            $cart->image=$product->image;

            $cart->Product_id=$product->id;

            $cart->quantity=$request->quantity;

            $cart->save();

            return redirect()->back();

        }

        else
        {
            return redirect('login');
        }
    }
    public function show_cart()
    {
        $catagory=catagory::all();
        if (Auth::id())
        {
            $id=Auth::user()->id;

        $cart=cart::where('user_id','=',$id)->get();

        return view('home.showcart',compact('cart','catagory'));
        }
        else
        {
            return redirect('login');
        }

    }
    public function remove_cart($id)
    {
        $cart=cart::find($id);

        $cart->delete();

        return redirect()->back();
    }
    public function cash_order()
    {
        $user=Auth::user();

        $userid=$user->id;

        $data=cart::where('user_id','=',$userid)->get();

        foreach($data as $data)
        {
            $order=new order;
            $order->name=$data->name;
            $order->email=$data->email;
            $order->phone=$data->phone;
            $order->address=$data->address;
            $order->user_id=$data->user_id;

            $order->product_title=$data->product_title;
            $order->price=$data->price;
            $order->quantity=$data->quantity;
            $order->image=$data->image;
            $order->product_id=$data->Product_id;

            $order->payment_status='cash on delivery';
            $order->delivery_Status='processing';

            $order->save();

            $cart_id=$data->id;

            $cart=cart::find($cart_id);

            $cart->delete();

        }
        return redirect()->back()->with('message',"We Received Your Order, We will connect with you soon");
    }

    public function stripe($totalprice)
    {
        $catagory=catagory::all();
        return view('home.stripe',compact('totalprice','catagory'));
    }

    public function stripePost(Request $request, $totalprice)
    {
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

        Stripe\Charge::create ([
                "amount" => $totalprice * 100,
                "currency" => "usd",
                "source" => $request->stripeToken,
                "description" => "Thanks for payment"
        ]);

        $user=Auth::user();

        $userid=$user->id;

        $data=cart::where('user_id','=',$userid)->get();

        foreach($data as $data)
        {
            $order=new order;
            $order->name=$data->name;
            $order->email=$data->email;
            $order->phone=$data->phone;
            $order->address=$data->address;
            $order->user_id=$data->user_id;

            $order->product_title=$data->product_title;
            $order->price=$data->price;
            $order->quantity=$data->quantity;
            $order->image=$data->image;
            $order->product_id=$data->Product_id;

            $order->payment_status='Paid';
            $order->delivery_Status='processing';

            $order->save();

            $cart_id=$data->id;

            $cart=cart::find($cart_id);

            $cart->delete();

        }

        Session::flash('success', 'Payment successful!');

        return back();

    }
    public function All_product()
    {
        // Assuming your model is named 'Product' and the category column is 'category'
        // $product = product::where('catagory', $catagory)->get();

        // If you want to paginate the results, you can use the paginate() method
        $catagory=catagory::all();
        $product = Product::orderBy('created_at', 'desc')->paginate(9);

        return view('home.productsbycatagory', compact('product','catagory'));
    }

    public function All_products($catagory_input)
    {
        // Assuming your model is named 'Product' and the category column is 'category'
        // $product = product::where('catagory', $catagory)->get();

        // If you want to paginate the results, you can use the paginate() method
        $catagory=catagory::all();
        $product = product::where('catagory', $catagory_input)->paginate(9);

        return view('home.productsbycatagory', compact('product','catagory'));
    }

}
