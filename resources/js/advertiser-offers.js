
document.addEventListener('DOMContentLoaded', function () {
    // Найти все draggable элементы
    const items = document.querySelectorAll('.offer-item');
    // Найти все колонки
    const columns = document.querySelectorAll('.column');

    //  обработчики dragstart
    items.forEach(item => {
        item.addEventListener('dragstart', function (e) {
            e.dataTransfer.setData("text", this.dataset.id);
        });
    });

    // обработчики dragover и drop
    columns.forEach(col => {
        col.addEventListener('dragover', function (e) {
            e.preventDefault(); // важно для drop
        });

        col.addEventListener('drop', function (e) {
            e.preventDefault();
            const offerId = e.dataTransfer.getData("text");
            const newStatus = this.dataset.status;

            // Отправляем запрос
            fetch(`/advertiser/offers/${offerId}/status`, {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                     'X-Requested-With': 'XMLHttpRequest'
                },
                body: JSON.stringify({ status: newStatus })
            })
            .then(response => response.json())
            .then(data => {
                //alert(data.message);

                const item = document.querySelector(`[data-id="${offerId}"]`);
                this.appendChild(item);

                // Обновим классы
                item.classList.remove('draft', 'active', 'inactive');
                item.classList.add(newStatus);
            })
            .catch(error => {
                console.error('Error:', error);
            });
        });
    });
});