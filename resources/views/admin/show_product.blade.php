<!DOCTYPE html>
<html lang="en">
<style type="text/css">
	.div_center
	{
         text-align: center;
         padding-top: 40px;
	}
	.h2_font
	{
         font-size: 40px;
         padding-bottom: 40px;
	}
	.input_color
	{
		color: black;
	}
</style>
  <head>
    <!-- Required meta tags -->
    @include('admin.css')
  </head>
  <body>
    <div class="container-scroller">
      <!-- partial:partials/_sidebar.html -->
     @include('admin.sidebar')
      <!-- partial -->
      
        <!-- partial:partials/_navbar.html -->
       @include('admin.navbar')
        <!-- partial -->
        <div class="main-panel">
        	<div class="content-wrapper">

        		          
           <table class="table mt-5">
				        <thead class="bg-gray-dark text-white fw-bold">
				           
				           <th>Product Title</th>	
				           <th>Description</th>
				           <th>Category</th>
				           <th>Price</th>		           		
				           <th>Discounted Price</th>	
				           <th>Quantity</th>	
				           <th>Product Image</th>			           
				           <th>Action</th>
				        </thead>
		        		<tbody class="text-white bg-lite fs-4">
				          
				          @foreach($item as $item)  
				            <tr>

				                    <td class="pt-5">{{$item->title}}</td>
				                    <td class="pt-5">{{$item->description}}</td>
				                    <td class="pt-5">{{$item->catagory}}</td>
				                    <td class="pt-5">{{$item->price}}</td>
				                    <td class="pt-5">{{$item->discount_price}}</td>		                    
				                    <td class="pt-5">{{$item->quantity}}</td>
				                    <td class="pt-5">
				                    	<img src="/product/{{$item->image}}">
				                    </td>
				                    <td><a href="{{url('update_product', $item->id)}}" class="btn btn-outline-success">Edit</a></td>
				                    <td ><a onclick="return confirm('Are You Sure To Delete This')" href="{{url('delete_product', $item->id)}}" class="btn btn-outline-danger">Delete</a></td>


				            </tr>
				           @endforeach 
				        </tbody>
        
            </table>
 
        	</div>
        </div>
        <!-- main-panel ends -->
     
      <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    @include('admin.script')
  </body>
</html>