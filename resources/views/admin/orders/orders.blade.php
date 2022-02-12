<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orders</title>

    <!-- Bootstrap 4 Css [CDN] -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
</head>
<body> 
        <div class="py-12 mt-5">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8"> 
            <div class="container-md">

                <div class="d-flex justify-content-center mb-5">
                    <a href="{{ route('welcome') }}">
                        <img src="{{ asset('images/pizzas/pizza_logo.png') }}" style="width:100px;height:100px;margin-top:2px;">
                    </a>
                    <h1 style="padding-left:20px;" class="text-primary mt-5">Pizza Order App</h1>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        
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
                                    </tr>
                                </thead>
                                <tbody>
                                        <!-- Datas -->
                                @foreach($orders as $order)
                                    <tr>
                                        <th scope="row">{{ $order->id }}</th>
                                        
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
                                    </tr>
                                @endforeach
                                </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            </div>
        </div>
                        <!-- Bootstrap 4 Js [CDN] -->
        <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>
</body>
</html>