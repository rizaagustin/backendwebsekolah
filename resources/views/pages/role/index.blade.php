@extends('layouts.dashboard')
@section('content')
<section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Daftar Role</h3>
                <div class="row">
                    <br>
                    <form action="{{ route('permission.index') }}" method="GET">
                    <div class="col-md-9">
                        <a href="javascript:void(0)" class="btn btn-primary mb-2" data-toggle="modal" data-target="#modal-add" id="btn-create-post">Tambah Role</a>
                    </div>
                    <div class="col-md-3">
                        <div class="input-group">
                            <input type="text" name="search" class="form-control">
                                <span class="input-group-btn">
                                  <button type="button" class="btn btn-info btn-flat">Cari</button>
                                </span>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
            <div class="box-body">
                <table id="" class="table table-bordered table-hover">
                  <thead>
                    <tr>
                        <th>#</th>
                        <th>Role</th>
                        <th>Permission</th>
                        <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($roles as $i => $role)
                    <tr>
                        <td>{{ $i + $roles->firstItem() }}</td>
                        <td>{{ $role->name }}</td>
                        <td>
                            @foreach ($role->permissions as $permission)
                                <li>{{ $permission->name }}</li>
                            @endforeach
                        </td>
                        <td>
                            <a href="javascript:void(0)" id="btn-edit-role" data-id="{{ $role->id }}" class="btn btn-success btn-sm"><i class="fa fa-fw fa-pencil"></i></a>
                            <a href="javascript:void(0)" id="btn-delete-role" data-id="{{ $role->id }}" class="btn btn-danger btn-sm"><i class="fa fa-fw fa-trash"></i></a>
                        </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
                <div class="d-flex justify-content-center">
                    {!! $roles->links() !!}
                </div>
            </div>
        </div>
      </div>
    </div>
</section>    

@include('pages.role.create')
@include('pages.role.edit')

@push('after-script')
<script>
    function addPermission(){
        var form = new FormData($('#addForm')[0]);
        $.ajax({
            url: "{{ route('role.store') }}",
            type: "POST",
            data: form,
            contentType: false,
            processData: false,
            dataType: 'json',
            beforeSend:function(){
            },
            success:function(response){
                $('#modal-add').modal('hide');
                Swal.fire({
                    text: 'Data Berhasil disimpan',
                    icon: 'success',
                    showConfirmButton: false,
                    timer: 2000,
                    willClose: () => {
                        location.reload();
                    }
                });
            },
            error:function(errors){
                $.each(errors.responseJSON, function( key, value ) {
                    $('.'+key+'_error').text(value[0]);
                });                                
            }
        })
    }

    $('body').on('click', '#btn-edit-role', function () {
        let id_role = $(this).data('id');
        let base_url = $('#base_url').val();
        $('#modal-edit input[type="checkbox"]').prop('checked', false);
        $.ajax({
            url: `${base_url}/role/${id_role}/edit`,  
            type: "GET",
            cache: false,
            success:function(response){
                $('#role_id').val(response.data.id);
                $('#name-edit').val(response.data.name);
                $.each(response.data.permissions, function( key, permission ) {
                    $('#modal-edit input[type="checkbox"][value="' + permission.id + '"]').prop('checked', true);
                });                                
                $('#modal-edit').modal('show');
            }
        });
    });

    function updateRole(){
        var form = new FormData($('#editForm')[0]);
        var role_id  =$('#role_id').val();        
        $.ajax({
            url: "{{ url('/') }}/role/"+role_id,
            type: "POST",
            data: form,
            contentType: false,
            processData: false,
            dataType: 'json',
            headers: {
                'X-HTTP-Method-Override': 'PUT'
            },
            beforeSend:function(){
                
            },
            success:function(response){
                $('#modal-edit').modal('hide');
                Swal.fire({
                    text: 'Data Berhasil disimpan',
                    icon: 'success',
                    showConfirmButton: false,
                    timer: 2000,
                    willClose: () => {
                        location.reload();
                    }
                });
            },
            error:function(errors){
                $.each(errors.responseJSON, function( key, value ) {
                    $('.'+key+'_error').text(value[0]);
                });                                
            }
        })

    }

    $('body').on('click', '#btn-delete-role', function () {
        let role_id = $(this).data('id');
        let token   = $("meta[name='csrf-token']").attr("content");
        Swal.fire({
            title: 'Apakah Kamu Yakin?',
            text: "ingin menghapus data ini!",
            icon: 'warning',
            showCancelButton: true,
            cancelButtonText: 'TIDAK',
            confirmButtonText: 'YA, HAPUS!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: `{{ url('/') }}/role/${role_id}`,
                    type: "DELETE",
                    cache: false,
                    data: {
                        "_token": token
                    },
                    success:function(response){ 
                        Swal.fire({
                            type: 'success',
                            icon: 'success',
                            title: `${response.message}`,
                            showConfirmButton: false,
                            timer: 2000,
                            willClose: () => {
                                location.reload();
                            }
                        });
                    }
                });                
            }
        })
    });

</script>
@endpush
@endsection
