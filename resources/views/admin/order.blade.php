<!DOCTYPE html>
<html lang="en">
  <head>
    <style type="text/css">
        .title_deg
        {
            text-align: center;
            font-size: 25px;
            font-weight: bold;
            padding-bottom: 40px;
        }
        .table_deg
        {
          border: 2px solid white;
          width: 100%;
          margin: auto;
          padding-top: 50px;
          text-align: center;
        }
        .th_deg
        {
            background-color: skyblue;
            padding-bottom: 10px;
        }
        .img_Size
        {
            width: 200px;
            height: 200px;
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
        <div class="main-panel">
            <div class="content-wrapper">

                <h1 class="title_deg">All Orders</h1>

                <table class="table_deg">
                    <tr class="th_deg">
                        <th>Name</th>
                        <th>Email</th>
                        <th>Address</th>
                        <th>Phone</th>
                        <th>Product title</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Payment status</th>
                        <th>Delivery Status</th>
                        <th>Image</th>
                        <th>Delivered</th>
                    </tr>

                    @foreach($order as $order)
                    <tr class>
                      <td>{{$order->name}}</td>
                      <td>{{$order->email}}</td>
                      <td>{{$order->address}}</td>
                      <td>{{$order->phone}}</td>
                      <td>{{$order->product_title}}</td>
                      <td>{{$order->quantity}}</td>
                      <td>{{$order->price}}</td>
                      <td>{{$order->payment_status}}</td>
                      <td>{{$order->delivery_status}}</td>
                      <td>
                        <img class="img_Size" src="/product/{{$order->image}}" onclick="return confirm('Are you sure this product delivered?')">
                      </td>
                      <td>
                        @if($order->delivery_status=='processing')
                        <a href="{{url('delivered', $order->id)}}" class="btn btn-primary">Delivered</a>

                        @else
                        <p style="color: green;">Delivered</p>
                        @endif
                    </td>
                    </tr>

                    @endforeach
                </table>

            </div>
        </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    @include('admin.script')
    <!-- End custom js for this page -->
  </body>
</html>
