<?php

namespace App\Http\Controllers;

// Model
use App\Models\Pizza;

use Illuminate\Http\Request;

// Packages
use Auth;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use Image;

class PizzaController extends Controller
{

    public function allPizza() {
        $pizzas = Pizza::latest()->paginate(5);

        return view('admin/pizza/all_pizzas', compact('pizzas'));
    }

    public function addPizza(Request $request) {
        $validateData = $request->validate([
            'pizza_name' => 'required|unique:pizzas|max:100',
            'pizza_image' => 'required|mimes:jpg,jpeg,png,gif',
            'crust' => 'required|max:100',
            'toppings' => 'required|max:100',
            'price' => 'required',
        ],
        [
            'pizza_name.required' => "Please input Pizza Name [required]",
            'pizza_name.max' => "Please limit it to 100 characters",
            'pizza_image.required' => "Please include Pizza Image [required]",
            'pizza_image.mimes' => "Only accepts .jpg, jpeg, and gif",
            'crust.required' => "Please choose a Crust [required]",
            'toppings.required' => "Please choose a Toppings [required]",
            'price.required' => "Please specify a price [required]",
        ]);

            // Getting the image
        $pizza_image = $request->file('pizza_image');
        
            // Generating Name for the image
        $image_name = hexdec(uniqid()).".".$pizza_image->getClientOriginalExtension();

        Image::make($pizza_image)->resize(500,300)->save('images/pizzas/'.$image_name);

        $final_image = 'images/pizzas/'.$image_name;

        $crust = $request->get("crust");

        $toppings = "";
        foreach($request->get("toppings") as $topping) {
            if($toppings == "") {
                $toppings = $toppings . " " . (string) $topping;
            }
            else {
                $toppings = $toppings . ", " . (string) $topping;
            }
        }
        
        Pizza::insert([
            'pizza_name' => $request->pizza_name,
            'pizza_image' => $final_image,
            'crust' => $crust,
            'toppings' => $toppings,
            'price' => $request->price,
            'created_at' => Carbon::now(),
        ]);


        return Redirect()->back()->with('success', 'Pizza Added Successfully!');

    }


    public function editPizza($id) {
        //     // Eloquent ORM
        $pizza_data = Pizza::find($id);

        return view('admin.pizza.edit_pizza', compact('pizza_data'));
    }


    public function updatePizza(Request $request, $id) {

        $validateData = $request->validate([
            'pizza_name' => 'required|max:100',
            'pizza_image' => 'mimes:jpg,jpeg,png,gif',
            'price' => 'required',
        ],
        [
            'pizza_name.required' => "Please input Pizza Name [required]",
            'pizza_name.max' => "Please limit it to 100 characters",
            'pizza_image.required' => "Please include Pizza Image [required]",
            'pizza_image.mimes' => "Only accepts .jpg, jpeg, and gif",
            'price.required' => "Please specify a price [required]",
        ]);
        

        $pizza_name = $request->pizza_name;
        $old_crust = $request->old_crust;
        $old_image = $request->old_image;
        $pizza_image = $request->file('pizza_image');
        $toppings = $request->get("toppings");
        $old_toppings = $request->old_toppings;
        $price = $request->price;

            // If the update involved changing the pizza image
        if($pizza_image) {

                // Generate a random name to the images uploaded
            $name_generate = hexdec(uniqid()); // it will generate random hexadecimal value for name

                // extrating the extension of the uploaded image
            $img_extension = strtolower($pizza_image->getClientOriginalExtension());

                // Combine the generated random name to extension
            $image_file = $name_generate.'.'.$img_extension;

                // Location where to store the image
            $upload_location = 'images/pizzas/';

                // Final Image ready to be uploaded
            $final_image = $upload_location.$image_file;

                // move() to actually upload the file
            $pizza_image->move($upload_location,$image_file);

            unlink($old_image); // Unlinking previous image

            if($toppings) {
                $topps = "";
                foreach($toppings as $topping) {
                    if($topps == "") {
                        $topps = $topps . " " . (string) $topping;
                    }
                    else {
                        $topps = $topps . ", " . (string) $topping;
                    }
                }

            } else {
                $topps = $old_toppings;
            }

            
            error_log("Crust: ".$request->get("crust"));
            if($request->get("crust")) {
                $crust = $request->get("crust");
            }
            else {
                $crust = $old_crust;
            }

            Pizza::find($id)->update([
                'pizza_name' => $pizza_name,
                'pizza_image' => $final_image,
                'crust' => $crust,
                'toppings' => $topps,
                'price' => $price,
                'created_at' => Carbon::now(),
            ]);

            return Redirect()->back()->with('success', 'Pizza Updated Successfully!');
        }
                // If it doesn't involve changing the image
        else {

            if($toppings) {
                $topps = "";
                foreach($toppings as $topping) {
                    if($topps == "") {
                        $topps = $topps . " " . (string) $topping;
                    }
                    else {
                        $topps = $topps . ", " . (string) $topping;
                    }
                }

            } else {
                $topps = $old_toppings;
            }

            if($request->get("crust")) {
                $crust = $request->get("crust");
            }
            else {
                $crust = $old_crust;
            }

            error_log("Pizza Name: ".$pizza_name);
            error_log("Pizza Image: ".$old_image);
            error_log("Crust: ".$crust);
            error_log("Toppings: ".$topps);
            error_log("Price: ".$price);
            error_log("Created At: ".Carbon::now());

            Pizza::find($id)->update([
                'pizza_name' => $pizza_name,
                'pizza_image' => $old_image,
                'crust' => $crust,
                'toppings' => $topps,
                'price' => $price,
                'created_at' => Carbon::now(),
            ]);

            return Redirect()->back()->with('success', 'Pizza Updated Successfully!');
        }
    }


    public function deletePizza($id) {
            // Get the pizza image and remove it
        $image = Pizza::find($id);
        $delete_image = $image->pizza_image;

            // To delete the saved file in your public folder
        unlink($delete_image);

        Pizza::find($id)->delete();

        return Redirect()->back()->with("deleted", "Pizza deleted successfully!");
    }

}
