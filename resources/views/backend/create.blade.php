@extends ('backend.main')
@section ('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">User</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Tambah User</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

     <!-- Main content -->
     <section class="content">
      <div class="container-fluid">

      <form action="{{route('user.store')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
          <!-- left column -->
          <div class="col-md-6">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Form Tambah User</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form>
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputName">Nama</label>
                    <input type="text" name="nama" class="form-control" id="exampleInputName" placeholder="Enter Name">
                    @error('nama')
                      <small>{{$message}}</small>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Email address</label>
                    <input type="email" name="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Password</label>
                    <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                    @error('password')
                      <small>{{$message}}</small>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label>Upload Gambar</label>
                    <input type="file" name="photo" class="form-control" id="photo">
                  </div>
                 
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
            </div>
            <!-- /.card -->
          <!--/.col (right) -->
        </div>
      </form>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
@endsection