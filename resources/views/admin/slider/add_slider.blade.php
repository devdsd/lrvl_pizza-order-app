@extends('admin/admin_master')


@section('maincontent')

    <div class="card">
        <div class="card-body">
        <h5 class="card-title">Add Slider</h5>

        <!-- Add Slider Form -->
        <form action="{{ route('store_slider') }}" method="POST" enctype="multipart/form-data">
        @csrf
            <div class="col-12 mb-3">
            <label for="sldr_name" class="col-sm-2 col-form-label">Slider Name</label>
            <div class="col-12">
                <input name="sldr_name" type="text" class="form-control" id="sldr_name">
            </div>
            </div>
            <div class="col-12 mb-3">
            <label for="sldr_image" class="col-sm-2 col-form-label">Slider Image</label>
            <div class="col-12">
                <input name="sldr_image" class="form-control" type="file" id="formFile" id="sldr_image">
            </div>
            </div>
            <div class="col-12 mb-3">
            <label for="short_description" class="col-sm-2 col-form-label">Description</label>
            <div class="col-12">
                <textarea name="sldr_short_description" class="form-control" style="height: 100px" id="short_description"></textarea>
            </div>
            </div>

            <div class="col-12">
            <label class="col-sm-2 col-form-label"></label>
            <div class="col-12">
                <button class="btn btn-primary btn-md" type="submit">Add</button>
            </div>
            </div>

        </form>
        <!-- End Add Slider Form -->

        </div>
    </div>
@endsection