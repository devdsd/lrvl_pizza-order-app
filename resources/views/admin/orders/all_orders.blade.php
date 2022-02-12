<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Orders
        </h2>
    </x-slot>

    <div class="py-12">
        <!-- <div class="max-w-7xl mx-auto sm:px-6 lg:px-8"> --> 
        <div class="container">
            <div class="row">
                
                <div class="col-md-8">

                                    <!-- Alerts -->
                            @if(session('success'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <strong>{{ session('success') }}</strong>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @elseif(session('removed'))
                                <div class="alert alert-secondary alert-dismissible fade show" role="alert">
                                    <strong>{{ session('removed') }}</strong>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                @elseif(session('deleted'))
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <strong>{{ session('deleted') }}</strong>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif
                    
                    <div class="card">
                        
                        <div class="card-header">
                            <h4>All Orders</h4>
                        </div>
                    
                        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                        
                            
                            <table class="table">
                            <thead>
                                <tr>
                                <th scope="col">Order No.</th>
                                <th scope="col">Pizza</th>
                                <th scope="col">   </th>
                                <th scope="col">User</th>
                                <th scope="col">No. of Order</th>
                                <th scope="col">Total Amount</th>
                                <th scope="col">Created At</th>
                                <th scope="col"> Actions </th>
                                </tr>
                            </thead>
                            <tbody>
                            <!-- Code -->
                            
                            @foreach($orders as $order)
                                <tr>
                                    <th scope="row">{{ $orders->firstItem()+$loop->index }}</th>
                                    
                                    <td>{{ $order->pizzarelation->pizza_name }}</td>
                                    <td>
                                        <img src="{{ asset($order->pizzarelation->pizza_image) }}" style="width:70px;height:50px;">
                                    </td>
                                    <td>{{ $order->userrelation->name }}</td>
                                    <td>{{ $order->no_of_order }}</td>
                                    <td> &#8369; {{ $order->total_amount }}</td>
                                    @if($order->created_at == NULL)
                                        <td class="text-danger"> <i> No data set </i> </td>
                                    @else
                                        <td>{{ Carbon\Carbon::parse($order->created_at)->diffForHumans() }}</td>
                                    @endif
                                    <td>
                                        <a href="{{ url('/order/edit/'.$order->id) }}" class="btn btn-primary">Edit</a>
                                        <a href="{{ url('/order/remove/'.$order->id) }}" class="btn btn-outline-danger">Remove</a>
                                        
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                            </table>
                            {{ $orders->links() }}
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header"> <h5>Add Order</h5> </div>
                        <div class="card-body">
                            <form action="{{ route('add_order') }}" method="POST">
                                @csrf
                                        <!-- Selection of Pizza -->
                                <div class="mb-3">
                                    <label for="select_pizza" class="form-label">Select a Pizza</label>
                                    <select id="select_pizza" name="pizza" class="custom-select mb-3">
                                        <option selected> </option>
                                        @foreach($pizzas as $pizza)
                                            <option value="{{ $pizza->id }}">{{ $pizza->pizza_name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="mb-2">
                                    <label for="number_of_order" class="form-label">Number of Order</label>
                                    <input type="text" name="no_of_order" class="form-control mb-3" id="number_of_order">
                                </div>

                                <button type="submit" class="btn btn-primary">Add</button>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>


                            <!-- Trashed Orders -->
        @if(count($trashed_orders)!=0)
        <div class="py-12">
        <!-- <div class="max-w-7xl mx-auto sm:px-6 lg:px-8"> --> 
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    
                    <div class="card">
                        
                        <div class="card-header">
                            Trashed Orders
                        </div>
                    
                        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                        
                            
                            <table class="table">
                            <thead>
                                <tr>
                                <th scope="col">Order No.</th>
                                <th scope="col">Pizza</th>
                                <th scope="col">   </th>
                                <th scope="col">User</th>
                                <th scope="col">No. of Order</th>
                                <th scope="col">Total Amount</th>
                                <th scope="col">Created At</th>
                                <th scope="col"> Actions </th>
                                </tr>
                            </thead>
                            <tbody>
                            <!-- Code -->
                            
                            @foreach($trashed_orders as $order)
                                <tr>
                                <th scope="row">{{ $trashed_orders->firstItem()+$loop->index }}</th>
                                    
                                    <td>{{ $order->pizzarelation->pizza_name }}</td>
                                    <td>
                                        <img src="{{ asset($order->pizzarelation->pizza_image) }}" style="width:70px;height:50px;">
                                    </td>
                                    <td>{{ $order->userrelation->name }}</td>
                                    <td>{{ $order->no_of_order }}</td>
                                    <td> &#8369; {{ $order->total_amount }}</td>
                                    @if($order->created_at == NULL)
                                        <td class="text-danger"> <i> No data set </i> </td>
                                    @else
                                        <td>{{ Carbon\Carbon::parse($order->created_at)->diffForHumans() }}</td>
                                    @endif
                                    <td>
                                        <a href="{{ url('/order/restore/'.$order->id) }}" class="btn btn-info">Restore</a>
                                        <a href="{{ url('/order/delete/'.$order->id) }}" class="btn btn-danger">Delete</a>
                                        
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                            </table>
                            {{ $trashed_orders->links() }}
                        </div>
                    </div>
                </div>

                <div class="col-md-4">


                </div>

            </div>
        </div>
        @endif
    
    
    </div>
</x-app-layout>
