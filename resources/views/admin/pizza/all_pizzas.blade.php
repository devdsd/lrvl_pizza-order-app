<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Pizzas
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
                            <h4>All Pizzas</h4>
                        </div>
                    
                        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                        
                            
                            <table class="table">
                            <thead>
                                <tr>
                                <!-- <th scope="col">SL No.</th> -->
                                <th scope="col">Pizza Name</th>
                                <th scope="col">    </th>
                                <th scope="col">Crust</th>
                                <th scope="col">Toppings</th>
                                <th scope="col">Price</th>
                                <!-- <th scope="col">Created At</th> -->
                                <th scope="col"> Actions </th>
                                </tr>
                            </thead>
                            <tbody>
                            <!-- Code -->
                            
                            @foreach($pizzas as $pizza)
                                <tr>
                                    <!-- <th scope="row">{{ $pizzas->firstItem()+$loop->index }}</th> -->
                                    
                                    <td>{{ $pizza->pizza_name }}</td>
                                            <!-- Pizza Image -->
                                    <td>
                                        <img src="{{ asset($pizza->pizza_image) }}" style="width:70px;height:50px;">
                                    </td>
                                    <td>{{ $pizza->crust }}</td>
                                    <td>{{ $pizza->toppings }}</td>
                                    <td>&#8369;{{ $pizza->price }}</td>

                                    <!-- @if($pizza->created_at == NULL)
                                        <td class="text-danger"> <i> No data set </i> </td>
                                    @else
                                        <td>{{ Carbon\Carbon::parse($pizza->created_at)->diffForHumans() }}</td>
                                    @endif -->
                                    <td>
                                        <a href="{{ url('/pizza/edit/'.$pizza->id) }}" class="btn btn-primary">Edit</a>
                                        <a href="{{ url('/pizza/delete/'.$pizza->id) }}" class="btn btn-outline-danger" onclick="return confirm('Are you sure to delete this Item?')">Delete</a>
                                        
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                            </table>
                            {{ $pizzas->links() }}
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header"> <h5>Add Pizza</h5> </div>
                        <div class="card-body">
                                <!-- Make sure to put enctype if you want to post images in your database and @csrf -->
                            <form action="{{ route('add_pizza') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Pizza Name</label>
                                    <input type="text" name="pizza_name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                    
                                    @error('pizza_name')
                                        <span class="text-danger"> {{ $message }} </span>
                                    @enderror
                                </div>

                                                <!-- For Pizza Image -->
                                <div class="mb-3">
                                    <label for="exampleInputEmail2" class="form-label">Pizza Image</label>
                                    <input type="file" name="pizza_image" class="form-control" id="exampleInputEmail2" aria-describedby="emailHelp">
                                    
                                    @error('pizza_image')
                                        <span class="text-danger"> {{ $message }} </span>
                                    @enderror
                                </div>
                                        <!-- Crusts -->
                                <div class="mb-3">
                                    <span>Select a crust </span>
                                    <select name="crust" class="custom-select mb-3">
                                        <option selected> </option>
                                        <option value="Stuffed Crust">Stuffed Crust</option>
                                        <option value="Thin Crust">Thin Crust</option>
                                        <option value="Cheese Crust">Cheese Crust</option>
                                        <option value="Thick Crust">Thick Crust</option>
                                    </select>

                                    @error('crust')
                                        <span class="text-danger"> {{ $message }} </span>
                                    @enderror
                                </div>
                                

                                <div class="mb-3">
                                    <span>Select a toppings: </span>
                                    <select name="toppings[]" class="custom-select mb-3" multiple>
                                        <option value="Pepperoni">Pepperoni</option>
                                        <option value="Mushroom">Mushroom</option>
                                        <option value="Sausage">Sausage</option>
                                        <option value="Onion">Onion</option>
                                        <option value="Tomato">Tomato</option>
                                        <option value="Black olives">Black olives</option>
                                    </select>

                                    @error('toppings')
                                        <span class="text-danger"> {{ $message }} </span>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Price</label>
                                    <input type="text" name="price" class="form-control mb-3" id="price">

                                    @error('price')
                                        <span class="text-danger"> {{ $message }} </span>
                                    @enderror

                                </div>

                                <button type="submit" class="btn btn-primary">Add</button>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>

    
    </div>
</x-app-layout>
