@extends('backend.layouts.app')

@section('extra-js')
<script type="text/javascript">
  $(function () {
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
              <li class="breadcrumb-item active">Edit Product</li>
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
                    <h3 class="card-title">Edit Product</h3>
                    <a href="{{ route('products.index') }}" class="btn btn-success float-right btn-sm">Product List</a>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              @include('backend.partials.message')
              <form action="{{ route('products.update', $product->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="card-body">
                  <div class="form-group">
                    <label for="productnName">Product Name</label>
                    <input type="text" class="form-control {{ $errors->has('name') ? 'border border-danger' : '' }}" id="productnName" placeholder="Product Name" name="name" value="{{ $product->name }}">
                    <small class="help-block text text-danger" data-bv-validator="notEmpty" data-bv-for="txtName" data-bv-result="INVALID" style="">{{ $errors->has('name') ? $errors->first('name') : '' }}</small>
                  </div>
                  <div class="form-group">
                    <label for="description">Descriptioon</label>
                    <textarea name="description" class="textarea" placeholder="Place some text here"
                          style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">{{ $product->description }}</textarea>
                  </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Update</button>
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