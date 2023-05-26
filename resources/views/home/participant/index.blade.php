@extends('layout.app')

@push('style')
    <link href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css" rel="stylesheet">
@endpush

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Peserta</h1>
        </div>
        <div class="card">
            <div class="card-body">
                <div class="text-end">
                    <a href="{{ route('home.participant.create') }}" class="btn btn-primary mb-3 text-white fw-bold me-2"><i class="fa fa-plus me-2"></i>Tambah Peserta</a>
                </div>
                
                <table class="table table-striped" id="datatable">
                    <thead>
                        <tr class="bg-grey">
                            <th rowspan="2" class="text-center align-middle">#</th>
                            <th rowspan="2" class="text-center align-middle">NAMA</th>
                            <th rowspan="2" class="text-center align-middle">EMAIL</th>
                            <th colspan="4" class="text-center">NILAI</th>
                            <th rowspan="2" class="text-center align-middle">AKSI</th>
                        </tr>
                        <tr>
                            <th>X</th>
                            <th>Y</th>
                            <th>Z</th>
                            <th>W</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </section>
@endsection

@push('script')
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            var table = $('#datatable').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: '{!! url()->current() !!}'
                },
                columnDefs: [
                    {
                        className: 'text-center',
                        "targets": "_all"
                    }
                ],
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'name', name: 'name'},
                    {data: 'email', name: 'email'},
                    {data: 'x', name: 'x'},
                    {data: 'y', name: 'y'},
                    {data: 'z', name: 'z'},
                    {data: 'w', name: 'w'},
                    {
                        data: 'action', 
                        name: 'action', 
                        orderable: false, 
                        searchable: false
                    },
                ]
            });
        });

        function button_delete(id){
            Swal.fire({
                type: 'warning',
                title: 'Anda yakin?',
                text: "Anda tidak akan dapat mengembalikan data!",
                showCancelButton: true,
                confirmButtonColor: '#d33',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal',
                reverseButtons: true
            }).then((result) => {
                if(result.value == true){
                    var url = "{{ route('home.participant.delete',["id" => ":id"]) }}";
                    url = url.replace(':id', id);

                    $.ajax({
                        type: "POST",
                        dataType: "json",
                        url: url,
                        data:{
                            "_token": "{{ csrf_token() }}",
                        },
                        success: function(data){
                            if(data.success){
                                Swal.fire(
                                    'Terhapus!',
                                    'Data Peserta Berhasil dihapus',
                                    "success"
                                );
                            }

                            setTimeout(function(){
                                location.reload();
                            }, 1000); 
                        },
                        error: function (data){
                            Swal.fire(
                                'Gagal',
                                'Data Peserta Gagal dihapus',
                                'error'
                            );

                            setTimeout(function(){
                                location.reload();
                            }, 1000); 
                        }
                    });
                }
            });
        }
    </script>
@endpush