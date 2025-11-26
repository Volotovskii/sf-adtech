// resources/js/admin-users.js
document.addEventListener('DOMContentLoaded', function () {

    document.addEventListener('click', function(e) {
        const toggleButtonForm = e.target.closest('form[action*="/admin/toggle-user/"]');
        if (toggleButtonForm && e.target.type === 'submit') {
            e.preventDefault();

            const actionUrl = toggleButtonForm.getAttribute('action');
            const userId = actionUrl.split('/').pop();
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            const userRow = toggleButtonForm.closest('tr');
            if (!userRow) {
                console.error('User row not found.');
                alert('Error: User row not found.');
                return;
            }

            const statusCell = userRow.querySelector('td:nth-child(5)');
            const actionCell = userRow.querySelector('td:nth-child(6)');
            if (!statusCell || !actionCell) {
                console.error('Status or Action cell not found.');
                alert('Error: Could not find status or action cell.');
                return;
            }

            fetch(actionUrl, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => {
                 if (!response.ok) {
                    return response.json().then(json => {
                        throw new Error(json.message || 'Server Error: ' + response.status);
                    }).catch(() => {
                        return response.text().then(text => {
                            console.error("Non-JSON response:", text);
                            throw new Error('Server returned non-JSON response. Check console.');
                        });
                    });
                }
                return response.json();
            })
            .then(data => {
                if (data.success) {
                    // alert(data.message);

                    // --- Обновляем интерфейс ---
                    // Используем новое поле account_is_active
                    if (data.account_is_active) {
                        statusCell.innerHTML = '<span class="badge bg-success">Активен</span>';
                    } else {
                        statusCell.innerHTML = '<span class="badge bg-danger">Неактивен</span>';
                    }

                    const button = actionCell.querySelector('button[type="submit"]');
                    if (button) {
                        // Обновляем текст кнопки на основе нового поля
                        button.textContent = data.account_is_active ? 'Деактивировать' : 'Активировать';
                        button.className = data.account_is_active ? 'btn btn-sm btn-warning' : 'btn btn-sm btn-success';
                    }

                } else {
                    alert('Ошибка: ' + data.message);
                }
            })
            .catch(error => {
                console.error('Fetch Error:', error);
                alert('Произошла ошибка при выполнении запроса: ' + error.message);
            });
        }
    });
});