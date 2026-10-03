@php
    $params = request()->query();
@endphp
<div class="d-flex flex-wrap gap-2 no-print">
    <button type="button" class="btn btn-dark btn-sm" onclick="window.print()">
        <i class="bi bi-printer"></i> Print
    </button>
    <a href="{{ route($exportRouteName, array_merge($params, ['format' => 'xlsx'])) }}" class="btn btn-success btn-sm">
        <i class="bi bi-file-earmark-excel"></i> Excel
    </a>
    <a href="{{ route($exportRouteName, array_merge($params, ['format' => 'pdf'])) }}" class="btn btn-danger btn-sm">
        <i class="bi bi-file-earmark-pdf"></i> PDF
    </a>
    <a href="{{ route($exportRouteName, array_merge($params, ['format' => 'csv'])) }}" class="btn btn-outline-secondary btn-sm">
        <i class="bi bi-filetype-csv"></i> CSV
    </a>
</div>
