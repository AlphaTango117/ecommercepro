<!DOCTYPE html>
<html>
   <head>

      <!-- Basic -->
       <meta charset="utf-8" />
      <meta http-equiv="X-UA-Compatible" content="IE=edge" />
      <!-- Mobile Metas -->
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
      <!-- Site Metas -->
      <meta name="keywords" content="" />
      <meta name="description" content="" />
      <meta name="author" content="" />
      <link rel="shortcut icon" href="{{asset('images/favicon.png')}}" type="">
      <title>MNM Fashion Hive</title>
      <!-- bootstrap core css -->
      <link rel="stylesheet" type="text/css" href="{{asset('home/css/bootstrap.css')}}" />
      <!-- font awesome style -->
      <link href="{{asset('home/css/font-awesome.min.css')}}" rel="stylesheet" />
      <!-- Custom styles for this template -->
      <link href="{{asset('home/css/style.css')}}" rel="stylesheet" />
      <!-- responsive style -->
      <link href="{{asset('home/css/responsive.css')}}" rel="stylesheet" />

      <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

      <style type="text/css">
         .center
         {
            margin: auto;
            width: 50%;
            text-align: center;
            padding: 50px;
         }

            table,th,td
            {
              border: 1px solid grey;
              padding-left: 40px; 
            }

          .th-deg
          {
            font-size: 20px;
            padding: 5px;
            background-color: indianred;
          }

          .total_deg
          {
            font-size: 20px;
            padding: 30px;
            text-align: center;
          }  

      </style>
   </head>
   <body>
      <div class="hero_area">
         <!-- header section strats -->
         @include('home.header')
         <!-- end header section -->
          <div class="center">
            
             @if(session()->has('message'))

                  <div class="alert alert-success">
                    <button type="button" class="close" data-dismiss="alert" area-hidden="true">X</button>
                     {{session()->get('message')}} 

                  </div>

                @endif

             <table>
                <tr>
                  
                   <th class="th-deg">Product Title</th>
                   <th class="th-deg">Quantity</th>
                   <th class="th-deg">Price</th>
                   <th class="th-deg">Image</th>
                   <th class="th-deg">Action</th>
         
                </tr>

                
                  <?php $totalprice=0; ?>

                  @foreach($cart as $item) 

                  <tr>                    
                   <td>{{$item->product_title}}</td>
                   <td>{{$item->quantity}}</td>
                   <td>BDT{{$item->price}}</td>
                   <td><img src="/product/{{$item->image}}" height="100px" width="100px"></td>
                   <td><a onclick="confirmation(event)"class="btn btn-danger" href="{{url('remove_cart', $item->id)}}">Remove</a></td>
                   </tr>

                   <?php $totalprice= $totalprice + $item->price ?>

                  @endforeach 
                 
             </table>

                  <div>
                     <h1 class="total_deg">Total Price: BDT{{$totalprice}}</h1>
                  </div>

                  <div>
                     <h1 style="font_size: 25px; padding-bottom:15px;">Proceed To Order:</h1>
                     <a href="{{url('cash_order')}}" class="btn btn-danger">Cash On Delivery</a>
                     <a href="{{url('stripe', $totalprice)}}" class="btn btn-danger">Pay Using Card</a>

                  </div>

          </div>
 
 <div class="cpy_">
         <p class="mx-auto">© 2022 All Rights Reserved By <a href="https://www.AlphaTango.com/">Alpha Tango</a><br>
         
         </p>
      </div>
      
      <!-- jQery -->

    <script type="text/javascript">
       function confirmation(ev) {
         ev.preventDefault();
         var urlToRedirect = ev.currentTarget.getAttribute('href');
         console.log(urlToRedirect);
         swal({
            title: "Are you sure to cancel this product",
            text: "You will not be able to revert this!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
         })
         .then((willCancel) => {
            if(willCancel){
               window.location.href = urlToRedirect;
            }
         }); 
       }
    </script>

      <script src="{{asset('home/js/jquery-3.4.1.min.js')}}"></script>
      <!-- popper js -->
      <script src="{{asset('home/js/popper.min.js')}}"></script>
      <!-- bootstrap js -->
      <script src="{{asset('home/js/bootstrap.js')}}"></script>
      <!-- custom js -->
      <script src="{{asset('home/js/custom.js')}}"></script>
   </body>
</html>