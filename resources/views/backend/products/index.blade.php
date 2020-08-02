@extends('backend.layouts.app')

@section('extra-css')
<!-- DataTables -->
<link rel="stylesheet" href="{{ asset('/') }}back/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="{{ asset('/') }}back/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
@endsection

@section('extra-js')
<!-- DataTables -->
<script src="{{ asset('/') }}back/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="{{ asset('/') }}back/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="{{ asset('/') }}back/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="{{ asset('/') }}back/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script>
    $(function () {
      $("#example1").DataTable({
        "responsive": true,
        "autoWidth": false,
      });
      $('#example2').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "responsive": true,
      });
    });
  </script>

  {{-- for delete action --}}
  <script>
    function myFunction() {
      event.preventDefault();
      var txt;
      var r = confirm('Are you sure to delete?');
      if (r == true) {
        document.getElementById('delete-form').submit();
      } else {
        return;
      }
    }
    </script>
@endsection

@section('main-content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            {{-- <h1>DataTables</h1> --}}
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
              <li class="breadcrumb-item active">Product List</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card  card-primary">
                <div class="card-header">
                    <h3 class="card-title">Product List</h3>
                    <a href="{{ route('products.create') }}" class="btn btn-success float-right btn-sm">Create a Product</a>
                </div>
              <!-- /.card-header -->
              <div class="card-body">
                @include('backend.partials.message')
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>SL</th>
                    <th>Product Name</th>
                    <th>Current Stock</th>
                    <th>Current Unit Price</th>
                    <th>Stock Date</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                @foreach ($products as $product)
                  <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->stocks[0]->current_stock }}</td>
                    <td>{{ $product->stocks[0]->unit_price }}</td>
                    <td>{{ Carbon\Carbon::parse($product->date_time)->format('d M, Y')  }}</td>
                    <td>
                      <a href="{{ route('products.edit', $product->id) }}" style="padding: 0 15px 0 15px">
                        <i class="fa fa-pencil-square-o" aria-hidden="true" style="font-size: 22px;color: green;"></i>
                      </a>

                      <a href="{{ route('products.destroy', $product->id) }}" onclick="myFunction()">
                        <i class="fa fa-trash-o" aria-hidden="true" style="font-size: 22px;color: red;"></i>
                      </a>
                      <form id="delete-form" action="{{ route('products.destroy', $product->id) }}" method="POST" style="display: none;">
                        @csrf
                        @method('DELETE')
                    </form>
                    </td>
                  </tr>
                @endforeach
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
@endsection