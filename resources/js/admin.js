import './bootstrap';

document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('.alert-dismissible').forEach((alert) => {
        setTimeout(() => {
            bootstrap.Alert.getOrCreateInstance(alert)?.close();
        }, 5000);
    });

    initTableSort();
});

function initTableSort() {
    document.querySelectorAll('table[data-sortable]').forEach((table) => {
        const thead = table.querySelector('thead');
        const tbody = table.querySelector('tbody');
        if (!thead || !tbody) return;

        const headers = [...thead.querySelectorAll('th')];

        headers.forEach((th, columnIndex) => {
            const type = th.dataset.sort;
            if (!type) return;

            const icon = document.createElement('i');
            icon.className = 'bi bi-arrow-down-up sort-icon';
            th.appendChild(icon);

            th.addEventListener('click', () => {
                const isAscending = th.classList.contains('sort-asc');
                const nextDirection = isAscending ? 'desc' : 'asc';

                headers.forEach((header) => header.classList.remove('sort-asc', 'sort-desc'));
                th.classList.add(nextDirection === 'asc' ? 'sort-asc' : 'sort-desc');

                const rows = [...tbody.querySelectorAll('tr')].filter((row) => row.children.length === headers.length);

                rows.sort((rowA, rowB) => {
                    const textA = rowA.children[columnIndex]?.textContent.trim() ?? '';
                    const textB = rowB.children[columnIndex]?.textContent.trim() ?? '';

                    let comparison;
                    if (type === 'number') {
                        const numA = parseFloat(textA.replace(/[^0-9.-]/g, '')) || 0;
                        const numB = parseFloat(textB.replace(/[^0-9.-]/g, '')) || 0;
                        comparison = numA - numB;
                    } else {
                        comparison = textA.localeCompare(textB);
                    }

                    return nextDirection === 'asc' ? comparison : -comparison;
                });

                rows.forEach((row) => tbody.appendChild(row));
            });
        });
    });
}
