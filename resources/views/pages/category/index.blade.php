@extends('layouts.dashboard')
@section('content')
<section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Data Category</h3>
                <div class="row">
                    <br>
                    <form action="{{ route('category.index') }}" method="GET">
                    <div class="col-md-9">
                        @can('categories.create')
                            <a href="javascript:void(0)" class="btn btn-primary mb-2" data-toggle="modal" data-target="#modal-add" id="btn-create-post">Add Category</a>
                        @endcan
                    </div>
                    <div class="col-md-3">
                        <div class="input-group">
                            <input type="text" name="search" class="form-control" placeholder="search">
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
                        <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($categories as $i => $category)
                    <tr>
                        <td>{{ $i + $categories->firstItem() }}</td>
                        <td>{{ $category->name }}</td>
                        <td>{{ $category->slug }}</td>
                        <td>
                            @can('categories.edit')
                                <a href="javascript:void(0)" id="btn-edit-category" data-id="{{ $category->id }}" class="btn btn-success btn-sm"><i class="fa fa-fw fa-pencil"></i></a>                                
                            @endcan
                            @can('categories.delete')
                                <a href="javascript:void(0)" id="btn-delete-category" data-id="{{ $category->id }}" class="btn btn-danger btn-sm"><i class="fa fa-fw fa-trash"></i></a>                                
                            @endcan
                        </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
                <div class="d-flex justify-content-center">
                    {!! $categories->links() !!}
                </div>
            </div>
        </div>
      </div>
    </div>
</section> 

@include('pages.category.create')
@include('pages.category.edit')

@push('after-script')
<script>
    function addCategory(){
        var form = new FormData($('#addForm')[0]);
        $('.error-text').text('');
        $.ajax({
            url: "{{ route('category.store') }}",
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

    $('body').on('click', '#btn-edit-category', function () {
        let id_category = $(this).data('id');
        let base_url = $('#base_url').val();
        $('#modal-edit input[type="checkbox"]').prop('checked', false);
        $.ajax({
            url: `${base_url}/admin/category/${id_category}/edit`,  
            type: "GET",
            cache: false,
            success:function(response){
                $('#category_id').val(response.data.id);
                $('#name-edit').val(response.data.name);
                $('#modal-edit').modal('show');
            }
        });
    });

    function updateCategory(){
        var form = new FormData($('#editForm')[0]);
        var category_id  =$('#category_id').val();     
        $('.error-text').text('');   
        $.ajax({
            url: "{{ url('/') }}/admin/category/"+category_id,
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

    $('body').on('click', '#btn-delete-category', function () {
        let category_id = $(this).data('id');
        let token   = $("meta[name='csrf-token']").attr("content");
        Swal.fire({
            title: 'Do you want to delete?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            cancelButtonText: 'NO',
            confirmButtonText: 'YES, DELETE!'        
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: `{{ url('/') }}/admin/category/${category_id}`,
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