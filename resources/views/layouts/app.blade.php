<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style type="text/css">
  		/* .dataTables_paginate .pagination{
  			justify-content: center !important;
  		} */
  	</style>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md bg-primary navbar-light shadow-sm">
            <div class="container">
              <a href="https://b-code.xyz/" class="navbar-brand float-left">
                <img src="{{ asset('image/logo.png') }}" height="50" class="d-none d-md-block">
                <img src="{{ asset('image/icon.png') }}" height="35" class="d-md-none">
              </a>
              <ul class="nav navbar-nav flex-row float-right">
                  @guest
                    <li class="nav-item"><a class="nav-link pr-3 text-light font-bold" href="{{ url('') }}">Home</a></li>
                    <li class="nav-item"><a class="nav-link btn btn-sm btn-md-lg btn-light text-dark mr-1 pl-2 pr-2" href="{{ route('login') }}">Login</a></li>
                    <li class="nav-item"><a class="nav-link btn btn-sm btn-md-md btn-danger text-light pl-2 pr-2" href="{{ route('register') }}">Sign up</a></li>
                  @else
                    <li class="nav-item dropdown">
                      <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                          {{ Auth::user()->name }} <span class="caret"></span>
                      </a>

                      <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                                   document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                      </div>
                    </li>
                @endguest
              </ul>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>

        <nav class="navbar fixed-bottom navbar-light  text-center" style="background: #e9ecef;">
      		<div style="background: rgba(0,0,0,.1);display:block;height:1px; width: 100%; margin: 0 auto;"></div>
      		<div class="col-md-12 col-12 text-center pt-3 pb-3">&copy; 2020 <a href="https://b-code.xyz/">BlackCode</a> Team</div>
      	</nav>
    </div>

    <!-- Scripts -->
    <!-- <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script> -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="{{ asset('js/app.js') }}"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
    <!-- <script type="text/javascript" src="{{ asset('js/main.js') }}"></script> -->
    <script type="text/javascript">


      $(function () {

          $.ajaxSetup({
              headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
          });

          var table = $('#tableParticipant').DataTable({
            "lengthChange": false,
            "pageLength": 5,
            "searching" : true,
            "paging" : true,
            "info" : true,
            "language": {
              "search" : "Cari : ",
              "zeroRecords": "Data tidak ditemukan",
              "info": "Jumlah Data : _MAX_",
              "infoEmpty": "Belum ada data",
              "infoFiltered": "(Hasil dari _MAX_ data)"
            },
              processing: true,
              serverSide: true,
              ajax: "{{ route('participant.index') }}",
              columns: [
                  {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                  {data: 'nameParticipant', name: 'nameParticipant'},
                  {data: 'numberParticipant', name: 'numberParticipant'},
              ]
          });



          $('#btnAmbilNomor').click(function () {
              $('#saveBtn').val("Ambil");
              $('#idParticipant').val('');
              $('#participantForm').trigger("reset");
              $('#modalAmbilNomorLabel').html("Ambil Nomor");
              $('#modalAmbilNomor').modal('show');
          });



          $('#saveBtn').click(function (e) {
              e.preventDefault();
              $(this).html('Sending..');
              alert($('#participantForm').serialize());
              $.ajax({
                data: $('#participantForm').serialize(),
                url: "{{ route('participant.store') }}",
                type: "POST",
                dataType: 'json',
                success: function (data) {

                    $('#participantForm').trigger("reset");
                    $('#modalAmbilNomor').modal('hide');
                    table.draw();

                },
                error: function (data) {
                    console.log('Error:', data);
                    $('#saveBtn').html('Simpan');
                }
            });
          });



      });

      function getRandomInt(max) {
        return Math.floor(Math.random() * Math.floor(max));
      }
    </script>
</body>
</html>
