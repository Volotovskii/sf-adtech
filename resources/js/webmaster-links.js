
document.addEventListener('DOMContentLoaded', function () {

    // Делегируем событий для форм
    document.addEventListener('submit', function (e) {
        // Отписаться
        if (e.target.classList.contains('unsubscribe-form-links')) {
            e.preventDefault();

            const offerId = e.target.action.split('/').pop();
            const row = e.target.closest('tr');

            if (!row) {
                alert('Ошибка: строка таблицы не найдена.');
                return;
            }

            // Получаем текущую наценку из input
            const currentRowInputs = row.querySelectorAll('input[name="markup"]');
            // Используем data-атрибут или 0
            const previousMarkup = parseFloat(row.dataset.previousMarkup) || 0;

            fetch(e.target.action, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({ _method: 'DELETE' })
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // alert(data.message);

                        const statusCell = row.querySelector('td:nth-child(3)');
                        const linkCell = row.querySelector('td:nth-child(4)');
                        const actionCell = row.querySelector('td:nth-child(5)');

                        // NEw статус
                        statusCell.innerHTML = '<span class="badge bg-warning">Отписался</span>';
                        // new ссылку
                        linkCell.innerHTML = '<input type="text" class="form-control" value="Ссылка недоступна" readonly disabled>';
                        // Отписаться -> Возобновить
                        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                        const subscribeActionUrl = e.target.action.replace('/unsubscribe/', '/subscribe/');

                        actionCell.innerHTML = `
                        <form method="POST" action="${subscribeActionUrl}" class="d-inline subscribe-form-links">
                            <input type="hidden" name="_token" value="${csrfToken}">
                            <input type="number" name="markup" value="${previousMarkup}" step="0.01" min="0">
                            <button type="submit" class="btn btn-success btn-sm">Возобновить</button>
                        </form>
                    `;
             
                        row.className = row.className.replace(/\btable-(success|warning|danger|secondary)\b/g, '');
                        row.classList.add('table-warning');
                    } else {
                        alert('Ошибка: ' + data.message);
                    }
                })
                .catch(error => {
                    console.error('Fetch Error:', error);
                    alert('Произошла ошибка при выполнении запроса.');
                });
        }

        else if (e.target.classList.contains('subscribe-form-links')) {
            e.preventDefault();

            const offerId = e.target.action.split('/').pop();
            const row = e.target.closest('tr');

            if (!row) {
                alert('Ошибка: строка таблицы не найдена.');
                return;
            }

            const formData = new FormData(e.target);
            const markup = parseFloat(formData.get('markup'));

            if (isNaN(markup) || markup < 0) {
                alert('Введите корректную наценку.');
                return;
            }

            // Проверка на 0% наценку
            if (markup === 0) {
                if (!confirm('Вы указали наценку 0%. Уверены, что хотите продолжить?')) {
                    return;
                }
            }

            fetch(e.target.action, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({ markup: markup })
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
   
                        const statusCell = row.querySelector('td:nth-child(3)');
                        const linkCell = row.querySelector('td:nth-child(4)');
                        const actionCell = row.querySelector('td:nth-child(5)');

                        // Обновляем статус
                        statusCell.innerHTML = '<span class="badge bg-success">Активна</span>';

                        const webmasterId = row.dataset.webmasterId; // ID из data-атрибута
                        if (!webmasterId) {
                            console.error('Webmaster ID не найден в data-атрибуте строки.');
                            alert('Ошибка: не удалось получить ID вебмастера.');
                            return; 
                        }
                        const linkUrl = `${window.location.origin}/go/${offerId}?webmaster_id=${webmasterId}`; // <-- НОВОЕ, ПРАВИЛЬНОЕ
                        linkCell.innerHTML = `<input type="text" class="form-control" value="${linkUrl}" readonly>`;
                        
                        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                        const unsubscribeActionUrl = e.target.action.replace('/subscribe/', '/unsubscribe/'); // Меняем URL

                        actionCell.innerHTML = `
                        <form method="POST" action="${unsubscribeActionUrl}" class="d-inline unsubscribe-form-links">
                            <input type="hidden" name="_token" value="${csrfToken}">
                            <input type="hidden" name="_method" value="DELETE">
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Отписаться?')">Отписаться</button>
                        </form>
                    `;
                        
                        row.className = row.className.replace(/\btable-(success|warning|danger|secondary)\b/g, '');
                        row.classList.add('table-success');
                    } else {
                        alert('Ошибка: ' + data.message);
                    }
                })
                .catch(error => {
                    console.error('Fetch Error:', error);
                    alert('Произошла ошибка при выполнении запроса.');
                });
        }
    });
});