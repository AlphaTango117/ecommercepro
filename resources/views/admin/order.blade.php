<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    @include('admin.css')
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
            
            <div style="padding-left: 400px ; padding-bottom: 30px;">

              <form action="{{url('/search')}}" method="GET">
                 <input style="color: black;" type="text" name="search" placeholder="search for something">
                 <input type="submit" value="Search" class="btn btn-primary">
              </form>
            </div>
              
          <table>
                <thead class="bg-gray-dark text-white fw-bold">
                   
                   <th>Name</th> 
                   <th>Email</th>
                   <th>Phone</th>
                   <th>Address</th>                 
                   <th>Product Title</th>  
                   <th>Quantity</th>  
                   <th>Price</th>   
                   <th>Payment Status</th>             
                   <th>Delivery Status</th>
                   <th>Image</th>
                   <th>Delivery</th>
                   <th>Print PDF</th>
                   <th>Send Email</th>
                </thead>
                <tbody class="text-white bg-lite fs-4">
                  
                  @forelse($order as $deliver)  
                    <tr>

                            <td>{{$deliver->name}}</td>
                            <td>{{$deliver->email}}</td>
                            <td>{{$deliver->phone}}</td>
                            <td>{{$deliver->address}}</td>
                            <td>{{$deliver->product_title}}</td>                       
                            <td>{{$deliver->quantity}}</td>
                            <td>{{$deliver->price}}</td>
                            <td>{{$deliver->payment_status}}</td>
                            <td>{{$deliver->delivery_status}}</td>
                            <td >
                              <img src="/product/{{$deliver->image}}">
                            </td>

                            
                            <td>

                              @if($deliver->delivery_status =='Processing')

                              <a href="{{url('delivery',$deliver->id)}}" onclick="return confirm('Are You Sure?')" class="btn btn-primary">Deliver</a>
                              
                                   @else

                                      <p>Delivered</p>
                            
                           @endif
                           </td>

                           <td >
                             <a href="{{url('print_pdf', $deliver->id)}}" class="btn btn-success">Print PDF</a>
                           </td>

                           <td >
                             <a href="{{url('send_email', $deliver->id)}}" class="btn btn-info">Send Email</a>
                           </td>
                    </tr>

                     @empty
                     <tr>
                      <td colspan="16">
                        No Data
                      </td>
                     </tr>

                   @endforelse 
                </tbody>
        
            </table>
            
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