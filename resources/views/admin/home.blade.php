<!DOCTYPE html>
<html lang="en">
  <head>

    <!-- Required meta tags -->
    @include('admin.css')
  </head>
  <body>
     @include('admin.navbar')
    <div class="container-scroller">
      <!-- partial:partials/_sidebar.html -->
     @include('admin.sidebar')
      <!-- partial -->

      <div class="container-fluid page-body-wrapper">
        <!-- partial:partials/_navbar.html -->
        
      @include('admin.body')
        <!-- partial -->
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