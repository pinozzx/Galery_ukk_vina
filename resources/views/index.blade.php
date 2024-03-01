<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Galery Ukk | Home</title>

  <!-- Google Font: Source Sans Pro -->
  
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
  <!-- AdminLTE css -->
  <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
</head>
<body class="hold-transition sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">
  <!-- Navbar -->
  <nav class="navbar navbar-expand navbar-dark navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
     
      <li class="nav-item d-none d-sm-inline-block">
        <a href="/galery" class="nav-link">Home</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">Selamat Datang {{ Session::get ('name') }}</a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Navbar Search -->
      <li class="nav-item">
        <a class="nav-link" data-widget="navbar-search" href="#" role="button">
          <i class="fas fa-search"></i>
        </a>
       
      </li>

      <!-- Messages Dropdown Menu -->
    
        
            <!-- Message End -->
         
            <!-- Message End -->
         
         
      <!-- Notifications Dropdown Menu -->
    
      
      <li class="nav-item">
        <a class="nav-link"  href="/logout" role="button">
          <i class="fas fa-user"> Logout</i>
        </a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
 

  <!-- Content Wrapper. Contains page content -->
  
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Galery</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item">
                <button class="btn btn-default" data-toggle="modal" data-target="#baru"><i class="fas fa-plus"></i> </button>
                
                </div>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <div class="alert">
      @if (session('alert'))
        <div class="alert alert-success"  style="font-size: 20px" 30ms>
        {{  session('alert') }}
        </div>
      @endif
    </div>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">

        <!-- Timelime example  -->
        <div class="row">
          <div class="col-md-12">
            <!-- The time line -->
            <div class="timeline">
              <!-- timeline time label -->
              @foreach ($galeries as $item)
                  
             
              <div class="time-label">
                <span class="bg-white">{{ date('d-M-Y', strtotime($item->created_at)) }}</span>
              </div>
              <!-- /.timeline-label -->
              <!-- timeline item -->
              <div>
                <i class="fa fa-camera bg-purple"></i>
                <div class="timeline-item">
                  <span class="time"><i class="fas fa-clock"></i>{{ date('D', strtotime($item->updated_at)) }}</span>
                  <h3 class="timeline-header"><a href="#">{{ $item->judul }}</a> {{ $item->deskripsi }}</h3>
                  <div class="timeline-body">
                    <img src="{{ Storage::url($item->photo) }}" alt="" height="300" width="300" >
                    <a href=" {{ Storage::url($item->photo) }}"  class="btn btn-light mr-3">Lihat</a>
                  </div>
                  <div class="row mb-3">
                    
                    <a href=" {{ Storage::url($item->photo) }}" download="photo" class="btn btn-dark mr-3"><i class="fas fa-download"></i></a>
                    <a href="3" class="btn btn-dark mr-3 edit" data-toggle="modal" data-target="#edit{{ $item->id }}"><i class="fas fa-edit"></i> Edit</a>
                    <form action="{{ route('galery.destroy', $item->id) }}" method="post">
                    @csrf
                    @method('DELETE')
                    <button id="delete" class="btn btn-danger" onclick="return confirm('Yakin Dihapus')"><i class="fas fa-trash"></i> Hapus</button>
            
                  </div>
                </form>
                <div class="modal fade" id="edit{{ $item->id }}">
                    <div class="modal-dialog modal-xl">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">
                                    Edit Galery
                                </h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                               
                            </div>
                            <form action="{{ route('galery.update', $item->id) }}" method="post" enctype="multipart/form-data" id="formpost">
                                @csrf
                                @method('PUT')
                            <input type="hidden" name="id" id="id">
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="judul">Judul</label>
                                    <input type="text" name="judul" id="judul" class="form-control" placeholder="Isikan Judul" value="{{ $item->judul }}">
                                    <span class="text-danger">
                                        @error('judul')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                                <div class="form-group">
                                    <label for="deskripsi">Deskripsi</label>
                                    <input type="text" name="deskripsi" id="deskripsi" class="form-control" placeholder="Isikan Deskripsi"  value="{{ $item->deskripsi }}">
                                    <span class="text-danger">
                                        @error('deskripsi')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                                <div class="form-group">
                                    <label for="photo">Photo</label>
                                    <input type="file" name="photo" id="photo" class="form-control" placeholder="Isikan Photo">
                                    <img src="{{ Storage::url($item->photo) }}" alt="" height="300" width="300">
                                    <span class="text-danger">
                                        @error('photo')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div>
                            <div class="modal-footer justify-content-between">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-primary" >Simpan</button>
                            </div>
                          </form>
                         
                          
                        </div>
                    </div>
                </div>
                </div>
              </div>
              @endforeach
             
              <!-- END timeline item -->
              <!-- timeline item -->
             
              <!-- END timeline item -->
              <!-- timeline item -->
            
              <!-- END timeline item -->
              <!-- timeline time label -->
              
              <!-- /.timeline-label -->
              <!-- timeline item -->
             
              <!-- END timeline item -->
              <!-- timeline item -->
            
              <!-- END timeline item -->
              
            </div>
          </div>
          <!-- /.col -->
        </div>
      </div>
      <!-- /.timeline -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
    <div class="modal fade" id="baru">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">
                        Buat Galery
                    </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('galery.store') }}" method="post" enctype="multipart/form-data" id="formpost">
                    @csrf
                <input type="hidden" name="id" id="id">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="judul">Judul</label>
                        <input type="text" name="judul" id="judul" class="form-control" placeholder="Isikan Judul">
                        <span class="text-danger">
                            @error('judul')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>
                    <div class="form-group">
                        <label for="deskripsi">Deskripsi</label>
                        <input type="text" name="deskripsi" id="deskripsi" class="form-control" placeholder="Isikan Deskripsi">
                        <span class="text-danger">
                            @error('deskripsi')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>
                    <div class="form-group">
                        <label for="photo">Photo</label>
                        <input type="file" name="photo" id="photo" class="form-control" placeholder="Isikan Photo">
                        <span class="text-danger">
                            @error('photo')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary" >Simpan</button>
                   
                </div>
                </form>
            </div>
        </div>
    </div>
  <footer class="main-footer ">
    <div class="float-right d-none d-sm-block " >
      <b>Version</b> 0.0.3
    </div>
    <strong>Copyright &copy; 2024</strong> Galery UKK
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('dist/js/adminlte.min.js') }}"></script>
<!-- AdminLTE for demo purposes -->
{{-- <script src="../../dist/js/demo.js"></script> --}}

</body>
</html>
