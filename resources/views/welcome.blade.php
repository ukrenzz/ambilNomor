@extends('layouts.app')

@section('content')

  <div class="container bg-light mt-md-5 p-md-4 p-2 pb-4">
		<div class="col-12 col-md-12">
		  <h1 class="display-4">Hello</h1>
		  <p class="lead">Selamat datang di aplikasi random sederhana.</p>
		  <hr class="my-4">
		  <p>Silahkan klik untuk menentukan nomor anda.</p>
		  <button class="btn btn-primary btn-md-lg btn-md" id="btnAmbilNomor">Random</button>
		  <button class="btn btn-outline-success btn-md-lg btn-md"  data-toggle="modal" data-target="#modalHasil">Hasil Sementara</button>
		</div>
	</div>


  <!-- Jumbotron -->
	<div class="modal fade" id="modalAmbilNomor" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="modalAmbilNomorLabel" aria-hidden="true">
    <form id="participantForm" name="participantForm">
      <div class="modal-dialog" role="document">
  	    <div class="modal-content">
  	      <div class="modal-header bg-primary text-light">
  	        <h5 class="modal-title" id="modalAmbilNomorLabel">Ambil Nomor</h5>
  	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
  	          <span aria-hidden="true" class="text-light">&times;</span>
  	        </button>
  	      </div>
  	      <div class="modal-body bg-white">
            <input type="hidden" name="idParticipant" id="idParticipant">
  	        <div class="form-group">
  			    <label for="name">Nama Kamu</label>
  			    <input type="text" class="form-control" id="nameParticipant" name="nameParticipant" placeholder="Contoh : Tasya">
            <input type="hidden" name="numberParticipant" id="numberParticipant" value="">
  			</div>
  	      </div>
  	      <div class="modal-footer">
  	        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
  	        <button type="submit" class="btn btn-primary" id="saveBtn">Ambil</button>
  	      </div>
  	    </div>
  	  </div>
    </form>
	</div>

	<div class="modal fade" id="modalHasil" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="modalHasilLabel" aria-hidden="true">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header bg-primary text-light">
	        <h5 class="modal-title" id="modalHasilLabel">Hasil Penomoran</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true" class="text-light">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body bg-white">
	      	<div class="table-responsive pt-2 pb-2">
		        <table id="tableParticipant" class="table table-hover table-striped " style="width:100%;">
				    <thead>
				        <tr>
				            <th>No</th>
				            <th>Nama</th>
                    <th>Nomor Urut</th>
				        </tr>
				    </thead>
				    <tbody>
				        <tr>
				            <td>
				            	Kevin <br><small>(15 des 2019 12:15)</small>
				            </td>
				            <td>2</td>
				        </tr>
				        <tr>
				            <td>
				            	Kevin <br><small>(15 des 2019 12:15)</small>
				            </td>
				            <td>2</td>
				        </tr>
				    </tbody>
				</table>
			</div>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
	        <button type="button" class="btn btn-primary">Ambil</button>
	      </div>
	    </div>
	  </div>
	</div>

@endsection
