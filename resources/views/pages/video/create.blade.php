<div class="modal fade" id="modal-add">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Add Data Video</h4>
        </div>
        <div class="modal-body">
            <form method="POST" action="{{ route('video.store') }}" id="addForm">
                @csrf
                <div class="form-group">
                    <label>Title</label>
                    <input type="text" name="title" class="form-control" placeholder="enter title" autocomplete="off">
                    <span class="text-danger error-text title_error"  style="font-size: 13px"></span>
                </div>          
                <div class="form-group">
                    <label>Embed</label>
                    <input type="text" name="embed" class="form-control" placeholder="enter embed" autocomplete="off">
                    <span class="text-danger error-text embed_error"  style="font-size: 13px"></span>
                </div>          
            </form>
        </div>
        <div class="modal-footer">
            <button type="button" onclick="addVideo();" class="btn btn-primary pull-left">Save</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
