$(document).ready( function () {
  $('#tableParticipant').DataTable({
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
    }
  });
} );


$(function () {

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    var table = $('.tableParticipant').DataTable({
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
        $('#id_participant').val('');
        $('#participantForm').trigger("reset");
        $('#modalAmbilNomorLabel').html("Ambil Nomor");
        $('#modalAmbilNomor').modal('show');
    });

   //  $('body').on('click', '.editProduct', function () {
   //    var product_id = $(this).data('id');
   //    $.get("{{ route('ajaxproducts.index') }}" +'/' + product_id +'/edit', function (data) {
   //        $('#modelHeading').html("Edit Product");
   //        $('#saveBtn').val("edit-user");
   //        $('#ajaxModel').modal('show');
   //        $('#product_id').val(data.id);
   //        $('#name').val(data.name);
   //        $('#detail').val(data.detail);
   //    })
   // });

    $('#saveBtn').click(function (e) {
        e.preventDefault();
        $(this).html('Sending..');

        $.ajax({
          data: $('#participantForm').serialize(),
          url: urlSent,
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

    // $('body').on('click', '.deleteProduct', function () {
    //
    //     var product_id = $(this).data("id");
    //     confirm("Are You sure want to delete !");
    //
    //     $.ajax({
    //         type: "DELETE",
    //         url: "{{ route('ajaxproducts.store') }}"+'/'+product_id,
    //         success: function (data) {
    //             table.draw();
    //         },
    //         error: function (data) {
    //             console.log('Error:', data);
    //         }
    //     });
    // });

});

function getRandomInt(max) {
  return Math.floor(Math.random() * Math.floor(max));
}
