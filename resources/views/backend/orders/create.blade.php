@extends('backend.layouts.app')

@section('extra-css')
      <!-- Select2 -->
      <link rel="stylesheet" href="{{ asset('/') }}back/plugins/select2/css/select2.min.css">
      <link rel="stylesheet" href="{{ asset('/') }}back/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
<style>
  table, th, td {
    /* border: 1px solid black; */
  }
  tr > td:last-of-type {
    width: 8%;
    text-align: center;
  }
  tr>th{
    text-align: center;
  }
  table, th, td {
    width: 30%;
  }
  table {
    width: 100%;
    border-collapse: collapse;
    padding: 2px;
  }
</style>
@endsection

@section('extra-js')
<!-- Select2 -->
<script src="{{ asset('/') }}back/plugins/select2/js/select2.full.min.js"></script>
<script type="text/javascript">
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

    //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })

    $('#datetimepicker7').datetimepicker();
  });
</script>
  <script type="text/javascript">
    $(function () {
        $('#datetimepicker7').datetimepicker();
    });
  </script>

<script type="text/javascript">
  $(document).ready(function(){
      var maxField = 20; //Input fields increment limitation
      var addButton = $('.add_button'); //Add button selector
      var wrapper = $('.field_wrapper'); //Input field wrapper
      // var fieldHTML = '<div><input type="text" name="field_name[]" value=""/><a href="javascript:void(0);" class="remove_button"><img src="remove-icon.png"/></a></div>'; //New input field html 


      var fieldHTML = '<tr><td><select class="form-control select2" style="width: 100%;" name="product[product_id][]" required> @foreach ($products as $product) <option value="{{ $product->id }}">{{ $product->name }}</option>@endforeach </select></td><td><input type="text" class="form-control" placeholder="Quantity" name="product[qty][]" required></td><td><input type="text" class="form-control" placeholder="Total Amount"  name="product[total][]" required></td><td> <a href="javascript:void(0);" class="remove_button" title="Add field"><i class="fa fa-minus-circle" aria-hidden="true" style="font-size: 30px; color: red;"></i></a></td></tr>'; //New input field html 
      var x = 1; //Initial field counter is 1
      
      //Once add button is clicked
      $(addButton).click(function(){
          //Check maximum number of input fields
          if(x < maxField){ 
              x++; //Increment field counter
              $(wrapper).append(fieldHTML); //Add field html
          }
      });
      
      //Once remove button is clicked
      $(wrapper).on('click', '.remove_button', function(e){
          e.preventDefault();
          $(this).parent().parent('tr').remove(); //Remove field html
          x--; //Decrement field counter
      });
  });
</script>
@endsection

@section('main-content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            {{-- <h1>General Form</h1> --}}
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
              <li class="breadcrumb-item active">Create New Order</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                    <h3 class="card-title">Create New Order</h3>
                    <a href="{{ route('orders.index') }}" class="btn btn-success float-right btn-sm">Product List</a>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              @include('backend.partials.message')
              <form action="{{ route('orders.store') }}" method="POST">
                @csrf
                <div class="card-body">
                  <div class="form-group">
                    <label for="customerName">Customer Name</label>
                    <input type="text" class="form-control {{ $errors->has('customer_name') ? 'border border-danger' : '' }}" id="customerName" placeholder="Product Name" name="customer_name" value="{{ old('customer_name')}}">
                    <small class="help-block text text-danger" data-bv-validator="notEmpty" data-bv-for="txtName" data-bv-result="INVALID" style="">{{ $errors->has('customer_name') ? $errors->first('customer_name') : '' }}</small>
                  </div>

                  <div class="form-group">
                    <label for="customerEmail">Cusotomer Email</label>
                    <input type="text" class="form-control {{ $errors->has('customerEmail') ? 'border border-danger' : '' }}" id="customer_email" placeholder="Cusotomer Email" name="customer_email"  value="{{ old('customer_email')}}">
                    <small class="help-block text text-danger" data-bv-validator="notEmpty" data-bv-for="txtName" data-bv-result="INVALID" style="">{{ $errors->has('customer_email') ? $errors->first('customer_email') : '' }}</small>
                  </div>

                  <div class="form-group">
                    <label for="customerPhoneNo">Customer Phone Number</label>
                    <input type="text" class="form-control {{ $errors->has('customer_phone_no') ? 'border border-danger' : '' }}" id="customerPhoneNo" placeholder="Customer Phone Number" name="customer_phone_no"  value="{{ old('customer_phone_no')}}" >
                    <small class="help-block text text-danger" data-bv-validator="notEmpty" data-bv-for="txtName" data-bv-result="INVALID" style="">{{ $errors->has('customer_phone_no') ? $errors->first('customer_phone_no') : '' }}</small>
                  </div>

                  <div class="form-group">
                    <label for="discount">Discount</label>
                    <input type="number" class="form-control {{ $errors->has('discount') ? 'border border-danger' : '' }}" id="discount" placeholder="Customer Phone Number" name="discount"  value="0" >
                    <small class="help-block text text-danger" data-bv-validator="notEmpty" data-bv-for="txtName" data-bv-result="INVALID" style="">{{ $errors->has('discount') ? $errors->first('discount') : '' }}</small>
                  </div>

                  <div class="form-group">
                    <label for="productnAmount">Date</label>
                    <div class="input-group date" id="datetimepicker7" data-target-input="nearest">
                        <input type="text" class="form-control datetimepicker-input {{ $errors->has('date_time') ? 'border border-danger' : '' }}" id="datetimepicker5" data-toggle="datetimepicker" data-target="#datetimepicker7" name="date_time"/>
                        {{-- <input type="text" class="form-control datetimepicker-input" data-target="#datetimepicker7"/> --}}
                        <div class="input-group-append" data-target="#datetimepicker7" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                        </div>
                    </div>
                    {{-- <input type="date" class="form-control " id="productnAmount" placeholder="Total Amount" name="total_amount"  value="{{ old('total_amount')}}" > --}}
                    <small class="help-block text text-danger" data-bv-validator="notEmpty" data-bv-for="txtName" data-bv-result="INVALID" style="">{{ $errors->has('date_time') ? $errors->first('date_time') : '' }}</small>
                  </div>

                  <div class="form-group">
                    <label>Product</label>
                    <table  class="field_wrapper">
                      <tr>
                        <th>Product Name</th>
                        <th>Quantity</th>
                        <th>Total Amount</th>
                        <th></th>
                      </tr>
                      <tr>
                        <td>
                          <select class="form-control select2" style="width: 100%;" name="product[product_id][]" required>
                          @foreach ($products as $product)
                          <option value="{{ $product->id }}">{{ $product->name }}</option>
                          @endforeach
                        </select>
                      </td>
                        <td><input type="text" class="form-control" placeholder="Quantity" name="product[qty][]" required></td>
                        <td><input type="text" class="form-control" placeholder="Total Amount" name="product[total][]" required></td>
                        <td> <a href="javascript:void(0);" class="add_button" title="Add field"><i class="fa fa-plus-circle" aria-hidden="true" style="font-size: 30px; color: green;"></i></a></td>
                      </tr>
                    </table>
                  </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Save</button>
                </div>
              </form>
            </div>
            <!-- /.card -->

          </div>
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
@endsection