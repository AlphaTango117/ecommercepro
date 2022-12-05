<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    @include('admin.css')
  </head>
<style>
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
                	<h1 class="font_size"> Add Product</h1>

              <form action="{{url('/add_product')}}" method="POST" enctype="multipart/form-data"> 
                   @csrf

                  <div class="div_design">
                	<label>Product Title:</label>
                	<input class="text_color" type="text" name="title" placeholder="Write Product Name" required="">
                  </div>
                  
                  <div class="div_design">
                	<label>Product Description:</label>
                	<input class="text_color" type="text" name="description" placeholder="Write Product Description" required="">
                  </div>	
                  
                  <div class="div_design">
                	<label>Product Quantity:</label>
                	<input class="text_color" type="number" min="0"name="quantity" placeholder="Product Quantity" required="">
                  </div>	
                  <div class="div_design">
                	<label>Product Price:</label>
                	<input class="text_color" type="number" min="0" name="price" placeholder="Write Product Price" required="">
                  </div>	
                  <div class="div_design">
                	<label>Product Discounted Price:</label>
                	<input class="text_color" type="number" min="0" name="discount_price" placeholder="Discounted Price">
                  </div>
                  <div class="div_design">
                	<label>Product Category:</label>
                	<select class="text_color" name="catagory" required="">
                		<option value="" selected="">Add a Category Here:</option>

                	@foreach($catagory as $catagory)	
                		<option >{{$catagory->catagory_name}}</option>
                	@endforeach	
               
                	</select>
                  </div>	

                   <div class="div_design">
                	<label>Product Image Here:</label>
                	<input type="file" name="image" required="">
                  </div>	

                  <div class="div_design">
                	<input class="btn btn-success" type="submit" value="Add Product">
                  </div>
            </form> 
                </div>
            </div>
       </div>		
        <!-- main-panel ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    @include('admin.script')
  </body>
</html>