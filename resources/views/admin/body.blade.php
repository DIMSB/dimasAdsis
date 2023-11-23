<div class="main-panel">
    <div class="content-wrapper">
        <h1>CEK</h1>
        <div class="row">
            <div class="col-md-12 grid-margin" class="div_center">
                @if(session('message'))
                    <h6 class="alert alert-success" >{{session('message')}}</h6>
                @endif
                <div class="me-md-3 me-xl-5">
                    <h2 class="font_size">Dashboard,</h2>
                    <p class="mb-md-0" class="font_size">Your analytics dashboard template.</p>
                    <hr>
                </div>

                <div class="row">
                    <div class="col-md-3">
                        <div class="card card-body bg-primary text-white mb-3">
                            <label>Total Products</label>
                            <h1>{{$totalProducts}}</h1>
                            <a href="{{url('order')}}" class="text-white">View</a>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card card-body bg-success text-white mb-3">
                            <label>Total Categories</label>
                            <h1>{{$totalCategories}}</h1>
                            <a href="{{url('order')}}" class="text-white">View</a>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card card-body bg-success text-white mb-3">
                            <label>Total Categories</label>
                            <h1>{{$totalCategories}}</h1>
                            <a href="{{url('order')}}" class="text-white">View</a>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card card-body bg-danger text-white mb-3">
                            <label>Total All Users</label>
                            <h1>{{$totalAllusers}}</h1>
                            <a href="{{url('order')}}" class="text-white">View</a>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card card-body bg-primary text-white mb-3">
                            <label>Total User</label>
                            <h1>{{$totalUser}}</h1>
                            <a href="{{url('order')}}" class="text-white">View</a>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card card-body bg-primary text-white mb-3">
                            <label>Total Admin</label>
                            <h1>{{$totalAdmin}}</h1>
                            <a href="{{url('order')}}" class="text-white">View</a>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card card-body bg-primary text-white mb-3">
                            <label>Total Order</label>
                            <h1>{{$totalOrder}}</h1>
                            <a href="{{url('order')}}" class="text-white">View</a>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card card-body bg-primary text-white mb-3">
                            <label>Today's Order</label>
                            <h1>{{$todayOrder}}</h1>
                            <a href="{{url('order')}}" class="text-white">View</a>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card card-body bg-primary text-white mb-3">
                            <label>This Month Order</label>
                            <h1>{{$thisMonthOrder}}</h1>
                            <a href="{{url('order')}}" class="text-white">View</a>
                        </div>
                    </div>
                    <div class="col-md-3">
                    <div class="card card-body bg-primary text-white mb-3">
                            <label>This Year order</label>
                            <h1>{{$thisYearOrder}}</h1>
                            <a href="{{url('order')}}" class="text-white">View</a>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>
      <!-- page-body-wrapper ends -->
    </div>
