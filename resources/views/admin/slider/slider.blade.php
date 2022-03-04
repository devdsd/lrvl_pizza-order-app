@extends('admin/admin_master')


@section('maincontent')

    <div class="pagetitle">
        <h1>Slider</h1>
        <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
            <li class="breadcrumb-item active">Slider</li>
        </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
        <div class="col-lg-12">

            <div class="card">
            <div class="card-body">
                <div class="row">
                    <h5 class="card-title">All Sliders</h5>
                    <a href="{{ route('add_slider_form') }}" class="btn btn-primary btn-md">Add Slider</a>
                </div>

                <!-- Table with stripped rows -->
                <table class="table datatable table-hover">
                <thead>
                    <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Image</th>
                    <th scope="col">Description</th>
                    </tr>
                </thead>
                <tbody>
                
                @php($i = 1)
                @foreach($sliders as $slider)
                    <tr>
                    <th scope="row">{{ $i++ }}</th>
                    <td>{{ $slider->sldr_name }}</td>
                    <td><img src="{{ asset($slider->sldr_image) }}" width="120px" height="90px" alt="{{ $slider->sldr_name }}"></td>
                    <td>{{ $slider->sldr_short_description }}</td>

                    </tr>
                @endforeach
                </tbody>
                </table>
                <!-- End Table with stripped rows -->

            </div>
            </div>

        </div>
        </div>
    </section>

@endsection