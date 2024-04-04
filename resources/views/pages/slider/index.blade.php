@extends('layouts.dashboard')
@section('content')
<section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Data Slider</h3>
                <div class="row">
                    <br>
                    <form action="{{ route('slider.index') }}" method="GET">
                    <div class="col-md-9">
                        @can('sliders.create')
                            <a href="javascript:void(0)" class="btn btn-primary mb-2" data-toggle="modal" data-target="#modal-add" id="btn-create-post">Add Slider</a>                            
                        @endcan
                    </div>
                    <div class="col-md-3">
                    </div>
                    </form>
                </div>
            </div>
            <div class="box-body">
                <table id="" class="table table-bordered table-hover">
                  <thead>
                    <tr>
                        <th>#</th>
                        <th>Image</th>
                        <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($sliders as $i => $slider)
                    <tr>
                        <td width="5%">{{ $i + $sliders->firstItem() }}</td>
                        <td>
                            <img src="{{ $slider->image }}" class="img-fluid" width="100px">
                        </td>
                        <td>
                            @can('sliders.delete')
                                <a href="javascript:void(0)" id="btn-delete-slider" data-id="{{ $slider->id }}" class="btn btn-danger btn-sm"><i class="fa fa-fw fa-trash"></i></a>                                
                            @endcan
                        </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
                <div class="d-flex justify-content-center">
                    {!! $sliders->links() !!}
                </div>
            </div>
        </div>
      </div>
    </div>
</section> 

@include('pages.slider.create')


@push('after-script')
<script>
    function addSlider(){
        var form = new FormData($('#addForm')[0]);
        $('.error-text').text('');
        $.ajax({
            url: "{{ route('slider.store') }}",
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

    $('body').on('click', '#btn-delete-slider', function () {
        let slider_id = $(this).data('id');
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
                    url: `{{ url('/') }}/admin/slider/${slider_id}`,
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