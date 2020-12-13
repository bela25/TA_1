<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Apartemen TamanSari</title>

  <!-- Custom fonts for this template-->
  <link href="{{asset('admin/vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="{{asset('admin/css/sb-admin-2.min.css')}}" rel="stylesheet">
  <!-- Custom styles for this page -->
  <link href="{{ asset('admin/vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">

  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <!-- <link rel="stylesheet" href="{{('adminlte/dist/css/adminlte.min.css')}}"> -->
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

  <style type="text/css" media="print">
    * {
        -webkit-print-color-adjust: exact !important; /*Chrome, Safari */
        color-adjust: exact !important;  /*Firefox*/
    }
    @media print {
      .screen-area {
         display: none;
      }
    }
  </style>

</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{route('home')}}">
        <div class="sidebar-brand-icon rotate-n-15">
         <i class="fas fa-hotel"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Apartemen TamanSari </div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Dashboard -->
      <li class="nav-item">
       <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseDashboard" aria-expanded="true" aria-controls="
       collapseDashboard">
         <i class="fas fa-chart-bar"></i>
          <span>Dashboard</span></a>
           <div id="collapseDashboard" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Menu Dashboard:</h6>
            <!-- <a class="collapse-item" href="{{route('home')}}">Grafik</a> -->
            <a class="collapse-item" href="{{route('profils.index')}}">Profil</a>
            <a class="collapse-item" href="{{route('promosis.index')}}">Promosi</a>
            <a class="collapse-item" href="{{route('feedbacks.index')}}">Feedback</a>
          </div>
        </div>
      </li>

      <li class="nav-item">
       <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLaporan" aria-expanded="true" aria-controls="
       collapseLaporan">
         <i class="fas fa-file-alt"></i>
          <span>Laporan</span></a>
           <div id="collapseLaporan" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Menu Laporan:</h6>
            <a class="collapse-item" href="{{ route('laporan.penjualan') }}">Penjualan</a>
            <!-- <a class="collapse-item" href="{{ route('laporan.pembayaran') }}">Pembayaran</a> -->
            <!-- <a class="collapse-item" href="{{ route('laporan.penundaan') }}">Penundaan</a> -->
            <a class="collapse-item" href="{{ route('laporan.pembatalan') }}">Pembatalan</a>
            <a class="collapse-item" href="{{ route('laporan.jatuhtempo') }}">Jatuh Tempo</a>
            <a class="collapse-item" href="{{ route('laporan.cicilan') }}">Cicilan</a>
          </div>
        </div>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Heading -->
      <div class="sidebar-heading">
        Fitur
      </div>

      <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link" href="{{route('transaksis.index')}}">
          <i class="fas fa-funnel-dollar"></i>
          <span>Transaksi</span></a>
      </li>
      @if(auth()->user()->pegawai != null && auth()->user()->pegawai->jabatan == 'marketing')
      <li class="nav-item">
        <a class="nav-link" href="{{route('units.index')}}">
          <i class="fas fa-building"></i>
          <span>Unit</span></a>
      </li>
      @endif
      <!-- <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTransaksi" aria-expanded="true" aria-controls="collapseTransaksi">
          <i class="fas fa-funnel-dollar"></i>
          <span>Transaksi</span>
        </a>
        <div id="collapseTransaksi" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Menu Transaksi:</h6>
            <a class="collapse-item" href="{{route('transaksis.index')}}">Penjualan</a>
            <a class="collapse-item" href="{{route('cicilans.index')}}">Cicilan</a>
            <a class="collapse-item" href="{{route('pembatalans.index')}}">Pembatalan</a>
          </div>
        </div>
      </li> -->

      <!-- Nav Item - Utilities Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePengguna" aria-expanded="true" aria-controls="collapsePengguna">
          <i class="far fa-address-card"></i>
          <span>Pengguna</span>
        </a>
        <div id="collapsePengguna" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Menu Pengguna:</h6>
            @if(auth()->user()->pegawai->jabatan == 'admin')
            <a class="collapse-item" href="{{route('lokasipegawais.index')}}">Lokasi Pegawai</a>
            <a class="collapse-item" href="{{route('pegawais.index')}}">Pegawai</a>
            @endif
            <a class="collapse-item" href="{{route('customers.index')}}">Pelanggan</a>
           
          </div>
        </div>
      </li>

       <!-- Divider -->
      <hr class="sidebar-divider">

      @if(auth()->user()->pegawai != null && auth()->user()->pegawai->jabatan == 'admin')
      <!-- Heading -->
      <div class="sidebar-heading">
        Master
      </div>

      <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseMaster" aria-expanded="true" aria-controls="collapseMaster">
          <i class="fas fa-fw fa-folder"></i>
          <span>File Master</span>
        </a>
        <div id="collapseMaster" class="collapse" aria-labelledby="headingFour" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">File:</h6>
            <a class="collapse-item" href="{{route('lokasis.index')}}">Lokasi</a>
            <a class="collapse-item" href="{{route('towers.index')}}">Tower</a>
            <a class="collapse-item" href="{{route('tipe_units.index')}}">Tipe</a>
            <a class="collapse-item" href="{{route('units.index')}}">Unit</a>
            <a class="collapse-item" href="{{route('arah_units.index')}}">Arah Tower</a>
            <a class="collapse-item" href="{{route('spesifikasi_bangunans.index')}}">Spesifikasi Bangunan</a>
            <a class="collapse-item" href="{{route('hargajuals.index')}}">Harga Jual</a>
            <a class="collapse-item" href="{{route('gambar_produks.index')}}">Gambar Produk</a>
          </div>
        </div>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider">
      @endif

      <!-- Heading -->
      <div class="sidebar-heading">
        Chat
      </div>

      <!-- Nav Item - Chat -->
      <li class="nav-item">
        <a class="nav-link" href="{{route('chattings.index')}}">
          <i class="fas fa-comments"></i>
          <span>Chatting</span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

    </ul>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

          <!-- Sidebar Toggle (Topbar) -->
          <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>

          <!-- Topbar Navbar -->
          <ul class="navbar-nav ml-auto">           

            <div class="topbar-divider d-none d-sm-block"></div>
            @if(auth()->check())
            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{ucfirst(auth()->user()->name)}}</span>
                <img class="img-profile rounded-circle" src="https://source.unsplash.com/QAB-WJcbgJk/60x60">
              </a>
              <!-- Dropdown - User Information -->
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="{{route('pegawais.ubahprofil',auth()->user()->pegawai)}}">
                  <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                  Profile
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                  Logout
                </a>
              </div>
            </li>
            @endif

          </ul>

        </nav>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">

          @yield('content')
          
        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

      <!-- Footer -->
      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Apartemen TamanSari</span>
          </div>
        </div>
      </footer>
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-primary" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
              {{ csrf_field() }}
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="{{ asset ('admin/vendor/jquery/jquery.min.js')}}"></script>
  <script src="{{ asset('admin/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

  <!-- Core plugin JavaScript-->
  <script src="{{asset('admin/vendor/jquery-easing/jquery.easing.min.js')}}"></script>
   <!-- Page level plugins -->
  <script src="{{ asset('admin/vendor/datatables/jquery.dataTables.min.js')}}"></script>
  <script src="{{asset('admin/vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>
  <script src="{{asset('adminlte/plugins/moment/moment.min.js')}}"></script>
  <script src="{{asset('adminlte/plugins/inputmask/min/jquery.inputmask.bundle.min.js')}}"></script>
  <script src="{{asset('adminlte/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')}}"></script>
  <!-- bs-custom-file-input -->
  <script src="{{asset('adminlte/plugins/bs-custom-file-input/bs-custom-file-input.min.js')}}s"></script>
  <!-- Custom scripts for all pages-->
  <script src="{{ asset('admin/js/sb-admin-2.min.js')}}"></script>
  <script src="{{asset('admin/vendor/chart.js/Chart.min.js')}}"></script>
  <script src="https://cdn.jsdelivr.net/npm/autonumeric@4.5.4"></script>
  <script type="text/javascript">
    // Call the dataTables jQuery plugin
    $(document).ready(function() {
      $('#dataTable').DataTable();
      $('.dataTable').DataTable();

      $('#tgllahir').datetimepicker({
        format: 'Y-MM-DD'
      });
    });

    function NumericInput(inp, locale) {
      var numericKeys = '0123456789';

      // restricts input to numeric keys 0-9
      inp.addEventListener('keypress', function(e) {
        var event = e || window.event;
        var target = event.target;

        if (event.charCode == 0) {
          return;
        }

        if (-1 == numericKeys.indexOf(event.key)) {
          // Could notify the user that 0-9 is only acceptable input.
          event.preventDefault();
          return;
        }
      });

      // add the thousands separator when the user blurs
      inp.addEventListener('blur', function(e) {
        var event = e || window.event;
        var target = event.target;

        var tmp = target.value.replace(/,/g, '');
        var val = Number(tmp).toLocaleString(locale);

        if (tmp == '') {
          target.value = '';
        } else {
          target.value = 'Rp'+val;
        }
      });

      // strip the thousands separator when the user puts the input in focus.
      inp.addEventListener('focus', function(e) {
        var event = e || window.event;
        var target = event.target;
        var val = target.value.replace(/[,.]/g, '');

        target.value = val;
      });
    }
    // var number = new NumericInput(document.getElementById('demo'));

    // Set new default font family and font color to mimic Bootstrap's default styling
    Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
    Chart.defaults.global.defaultFontColor = '#858796';

    function number_format(number, decimals, dec_point, thousands_sep) {
      // *     example: number_format(1234.56, 2, ',', ' ');
      // *     return: '1 234,56'
      number = (number + '').replace(',', '').replace(' ', '');
      var n = !isFinite(+number) ? 0 : +number,
        prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
        sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
        dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
        s = '',
        toFixedFix = function(n, prec) {
          var k = Math.pow(10, prec);
          return '' + Math.round(n * k) / k;
        };
      // Fix for IE parseFloat(0.55).toFixed(0) = 0;
      s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
      if (s[0].length > 3) {
        s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
      }
      if ((s[1] || '').length < prec) {
        s[1] = s[1] || '';
        s[1] += new Array(prec - s[1].length + 1).join('0');
      }
      return s.join(dec);
    }

    function printing() {
      var printContents = document.getElementById('print-area').innerHTML;

      var originalContents = document.body.innerHTML;

      document.body.innerHTML = printContents;

      window.print();

      document.body.innerHTML = originalContents;
    }
  </script>
  @stack('scripts')

</body>

</html>