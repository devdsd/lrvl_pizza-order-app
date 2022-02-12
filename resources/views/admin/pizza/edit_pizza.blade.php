<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit Pizza
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
                        <div class="card-header"> Edit </div>
                        <div class="card-body">

                                        <!-- Form to update the existing Pizza Name and Pizza Image  -->
                            <form action="{{ url('/pizza/update/'.$pizza_data->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf

                                <!-- To get the old image data to be replaced by the new one -->

                                <input type="hidden" name="old_image" id="old_image" value="{{ $pizza_data->pizza_image }}">

                                <div class="mb-3">
                                    <label for="pizza_name" class="form-label">Edit Pizza Name</label>
                                    <input type="text" name="pizza_name" class="form-control" id="pizza_name" aria-describedby="emailHelp" value="{{ $pizza_data->pizza_name }}">
                                    
                                    @error('pizza_name')
                                        <span class="text-danger"> {{ $message }} </span>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                <label for="pizza_image" class="form-label">Edit Pizza Image</label>

                                    <img src="{{ asset($pizza_data->pizza_image) }}" style="width:350px;height:250px;">
                                    <br>
                                    <input type="file" name="pizza_image" class="form-control" id="pizza_image" aria-describedby="emailHelp">
                                    
                                    @error('pizza_image')
                                        <span class="text-danger"> {{ $message }} </span>
                                    @enderror
                                </div>

                                        <!-- Crusts -->
                                <strong> Crust: <p style="color: blue;"> {{ $pizza_data->crust }} </p></strong>
                                <input type="hidden" name="old_crust" id="old_crust" value="{{ $pizza_data->crust }}">
                                <span>Edit a crust </span>
                                <select name="crust" class="custom-select mb-3">
                                    <option selected disabled value="{{ $pizza_data->crust }}"> {{ $pizza_data->crust }} </option>
                                    <option value="Stuffed Crust">Stuffed Crust</option>
                                    <option value="Thin Crust">Thin Crust</option>
                                    <option value="Cheese Crust">Cheese Crust</option>
                                    <option value="Thick Crust">Thick Crust</option>
                                </select>

                                        <!-- Toppings -->
                                <strong>Toppings: <p style="color: blue;"> {{ $pizza_data->toppings }} </p> </strong>
                                <input type="hidden" name="old_toppings" id="old_toppings" value="{{ $pizza_data->toppings }}">

                                <span>Edit a toppings: </span>
                                <select name="toppings[]" class="custom-select mb-3" multiple>
                                    <option value="Pepperoni">Pepperoni</option>
                                    <option value="Mushroom">Mushroom</option>
                                    <option value="Sausage">Sausage</option>
                                    <option value="Onion">Onion</option>
                                    <option value="Tomato">Tomato</option>
                                    <option value="Black olives">Black olives</option>
                                </select>

                                <label for="exampleInputEmail1" class="form-label">Price</label>
                                <input type="text" name="price" class="form-control mb-3" id="price" value="{{ $pizza_data->price }}">


                                <button type="submit" class="btn btn-primary">Update</button>
                            </form>
                        </div>
                    </div>
                </div>
                

            </div>
        </div>
    </div>
</x-app-layout>
