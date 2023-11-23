<!DOCTYPE html>
<html lang="en">
  <head>
  <style>
        .div_center
        {
            text-align: center;
            padding-top:40px;
        }
        .font_size
        {
            font-size: 40px;
            padding-bottom:40px;
        }
    </style>
    <!-- Required meta tags -->
    @include('admin.css')
    </head>
  <body>
    <div class="container-scroller">
      <!-- partial:partials/_sidebar.html -->
       @include('admin.sidebar')
      <!-- partial -->
       @include('admin.header')
        <!-- partial -->
        @include('admin.body')
    <!-- container-scroller -->
    <!-- plugins:js -->
    @include('admin.script')
    <!-- End custom js for this page -->
  </body>
</html>
