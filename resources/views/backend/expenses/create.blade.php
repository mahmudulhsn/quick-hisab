@extends('backend.layouts.app')

@section('title')
    Quick Mart BD | Add new Expense
@endsection

@section('extra-css')
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('/') }}back/plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="{{ asset('/') }}back/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">

    <style>
      input[type=button] {
          width: 75px;
      }
      form {
          padding: .5em;
          margin: .5em;
          border: 1px dashed #ccc;
      }
    </style>
@endsection

@section('extra-js')
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

  $("select").change(function () {
      // hide all optional elements
      $('.purpose').css('display','none');

      $("select option:selected").each(function () {
          if($(this).val() == "boost") {
              $('.product').css('display','block');
              $('.other').css('display','none');
          } else if($(this).val() == "other") {
              $('.other').css('display','block');
              $('.product').css('display','none');
          }
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
              <li class="breadcrumb-item active">Add New Expense</li>
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
                    <h3 class="card-title">Add new Expense</h3>
                    <a href="{{ route('expenses.index') }}" class="btn btn-success float-right btn-sm">Expense List</a>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              @include('backend.partials.message')
              <form action="{{ route('expenses.store') }}" method="POST">
                @csrf
                <div class="card-body">
                  <div class="form-group">
                    <label for="amount">Amount</label>
                    <input type="text" class="form-control {{ $errors->has('amount') ? 'border border-danger' : '' }}" id="amount" placeholder="Amount" name="amount" value="{{ old('amount')}}">
                    <small class="help-block text text-danger" data-bv-validator="notEmpty" data-bv-for="txtName" data-bv-result="INVALID" style="">{{ $errors->has('amount') ? $errors->first('amount') : '' }}</small>
                  </div>

                  <div class="form-group">
                    <label for="purpose">Select Expense Type</label>
                    <select class="form-control select2" style="width: 100%;" name="expense_type" required>
                      <option value="other">Others</option>
                      <option value="boost">By Boost</option>
                    </select>
                  </div>

                  <div class="form-group product purpose" style="display: none;">
                    <label for="productnName">Select a Product</label>
                    <select class="form-control select2" style="width: 100%;" name="product_id[]" multiple="multiple">
                      @foreach ($products as $product)
                      <option value="{{ $product->id }}">{{ $product->name }}</option>
                      @endforeach
                    </select>
                    <small class="help-block text text-danger" data-bv-validator="notEmpty" data-bv-for="txtName" data-bv-result="INVALID" style="">{{ $errors->has('product_id') ? $errors->first('product_id') : '' }}</small>
                  </div>

                  <div class="form-group other purpose">
                    <label for="purpose">Purpose</label>
                    <input type="text" class="form-control {{ $errors->has('purpose') ? 'border border-danger' : '' }}" id="purpose" placeholder="Purpose" name="purpose"  value="{{ old('purpose')}}">
                    <small class="help-block text text-danger" data-bv-validator="notEmpty" data-bv-for="txtName" data-bv-result="INVALID" style="">{{ $errors->has('purpose') ? $errors->first('purpose') : '' }}</small>
                  </div>

                  <div class="form-group">
                    <label for="expenseBy">Expense By</label>
                    <input type="text" class="form-control {{ $errors->has('expense_by') ? 'border border-danger' : '' }}" id="expenseBy" placeholder="Expense By" name="expense_by"  value="{{ old('expense_by')}}" >
                    <small class="help-block text text-danger" data-bv-validator="notEmpty" data-bv-for="txtName" data-bv-result="INVALID" style="">{{ $errors->has('expense_by') ? $errors->first('expense_by') : '' }}</small>
                  </div>
                  <div class="form-group">
                    <label for="datetimepicker7">Date</label>
                    <div class="input-group date" id="datetimepicker7" data-target-input="nearest">
                      <input type="text" class="form-control datetimepicker-input {{ $errors->has('date_time') ? 'border border-danger' : '' }}" id="datetimepicker5" data-toggle="datetimepicker" data-target="#datetimepicker7" name="date_time" value="{{ old('date_time')}}"/>
                      {{-- <input type="text" class="form-control datetimepicker-input" data-target="#datetimepicker7"/> --}}
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