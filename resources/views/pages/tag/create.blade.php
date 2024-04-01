<div class="modal fade" id="modal-add">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Add Data Tag</h4>
        </div>
        <div class="modal-body">
            <form method="POST" action="{{ route('tag.store') }}" id="addForm">
                @csrf
                <div class="form-group">
                    <label>Name</label>
                    <input type="text" name="name" class="form-control" placeholder="enter name" autocomplete="off">
                    <span class="text-danger error-text name_error"  style="font-size: 13px"></span>
                </div>          
            </form>
        </div>
        <div class="modal-footer">
            <button type="button" onclick="addTag();" class="btn btn-primary pull-left">Save</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">Cloes</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
