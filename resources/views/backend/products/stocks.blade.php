@extends('backend.layouts.app')

@section('title')
    Quick Mart BD | Stock In
@endsection

@section('extra-css')
      <!-- Select2 -->
  <link rel="stylesheet" href="{{ asset('/') }}back/plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="{{ asset('/') }}back/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
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
              <li class="breadcrumb-item active">Create New Stocks</li>
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
                    <h3 class="card-title">Stock a Product</h3>
                    <a href="{{ route('products.index') }}" class="btn btn-success float-right btn-sm">Product List</a>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              @include('backend.partials.message')
              <form action="{{ route('stocks.store') }}" method="POST">
                @csrf
                <div class="card-body">
                  <div class="form-group">
                    <label for="productnName">Select a Product</label>
                    <select class="form-control select2" style="width: 100%;" name="product_id">
                      @foreach ($products as $product)
                      <option value="{{ $product->id }}">{{ $product->name }}</option>
                      @endforeach
                    </select>
                    <small class="help-block text text-danger" data-bv-validator="notEmpty" data-bv-for="txtName" data-bv-result="INVALID" style="">{{ $errors->has('product_id') ? $errors->first('product_id') : '' }}</small>
                  </div>
                  <div class="form-group">
                    <label for="productnQuantity">Product Quantity (Pcs)</label>
                    <input type="text" class="form-control {{ $errors->has('quantity') ? 'border border-danger' : '' }}" id="productnQuantity" placeholder="Product Quantity" name="quantity"  value="{{ old('quantity')}}">
                    <small class="help-block text text-danger" data-bv-validator="notEmpty" data-bv-for="txtName" data-bv-result="INVALID" style="">{{ $errors->has('quantity') ? $errors->first('quantity') : '' }}</small>
                  </div>
                  <div class="form-group">
                    <label for="productnAmount">Total Amount</label>
                    <input type="text" class="form-control {{ $errors->has('total_amount') ? 'border border-danger' : '' }}" id="productnAmount" placeholder="Total Amount" name="total_amount"  value="{{ old('total_amount')}}" >
                    <small class="help-block text text-danger" data-bv-validator="notEmpty" data-bv-for="txtName" data-bv-result="INVALID" style="">{{ $errors->has('total_amount') ? $errors->first('total_amount') : '' }}</small>
                  </div>
                  <div class="form-group">
                    <label for="productnAmount">Date</label>
                    <div class="input-group date" id="datetimepicker7" data-target-input="nearest">
                      <input type="text" class="form-control datetimepicker-input {{ $errors->has('date_time') ? 'border border-danger' : '' }}" id="datetimepicker5" data-toggle="datetimepicker" data-target="#datetimepicker7" name="date_time"/>
                      <div class="input-group-append" data-target="#datetimepicker7" data-toggle="datetimepicker">
                          <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                      </div>
                  </div>
                    <small class="help-block text text-danger" data-bv-validator="notEmpty" data-bv-for="txtName" data-bv-result="INVALID" style="">{{ $errors->has('date_time') ? $errors->first('date_time') : '' }}</small>
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