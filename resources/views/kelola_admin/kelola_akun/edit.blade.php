 @extends('tampilan.admin')

 @section('title_admin', 'Tambah Data Akun')

 @section('admin')

     <div class="content-wrapper">

         <div class="content-header">
             <div class="container-fluid">
                 <div class="row mb-2">
                     <div class="col-sm-6">

                         <h1><i class="fas fa-users"></i> Kelola Akun</h1>

                     </div>
                     <div class="col-sm-6">
                         <ol class="breadcrumb float-sm-right">
                             <li class="breadcrumb-item"><a href="{{ url('home') }}">Home</a></li>
                             <li class="breadcrumb-item active">Dashboard v1</li>
                         </ol>
                     </div>
                 </div>
             </div>
         </div>
         <section class="content">
             <!-- Default box -->

             <form action="{{ route('akun_edit', $edit->id) }}" method="POST" enctype="multipart/form-data">
                 @csrf
                 <div class="card card-danger card-outline">
                     <div class="card-header">
                         <div class="card-title">Tambah data Akun</div>
                     </div>
                     <div class="card-body">
                         <div class="row">
                             <div class="col-sm-10">
                                 <div class="form-group">
                                     <label for="">Nama Akun</label>
                                     <input type="text" name="name" value="{{ $edit->name }}"
                                         class="form-control form-control-sm" required>
                                     @error('name')
                                         <small class="text-danger">{{ $message }}</small>
                                     @enderror
                                 </div>

                                 <div class="form-group">
                                     <label for="">Alamat</label>
                                     <input type="text" name="alamat" value="{{ $edit->DetailUser->alamat }}"
                                         class="form-control form-control-sm" required>
                                     @error('email')
                                         <small class="text-danger">{{ $message }}</small>
                                     @enderror
                                 </div>

                                 <div class="form-group">
                                     <label for="">Nomor Telepon</label>
                                     <input type="text" name="nohp" value="{{ $edit->DetailUser->nohp }}"
                                         class="form-control form-control-sm" required>
                                     @error('email')
                                         <small class="text-danger">{{ $message }}</small>
                                     @enderror
                                 </div>

                                 <div class="form-group">
                                     <label for="">Status</label>
                                     <select class="form-control" name="status" {{ $edit->status }}
                                         aria-label="Default select example">
                                         <option selected>Pilih Status </option>
                                         <option value="admin">Admin</option>
                                         <option value="orang gudang">Orang Gudang</option>
                                     </select>
                                 </div>

                             </div>
                         </div>
                     </div>
                     <div class="card-footer">
                         <button type="submit" class="btn btn-primary">Update</button>
                         <a href="{{ route('kelola_akun') }}" class="btn btn-warning">Back</a>
                     </div>
                 </div>
             </form>
         </section>
         <!-- /.content -->
     </div>
 @endsection
