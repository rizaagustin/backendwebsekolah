@extends('layouts.dashboard')
@section('content')
<section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Data Event</h3>
                <div class="row">
                    <br>
                    <form action="{{ route('event.index') }}" method="GET">
                    <div class="col-md-9">
                        <a href="{{ route('event.create') }}" class="btn btn-primary mb-2" >Add Event</a>
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
                        <th>title</th>
                        <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($events as $i => $event)
                    <tr>
                        <td>{{ $i + $events->firstItem() }}</td>
                        <td>{{ $event->title }}</td>
                        <td>
                            <a href="{{ route('event.edit', $event->id) }}" class="btn btn-success btn-sm"><i class="fa fa-fw fa-pencil"></i></a>
                            <a href="javascript:void(0)" id="btn-delete-event" data-id="{{ $event->id }}" class="btn btn-danger btn-sm"><i class="fa fa-fw fa-trash"></i></a>
                        </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
                <div class="d-flex justify-content-center">
                    {!! $events->links() !!}
                </div>
            </div>
        </div>
      </div>
    </div>
</section> 

@push('after-script')
<script>
    $('body').on('click', '#btn-delete-event', function () {
        let event_id = $(this).data('id');
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
                    url: `{{ url('/') }}/admin/event/${event_id}`,
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