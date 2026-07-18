<span class="badge {{ match($status) {
    'active' => 'badge-active',
    'inactive' => 'badge-inactive',
    'draft' => 'badge-draft',
    'archived' => 'badge-archived',
    default => 'badge-inactive',
} }}">{{ ucfirst($status) }}</span>
