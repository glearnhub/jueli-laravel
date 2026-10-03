<div class="col-auto">
    <label class="form-label small mb-1">Status</label>
    <select class="form-select form-select-sm" name="status" aria-label="Filter by status">
        <option value="">All Statuses</option>
        <option value="active" @selected(request('status') === 'active')>Active</option>
        <option value="inactive" @selected(request('status') === 'inactive')>Inactive</option>
        <option value="draft" @selected(request('status') === 'draft')>Draft</option>
        <option value="archived" @selected(request('status') === 'archived')>Archived</option>
    </select>
</div>
<div class="col-auto">
    <label class="form-label small mb-1">From</label>
    <input type="date" class="form-control form-control-sm" name="date_from" aria-label="From date" value="{{ request('date_from') }}">
</div>
<div class="col-auto">
    <label class="form-label small mb-1">To</label>
    <input type="date" class="form-control form-control-sm" name="date_to" aria-label="To date" value="{{ request('date_to') }}">
</div>
