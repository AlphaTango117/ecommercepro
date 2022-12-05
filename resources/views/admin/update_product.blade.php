<!DOCTYPE html>
<html lang="en">

    <head>
        <!-- Required meta tags -->
        
        @include('admin.css')

      <style type="text/css">
        .div_center
        {
           text-align: center;
           padding-top: 60px;
        }

        .font_size
        {
            font-size: 40px;
            padding-bottom: 40px;
        }
        .text_color
        {
            color: black;
            padding-bottom: 20px;
        }
        .div_design
        {
          padding-bottom: 15px;
        }

        label
        {
            display: inline-block;
            width: 200px;
        }

     </style>
   </head>

  <body>
    <div class="container-scroller">
      <!-- partial:partials/_sidebar.html -->
     @include('admin.sidebar')
      <!-- partial -->
      <div class="container-fluid page-body-wrapper">
        <!-- partial:partials/_navbar.html -->
       @include('admin.navbar')
        <!-- partial -->
       <div class="main-panel">
        	<div class="content-wrapper">

                @if(session()->has('message'))

                  <div class="alert alert-success">
                    <button type="button" class="close" data-dismiss="alert" area-hidden="true">X</button>
                     {{session()->get('message')}} 

                  </div>

                @endif

                <div class="div_center">
                	<h1 class="font_size"> Update Product</h1>

              <form action="{{url('/update_product_confirm',$item->id)}}" method="POST" enctype="multipart/form-data">
                   @csrf

                  <div class="div_design">
                	<label>Product Title:</label>
                	<input class="text_color" type="text" name="title" placeholder="Write Title Here" value="{{$item->title}}">
                  </div>

                  <div class="div_design">
                	<label>Product Description:</label>
                	<input class="text_color" type="text" name="description" placeholder="Write Description Here" value="{{$item->description}}">
                  </div>

                  <div class="div_design">
                	<label>Product Quantity:</label>
                	<input class="text_color" type="number" min="0"name="quantity" placeholder="Quantity" value="{{$item->quantity}}">
                  </div>
                  <div class="div_design">
                	<label>Product Price:</label>
                	<input class="text_color" type="number" min="0" name="price" placeholder="Product Price" value="{{$item->price}}">
                  </div>
                  <div class="div_design">
                	<label>Product Discounted Price:</label>
                	<input class="text_color" type="number" min="0" name="discount_price" placeholder="Discounted Price" value="{{$item->discount_price}}">
                  </div>
                  <div class="div_design">
                	<label>Product Category:</label>
                	<select class="text_color" value="">
                		<option value="{{$item->catagory}}" selected="">{{$item->catagory}}</option>
                    @foreach($catagory as $catagory)    
                        <option >{{$catagory->catagory_name}}</option>
                    @endforeach 
                	</select>
                  </div>

                   <div class="div_design">
                	<label>Current Image Here:</label>
                    <img src="/product/{{$item->image}}" style="margin:auto;" height="100px" width="100px">
                    <label>Product Image Here:</label>
                	<input type="file" name="image" value="">
                  </div>

                  <div class="div_design">
                	<input class="btn btn-success" type="submit" value="Update Product ">
                  </div>
            </form>
                </div>
            </div>
       </div>
        </div>
      <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    @include('admin.script')
  </body>
</html>
