<div class="modal fade" id="modal-edit">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Edit Data Permission</h4>
        </div>
        <div class="modal-body">
            <form method="POST" id="editForm">
                @csrf
                <input type="hidden" name="role_id" id="role_id">
                <div class="form-group">
                    <label>Nama</label>
                    <input type="text" name="name" id="name-edit" class="form-control" placeholder="masukan nama permission" autocomplete="off">
                    <span class="text-danger error-text name_error"  style="font-size: 13px"></span>
                </div>
                <div class="form-group">
                    @foreach ($permissions as $permission)
                        <label>
                          <input type="checkbox" class="minimal m-2" name="permissions[]" id="edit-permission-{{ $permission->id }}" value="{{ $permission->id }}">
                            {{ $permission->name }}
                        </label>
                    @endforeach
                </div>          
            </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-primary pull-left" onclick="updateRole()">Ubah data</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
        </div>
      </div>
    </div>
</div>