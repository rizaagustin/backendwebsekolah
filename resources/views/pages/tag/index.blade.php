@extends('layouts.dashboard')
@section('content')
<section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Data Tag</h3>
                <div class="row">
                    <br>
                    <form action="{{ route('tag.index') }}" method="GET">
                    <div class="col-md-9">
                        @can('tags.create')
                            <a href="javascript:void(0)" class="btn btn-primary mb-2" data-toggle="modal" data-target="#modal-add" id="btn-create-post">Add Tag</a>                            
                        @endcan
                    </div>
                    <div class="col-md-3">
                        <div class="input-group">
                            <input type="text" name="search" class="form-control">
                                <span class="input-group-btn">
                                  <button type="button" class="btn btn-info btn-flat">Search</button>
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
                        <th>name</th>
                        <th>slug</th>
                        <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($tags as $i => $tag)
                    <tr>
                        <td>{{ $i + $tags->firstItem() }}</td>
                        <td>{{ $tag->name }}</td>
                        <td>{{ $tag->slug }}</td>
                        <td>
                            @can('tags.edit')
                                <a href="javascript:void(0)" id="btn-edit-tag" data-id="{{ $tag->id }}" class="btn btn-success btn-sm"><i class="fa fa-fw fa-pencil"></i></a>                                
                            @endcan
                            @can('tags.delete')
                                <a href="javascript:void(0)" id="btn-delete-tag" data-id="{{ $tag->id }}" class="btn btn-danger btn-sm"><i class="fa fa-fw fa-trash"></i></a>                                
                            @endcan
                        </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
                <div class="d-flex justify-content-center">
                    {!! $tags->links() !!}
                </div>
            </div>
        </div>
      </div>
    </div>
</section> 

@include('pages.tag.create')
@include('pages.tag.edit')

@push('after-script')
<script>
    function addTag(){
        var form = new FormData($('#addForm')[0]);
        $('.error-text').text('');
        $.ajax({
            url: "{{ route('tag.store') }}",
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
                    text: `${response.message}`,
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

    $('body').on('click', '#btn-edit-tag', function () {
        let id_tag = $(this).data('id');
        let base_url = $('#base_url').val();
        $('#modal-edit input[type="checkbox"]').prop('checked', false);
        $.ajax({
            url: `${base_url}/admin/tag/${id_tag}/edit`,  
            type: "GET",
            cache: false,
            success:function(response){
                $('#tag_id').val(response.data.id);
                $('#name-edit').val(response.data.name);
                $('#modal-edit').modal('show');
            }
        });
    });

    function updateTag(){
        var form = new FormData($('#editForm')[0]);
        var tag_id  =$('#tag_id').val();     
        $('.error-text').text('');   
        $.ajax({
            url: "{{ url('/') }}/admin/tag/"+tag_id,
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
                    text: `${response.message}`,
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

    $('body').on('click', '#btn-delete-tag', function () {
        let user_id = $(this).data('id');
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
                    url: `{{ url('/') }}/admin/tag/${user_id}`,
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