<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// Models
use App\Models\Slider;


// Packages
use Auth;
use Image;
use Carbon\Carbon;


class SliderController extends Controller
{
    public function homeSlider() {
        $sliders = Slider::all();
        return view('admin/slider/slider', compact('sliders'));
    }

    public function addSliderForm() {
        return view('admin/slider/add_slider');
    }

    public function storeSlider(Request $request) {
        $validateData = $request->validate([
            'sldr_name' => 'required|max:100',
            'sldr_image' => 'required|mimes:jpg,jpeg,png',
        ],
        [
            'sldr_name.required' => "Please input Slider Name [required]",
            'sldr_name.max' => "Please limit it to 100 characters",
            'sldr_image.required' => "Please include Slider Image [required]",
            'sldr_image.mimes' => "Only accepts .jpg, jpeg, and gif",
        ]);

            // Getting the image
        $slider_image = $request->file('sldr_image');
        
            // Generating Name for the image
        $image_name = hexdec(uniqid()).".".$slider_image->getClientOriginalExtension();

        Image::make($slider_image)->save('backend/assets/img/slider/'.$image_name);

        $final_image = 'backend/assets/img/slider/'.$image_name;

        $sldr_name = $request->get("sldr_name");
        $sldr_short_desc = $request->get("sldr_short_description");

        Slider::insert([
            'sldr_name' => $sldr_name,
            'sldr_image' => $final_image,
            'sldr_short_description' => $sldr_short_desc,
            'created_at' => Carbon::now()
        ]);

        return Redirect()->route('home_slider')->with('success', 'Slider Add Succesfully!');
    }
}
