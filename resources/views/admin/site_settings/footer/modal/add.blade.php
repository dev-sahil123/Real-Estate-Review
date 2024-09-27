<form action="{{ url('admin/site_setting/footer/store') }}" method="post">
    <input type="hidden" name="id" value="{{ $footer_menu->id }}">
    @csrf
    <div class="modal-header">
        <h3>{{ $footer_menu->id ? 'Edit' : 'Add' }} Menu</h3>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="modal-body">
        <div class="mb-3">
            <label>Category Name</label>
            <input type="text" name="category_name" value="{{ $footer_menu->category_name }}" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Name</label>
            <input type="text" name="name" value="{{ $footer_menu->name }}" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Link</label>
            <input type="url" name="link" value="{{ $footer_menu->link }}" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Status</label>
            <select name="status" class="form-control" required>
                <option value="">--Select Status--</option>
                <option value="1">Active</option>
                <option value="0">In-Active</option>
            </select>
        </div>
    </div>
    <div class="modal-footer">
        <button class="btn btn-primary" type="submit">Save</button>
    </div>
</form>

<script>
    $('select[name=under]').val('{{ $footer_menu->under }}');
    $('select[name=status]').val('{{ $footer_menu->status }}');
</script>