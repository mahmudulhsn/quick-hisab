@extends('backend.layouts.app')

@section('title')
    Quick Mart BD | Edit E\xpense
@endsection


@section('extra-css')
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('/') }}back/plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="{{ asset('/') }}back/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
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
              <li class="breadcrumb-item active">Edit Expense</li>
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
                    <h3 class="card-title">Edit Expense</h3>
                    <a href="{{ route('expenses.index') }}" class="btn btn-success float-right btn-sm">Expense List</a>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              @include('backend.partials.message')
              <form action="{{ route('expenses.update', $expense->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="card-body">
                  <div class="form-group">
                    <label for="amount">Amount</label>
                    <input type="text" class="form-control {{ $errors->has('amount') ? 'border border-danger' : '' }}" id="amount" placeholder="Amount" name="amount" value="{{ $expense->amount }}">
                    <small class="help-block text text-danger" data-bv-validator="notEmpty" data-bv-for="txtName" data-bv-result="INVALID" style="">{{ $errors->has('amount') ? $errors->first('amount') : '' }}</small>
                  </div>
                  <div class="form-group">
                    <label for="purpose">Select Expense Type</label>
                    <select class="form-control select2" style="width: 100%;" name="expense_type" required disabled>
                      <option value="other" {{ ($expense->expense_type == 'other') ? 'selected' : ''}}>Others</option>
                      <option value="boost" {{ ($expense->expense_type == 'boost') ? 'selected' : ''}}>By Boost</option>
                    </select>
                  </div>
                  @if (!empty($expense->purpose))
                  <div class="form-group">
                    <label for="purpose">Purpose</label>
                    <input type="text" class="form-control {{ $errors->has('purpose') ? 'border border-danger' : '' }}" id="purpose" placeholder="Purpose" name="purpose"  value="{{ $expense->purpose }}">
                    <small class="help-block text text-danger" data-bv-validator="notEmpty" data-bv-for="txtName" data-bv-result="INVALID" style="">{{ $errors->has('purpose') ? $errors->first('purpose') : '' }}</small>
                  </div>
                  @endif
                  @if (!empty($expense->product_id))
                  <div class="form-group product purpose">
                    <label for="productnName">Select a Product</label>
                    <select class="form-control select2" style="width: 100%;" name="product_id[]" multiple="multiple">
                      @foreach ($expense->product_id as $key => $item)
                        @foreach ($products as $product)
                        <option value="{{ $product->id }}" {{ ($product->id == $item) ? 'selected' : ''}}>{{ $product->name }}</option>
                        @endforeach
                      @endforeach
                    </select>
                    <small class="help-block text text-danger" data-bv-validator="notEmpty" data-bv-for="txtName" data-bv-result="INVALID" style="">{{ $errors->has('product_id') ? $errors->first('product_id') : '' }}</small>
                  </div>
                  @endif
                  <div class="form-group">
                    <label for="expenseBy">Expense By</label>
                    <input type="text" class="form-control {{ $errors->has('expense_by') ? 'border border-danger' : '' }}" id="expenseBy" placeholder="Expense By" name="expense_by"  value="{{ $expense->expense_by }}" >
                    <small class="help-block text text-danger" data-bv-validator="notEmpty" data-bv-for="txtName" data-bv-result="INVALID" style="">{{ $errors->has('expense_by') ? $errors->first('expense_by') : '' }}</small>
                  </div>
                  <div class="form-group">
                    <label for="datetimepicker7">Date</label>
                    <div class="input-group date" id="datetimepicker7" data-target-input="nearest">
                      <input type="text" class="form-control datetimepicker-input {{ $errors->has('date_time') ? 'border border-danger' : '' }}" id="datetimepicker5" data-toggle="datetimepicker" data-target="#datetimepicker7" name="date_time" value="{{ \Carbon\Carbon::parse($expense->date_time)->format('m/d/Y H:i:s') }}"/>
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