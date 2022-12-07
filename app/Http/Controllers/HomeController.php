<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

use App\Models\User;
use App\Models\Product;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Comment;
use App\Models\Reply;

use Session;
use Stripe;

class HomeController extends Controller
{
    public function index()
    {

        $comment= comment::orderby('id','desc')->get();
        $reply=reply::all();
        $product= product::paginate(6);
        return view('home.userpage', compact('product','comment','reply'));
        
    }

    public function redirect(){

        $usetype= Auth::user()->usertype;

        if ($usetype==1) {
            $total_product= product::all()->count();
            $total_order= order::all()->count();
            $total_user= user::all()->count();

            $order= order::all();
            $total_revenue=0;

            foreach($order as $order)
            {
                $total_revenue= $total_revenue + $order->price;
            }

            $total_delivered=order::where('delivery_status', '=', 'delivered')->get()->count();
            $total_processing=order::where('delivery_status', '=', 'processing')->get()->count();

            return view('admin.home', compact('total_product','total_order','total_user','total_revenue','total_delivered','total_processing'));
        }
        else{
            $product= product::paginate(6);
            $comment= comment::all();
            $reply=reply::all();
        return view('home.userpage', compact('product','comment','reply'));
        }
    }

    public function product_details($id)
    {
            $product= product::find($id);

        return view('home.product_details', compact('product'));
    }

    public function add_cart(Request $req ,$id){

        if (Auth::id()) 
        {

            $user= Auth::user();
            $userid=$user->id;

            $product= product::find($id);

            $exist_product= cart::where('product_id','=',$id)->where('user_id','=',$userid)->get('id')->first();

            if($exist_product)
            {
               $cart=cart::find($exist_product)->first();
               $quantity= $cart->quantity;
               $cart->quantity= $quantity + $req->quantity;

               if($product->discount_price!=null)
                {
                    $cart->price= $product->discount_price * $cart->quantity;
                }

                else
                {
                    $cart->price= $product->price * $cart->quantity;
                } 

                $cart->save();
                 return redirect()->back();
            }

            else
            {
                 $cart= new cart;

                $cart->name= $user->name;
                $cart->phone= $user->phone;
                $cart->email= $user->email;
                $cart->address= $user->address;
                $cart->user_id= $user->id;
                $cart->product_title= $product->title; 

                if($product->discount_price!=null) 
                    {
                        $cart->price= $product->discount_price * $req->quantity;
                    }          
                else
                    {
                        $cart->price= $product->price * $req->quantity;
                    } 

                $cart->image= $product->image;            
                $cart->product_id= $product->id;
                $cart->quantity= $req->quantity;

                $cart->save();
                Alert::success('Product added successfully','We have added product into the cart');
                 return redirect()->back();   
            }

            
        }

    else
        {
             return redirect('login');
        }
    }

        public function show_cart(){

            if(Auth::id()){
            $id= Auth::user()->id;

            $cart= cart::where('user_id','=', $id)->get();
            return view('home.show_cart', compact('cart'));
            }
            else{
                return redirect('login');
            }
        }

        public function remove_cart($id){
            $cart= cart::find($id);
            $cart->delete();

            return redirect()->back();
        }

        public function cash_order(){
            
            $user= Auth::user()->id;
            

            $cart= cart::where('user_id','=', $user)->get();
            
            foreach($cart as $cart){
               $order= new order;

               $order->name= $cart->name;
               $order->email= $cart->email;
               $order->phone= $cart->phone;
               $order->address= $cart->address;
               $order->user_id= $cart->user_id;
               $order->product_title= $cart->product_title;
               $order->quantity= $cart->quantity;
               $order->price= $cart->price;
               $order->product_id= $cart->product_id;
               $order->image= $cart->image;
               $order->payment_status= 'Cash on delivery' ;
               $order->delivery_status= 'Processing' ;

               $order->save();

               $data_id= $cart->id;
               $data= cart::find($data_id);
               $data->delete();

            }

            return redirect()->back()->with('message', 'We recieved your request, We will contact with you soon');
        }

        public function stripe($totalprice){

          return view('home.stripe', compact('totalprice'));
        }

        public function stripePost(Request $request, $totalprice)
    {
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
    
        Stripe\Charge::create ([
                "amount" => $totalprice * 100,
                "currency" => "usd",
                "source" => $request->stripeToken,
                "description" => "Test payment from itsolutionstuff.com." 
        ]);

        
            $user= Auth::user()->id;
            

            $cart= cart::where('user_id','=', $user)->get();
            
            foreach($cart as $cart){
               $order= new order;

               $order->name= $cart->name;
               $order->email= $cart->email;
               $order->phone= $cart->phone;
               $order->address= $cart->address;
               $order->user_id= $cart->user_id;
               $order->product_title= $cart->product_title;
               $order->quantity= $cart->quantity;
               $order->price= $cart->price;
               $order->product_id= $cart->product_id;
               $order->image= $cart->image;
               $order->payment_status= 'Paid' ;
               $order->delivery_status= 'Processing' ;

               $order->save();

               $data_id= $cart->id;
               $data= cart::find($data_id);
               $data->delete();

            }
          
      
        Session::flash('success', 'Payment successful!');
              
        return back();
    }

    public function show_order(){

        if(Auth::id()){
            $id= Auth::user()->id;

            $order= order::where('user_id', $id)->get();
            return view('home.order', compact('order'));
            }
            else{
                return redirect('login');
            }
        
    }

    public function cancel_order($id){

        $order= order::find($id);
        $order->delivery_status='You cancelled the order';
        $order->save();

        return redirect()->back();
    }

    public function product_search(Request $request){
        $comment= comment::orderby('id','desc')->get();
        $reply=reply::all();
        $search_text=$request->search;

        $product= product::where('title', 'Like' ,"%$search_text%")->orWhere('catagory','Like',"%$search_text%")->paginate(10);

        return view('home.all_product', compact('product','comment','reply'));

    }

    public function add_comment(Request $request){

        if(Auth::id())
        {
            $comment= new comment;

            $comment->name= Auth::user()->name;
            $comment->user_id= Auth::user()->id;
            $comment->comment= $request->comment;
            $comment->save();

            return redirect()->back();
        }
        else{
            return redirect('login');
        }
    }

    public function add_reply(Request $request){
        if(Auth::id())
        {
             $reply= new reply;

             $reply->name= Auth::user()->name;
             $reply->user_id= Auth::user()->id;
             $reply->comment_id=$request->commentId;
             $reply->reply= $request->reply;
             $reply->save();

             return redirect()->back();
        }
        else
        {
            return redirect('login');
        }

    }

    public function product()
    {
        $product= product::paginate(10);
        $comment= comment::orderby('id','desc')->get();
        $reply=reply::all();
        
        
        return view('home.all_product',compact('product','comment','reply'));
    }

    public function count_cart()
    { 
        
            $id= Auth::user()->id;

            $total_cart= cart::where('user_id','=', $id)->get()->count();

           // return view('home.header',compact('total_cart'));
            return $total_cart;
          
    }


}
