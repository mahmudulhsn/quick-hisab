@extends('backend.layouts.app')

@section('title')
    Quick Mart BD | Order List
@endsection

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
  <script type="text/javascript">
    function deleteData(id)
    {
        var id = id;
        var url = '{{ route("orders.destroy", ":id") }}';
        url = url.replace(':id', id);
        $("#deleteForm").attr('action', url);
    }

    function formSubmit()
    {
        $("#deleteForm").submit();
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
              <li class="breadcrumb-item active">Order List</li>
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
                    <h3 class="card-title">Order List</h3>
                    <a href="{{ route('orders.create') }}" class="btn btn-success float-right btn-sm">Place an Order</a>
                </div>
              <!-- /.card-header -->
              <div class="card-body">
                @include('backend.partials.message')
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>SL</th>
                    <th>Name</th>
                    <th>Phone</th>
                    <th>Address</th>
                    <th>Ordered Product</th>
                    <th>Total</th>
                    <th>Date</th>
                    {{-- <th>Action</th> --}}
                  </tr>
                  </thead>
                  <tbody>
                @foreach ($orders as $order)
                  <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $order->customer_name }}</td>
                    <td>{{ $order->customer_phone_no }}</td>
                    <td>{{ $order->address }}</td>
                    @php
                        $prod = [];
                    @endphp
                    @for ($i = 0; $i < count($order->product['product_id']); $i++)
                    @php
                        $pro = \App\Models\Product::findOrFail($order->product['product_id'][$i]);
                        $qty = $order->product['qty'][$i];
                        $prod[] = $pro->name . " (". $qty . ") ";
                    @endphp
                    @endfor
                    @php
                        $bracket = ["[", "]", ]
                    @endphp
                    <td>{{ str_replace($bracket, "", json_encode($prod)) }}</td>
                    <td>{{ $order->total_amount  }}</td>
                    <td>{{ Carbon\Carbon::parse($order->date_time)->format('d M, Y')  }}</td>
                    {{-- <td>
                      <a href="{{ route('orders.edit', $order->id) }}" style="padding: 0 15px 0 15px">
                        <i class="fa fa-pencil-square-o" aria-hidden="true" style="font-size: 22px;color: green;"></i>
                      </a>

                      <a href="javascript:;" data-toggle="modal" onclick="deleteData({{$order->id}})"
                        data-target="#DeleteModal" style="padding: 0 15px 0 15px;"><i class="fa fa-trash-o" style="font-size: 22px;color: red;"></i>
                      </a>

                      <div id="DeleteModal" class="modal fade text-danger" role="dialog">
                          <div class="modal-dialog ">
                            <!-- Modal content-->
                            <form action="" id="deleteForm" method="post">
                                <div class="modal-content">
                                    <div class="modal-header bg-danger">
                                      <h4 class="modal-title text-center">DELETE CONFIRMATION</h4>
                                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    </div>
                                    <div class="modal-body">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}
                                        <p class="text-center">Are You Sure Want To Delete ?</p>
                                    </div>
                                    <div class="modal-footer">
                                        <center>
                                            <button type="button" class="btn btn-success" data-dismiss="modal">Cancel</button>
                                            <button type="submit" name="" class="btn btn-danger" data-dismiss="modal" onclick="formSubmit()">Yes, Delete</button>
                                        </center>
                                    </div>
                                </div>
                            </form>
                          </div>
                      </div>
                    </td> --}}
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
