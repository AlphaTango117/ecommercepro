<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Catagory;
use App\Models\Product;
use App\Models\Order;

use PDF;
use Notification;
use App\Notifications\SendEmailNotification;

class AdminController extends Controller
{
    public function view_catagory()
    {
        if(Auth::id())
        {
            $data= catagory::all();
        return view('admin.catagory', compact('data'));
        }
         else
         {
            return redirect('login');
         }
    }

    public function add_catagory(Request $req){

        if(Auth::id())
        {
            $data= new Catagory;

        $data->catagory_name= $req->name;

        $data->save();

        return redirect()->back()->with('message','Catagory Added Successfully');
        }
        else
        {
            return redirect('login');
        }
    }

    public function delete_catagory($id){

        if(Auth::id())
        {
            $data= catagory::find($id);

        $data->delete();

        return redirect()->back()->with('message','Catagory Deleted Successfully');
        }
        else
        {
            return redirect('login');
        }

        

    }

    public function view_product(){

        if(Auth::id())
        {
            $catagory=Catagory::all();
        return view('admin.product',compact('catagory'));
        }
        else
        {
            return redirect('login');
        }

        
    }

     public function add_product(Request $req){

        if(Auth::id())
        {
            $product= new product;

            $product->title= $req->title;
            $product->description= $req->description;
            $product->quantity= $req->quantity;
            $product->price= $req->price;
            $product->discount_price= $req->discount_price;
            $product->catagory= $req->catagory;

            $image=$req->image;
            $imagename= time().'.'.$image->getClientOriginalExtension();
            $req->image->move('product', $imagename);
            $product->image=$imagename;

            $product->save();

            return redirect()->back()->with('message','Product Added Successfully');
        }
        else
        {
            return redirect('login');
        }

        
    }
    public function show_product(){

        if(Auth::id())
        {
            $item=product::all();
        return view('admin.show_product',compact('item'));
        }
        else
        {
            return redirect('login');
        }

        
    }

    public function delete_product($item_id){

        if(Auth::id())
        {
            $item= product::find($item_id);

        $item->delete();

        return redirect()->back()->with('message','Product Deleted Successfully');
        }
        else
        {
            return redirect('login');
        }

    }

    public function update_product($item_id){

        if(Auth::id())
        {
             $item= product::find($item_id);
        $catagory=Catagory::all();

        return view('admin.update_product',compact('item','catagory'));
        }
        else
        {
            return redirect('login');
        }
        
       

    }
    
    public function update_product_confirm(Request $req, $id){

        if(Auth::id())
        {
            
        $product=product::find($id);

        $product->title = $req->title;
        $product->description = $req->description;
        $product->quantity = $req->quantity;
        $product->price = $req->price;
        $product->discount_price = $req->discount_price;
        $product->catagory = $req->catagory;

        $image=$req->image;

        if($image){
        $imagename= time().'.'.$image->getClientOriginalExtension();
        $req->image->move('product', $imagename);
        $product->image=$imagename;
        }

        $product->save();

       return redirect()->back()->with('message','Product Updated Successfully');
        }
        else
        {
            return redirect('login');
        }

    }

    public function order(){

        if(Auth::id())
        {
             $order= order::all();

        return view('admin.order', compact('order'));
        }
        else
        {
            return redirect('login');
        }

       
    }

    public function delivery($id){

        if(Auth::id())
        {
            $order= order::find($id);

        $order->delivery_status= 'delivered';

        $order->save();

        return redirect()->back();
        }
        else
        {
            return redirect('login');
        }

        
    }

    public function print_pdf($id){

        if(Auth::id())
        {
           $order= order::find($id);
        $pdf=PDF::loadView('admin.pdf', compact('order'));
        return $pdf->download('order_details.pdf');
        }
        else
        {
            return redirect('login');
        }
        
    }

    public function send_email($id){

        if(Auth::id())
        {
           $order= order::find($id);

        return view('admin.email_info', compact('order'));
        }
        else
        {
            return redirect('login');
        }

        
    }

    public function send_user_email(Request $request,$id){

        if(Auth::id())
        {
            $order= order::find($id);

        $details = [
             'greeting'=>$request->greeting,
             'firststline'=>$request->firstline,
             'body'=>$request->body,
             'button'=>$request->button,
             'url'=>$request->url,
             'lastline'=>$request->lastline,

 
        ];

        Notification::send($order, new SendEmailNotification($details));
        return redirect()->back();
        }
        else
        {
            return redirect('login');
        }

        
    }

    public function searchdata(Request $request){

        if(Auth::id())
        {
             $searchText= $request->search;

               $order= order::where('name', 'Like', "%$searchText%")->orWhere('product_title', 'Like', "%$searchText%")->orWhere('payment_status', 'Like', "%$searchText%")->get();

               return view('admin.order', compact('order'));
        }
        else
        {
            return redirect('login');
        }
        
              
    }
}
