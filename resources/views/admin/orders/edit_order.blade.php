<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit Category
        </h2>
    </x-slot>

    <div class="py-12">
        <!-- <div class="max-w-7xl mx-auto sm:px-6 lg:px-8"> --> 
        <div class="container">
            <div class="row">

                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header"> Edit </div>
                        <div class="card-body">
                            <form action="{{ url('/order/update/'.$order_data->id) }}" method="POST">
                                @csrf
                                <input type="hidden" name="user_id" id="user_id" value="{{ $order_data->user_id }}">

                                <strong> Pizza: <p style="color: blue;"> {{ $order_data->pizzarelation->pizza_name }} </p></strong>
                                <img class="mb-2" src="{{ asset($order_data->pizzarelation->pizza_image) }}" style="width:350px;height:250px;">
                                <input type="hidden" name="old_pizza" id="old_pizza" value="{{ $order_data->pizzarelation->id }}">
                                
                                <div class="mb-3">
                                    <label for="select_pizza" class="form-label">Change pizza for this order</label>
                                    <select id="select_pizza" name="new_pizza" class="custom-select mb-3">
                                        <option selected> </option>
                                        @foreach($pizzas as $pizza)
                                            <option value="{{ $pizza->id }}">{{ $pizza->pizza_name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="mb-2">
                                    <label for="number_of_order" class="form-label">Number of Order</label>
                                    <input type="text" name="no_of_order" class="form-control mb-3" id="number_of_order" value="{{ $order_data->no_of_order }}">
                                </div>

                                <button type="submit" class="btn btn-primary">Update</button>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
