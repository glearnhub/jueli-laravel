<div class="col-auto">
    <label class="form-label small mb-1">Status</label>
    <select class="form-select form-select-sm" name="status">
        <option value="">All Statuses</option>
        <option value="active" @selected(request('status') === 'active')>Active</option>
        <option value="inactive" @selected(request('status') === 'inactive')>Inactive</option>
        <option value="draft" @selected(request('status') === 'draft')>Draft</option>
        <option value="archived" @selected(request('status') === 'archived')>Archived</option>
    </select>
</div>
<div class="col-auto">
    <label class="form-label small mb-1">From</label>
    <input type="date" class="form-control form-control-sm" name="date_from" value="{{ request('date_from') }}">
</div>
<div class="col-auto">
    <label class="form-label small mb-1">To</label>
    <input type="date" class="form-control form-control-sm" name="date_to" value="{{ request('date_to') }}">
</div>
