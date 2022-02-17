@extends('admin/admin_master')


@section('maincontent')

    <div class="pagetitle">
      <h1>Users</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
          <li class="breadcrumb-item active">Users</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">All Users</h5>

              <!-- Table with stripped rows -->
              <table class="table datatable">
                <thead>
                  <tr>
                  <th scope="col">SL No.</th>
                  <th scope="col">Name</th>
                  <th scope="col">Email</th>
                  <th scope="col">Created At</th>
                  </tr>
              </thead>
              <tbody>
              
              @php($i = 1)
              @foreach($users as $user)
                  <tr>
                  <th scope="row">{{ $i++ }}</th>
                  <td>{{ $user->name }}</td>
                  <td>{{ $user->email }}</td>
                  <td>{{ Carbon\Carbon::parse($user->created_at)->diffForHumans() }}</td>

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