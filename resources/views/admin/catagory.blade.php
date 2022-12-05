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
              @if(session()->has('message'))

              <div class="alert alert-success">
                <button type="button" class="close" data-dismiss="alert" area-hidden="true">X</button>
                 {{session()->get('message')}} 

              </div>
              @endif

        		<div class="div_center">
        			<h2 class="h2_font">Add Catagory</h2>
        			<form method="POST" action="{{url('/add_catagory')}}">
        				@csrf
        				<input type="text" class="input_color" name="name" placeholder="Write Catagory Name">
        				<input type="submit" class="btn btn-primary" name="submit" value="Add Catagory">
        			</form>
        		</div>
    <div>        
      <table class="table mt-5">
        <thead class="bg-gray-dark text-white fw-bold">
           
           <th>Category Name</th>
           
           <th>Action</th>
        </thead>

        <tbody class="text-white bg-lite fs-4">
          
          @foreach($data as $data)  
            <tr>

                    <td class="pt-5">{{$data->catagory_name}}</td>
                    <td ><a onclick="return confirm('Are You Sure To Delete This')" href="{{url('delete_catagory', $data->id)}}" class="btn btn-outline-danger">Delete</a></td>


            </tr>
           @endforeach 
        </tbody>
        
    </table>
  </div>
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