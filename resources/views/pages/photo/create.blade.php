<div class="modal fade" id="modal-add">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Add Data Category</h4>
        </div>
        <div class="modal-body">
            <form method="POST" action="{{ route('photo.store') }}" id="addForm">
                @csrf
                <div class="form-group">
                    <label>Image</label>
                    <input type="file" name="image" class="form-control" placeholder="enter name" autocomplete="off">
                    <span class="text-danger error-text image_error"  style="font-size: 13px"></span>
                </div>          
                <div class="form-group">
                    <label>Caption</label>
                    <input type="text" name="caption" class="form-control" placeholder="enter caption" autocomplete="off">
                    <span class="text-danger error-text caption_error"  style="font-size: 13px"></span>
                </div>          

            </form>
        </div>
        <div class="modal-footer">
            <button type="button" onclick="addPhoto();" class="btn btn-primary pull-left">Save</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
