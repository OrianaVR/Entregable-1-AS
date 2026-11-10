/**
 * @author Nawal Oriana Valoyes Renteria
 */

document.addEventListener('DOMContentLoaded', function () {
    const tabs = document.querySelectorAll('.order-tab');
    const rows = document.querySelectorAll('[data-order-status]');
    const orderRows = document.querySelectorAll('.order-row');
    const emptyMessage = document.getElementById('noOrdersInStatus');

    tabs.forEach(function (tab) {
        tab.addEventListener('click', function () {
            const status = tab.dataset.status;
            let visibleCount = 0;

            tabs.forEach(function (other) {
                const isActive = other === tab;
                other.style.backgroundColor = isActive ? '#2b3a33' : '#ffffff';
                other.style.color = isActive ? '#ffffff' : '#2b3a33';
                other.style.borderColor = isActive ? '#2b3a33' : '#ced4da';
            });

            rows.forEach(function (row) {
                const isVisible = status === 'all' || row.dataset.orderStatus === status;
                row.classList.toggle('d-none', !isVisible);

                if (isVisible && row.classList.contains('order-row')) {
                    visibleCount++;
                }
            });

            emptyMessage.classList.toggle('d-none', orderRows.length === 0 || visibleCount > 0);
        });
    });
});