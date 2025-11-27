// TODO переписать под делегирвоание много кода без него
// роутеры 
document.addEventListener('DOMContentLoaded', function () {

    // Делегируем событие  TODO уменьшит ---
    document.addEventListener('submit', function (e) {
        // Подписаться
        if (e.target.classList.contains('subscribe-form')) {
            e.preventDefault();

            const markupInput = e.target.querySelector('input[name="markup"]');
            const markup = markupInput.value;
            const offerId = e.target.action.split('/').pop();
            const item = document.querySelector(`[data-id="${offerId}"]`);

            if (!item) {
                alert('Оффер не найден.');
                return;
            }

            if (markup === '' || markup < 0) {
                alert('Введите корректную наценку.');
                return;
            }

            if (parseFloat(markup) === 0) {
                if (!confirm('Вы указали наценку 0%. Уверены, что хотите продолжить?')) {
                    return;
                }
            }

            const numMarkup = parseFloat(markup);

            fetch(`/webmaster/subscribe/${offerId}`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: JSON.stringify({ markup: numMarkup })
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        const subscribedColumn = document.querySelector('[data-column="subscribed"]');
                        if (subscribedColumn) {
                            subscribedColumn.appendChild(item);
                            item.classList.remove('offer-active');
                            item.classList.add('offer-subscribed');

                            // контейнеры наценки
                            const markupDisplaySpan = item.querySelector(`#markup-display-${offerId}`);
                            const markupValueSpan = item.querySelector(`#markup-display-${offerId} .markup-value`);

                            if (markupDisplaySpan && markupValueSpan) {
                                // значение наценки
                                markupValueSpan.textContent = markup;
                                // Показываем наценку
                                markupDisplaySpan.style.display = '';
                            }
                           
                           // меняем кнопки при переносе
                            const actionsDiv = item.querySelector('.offer-actions');
                            actionsDiv.innerHTML = `
                            <form method="POST" action="/webmaster/unsubscribe/${offerId}" class="d-inline unsubscribe-form" data-offer-id="${offerId}">
                                <input type="hidden" name="_token" value="${document.querySelector('meta[name="csrf-token"]').getAttribute('content')}">
                                <input type="hidden" name="_method" value="DELETE">
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Отписаться?')">Отписаться</button>
                            </form>
                            <form method="POST" action="/webmaster/update-markup/${offerId}" class="d-inline update-markup-form" data-offer-id="${offerId}">
                                <input type="hidden" name="_token" value="${document.querySelector('meta[name="csrf-token"]').getAttribute('content')}">
                                <input type="hidden" name="_method" value="PUT">
                                <input type="number" name="markup" value="${markup}" step="0.01" min="0" class="form-control-sm d-inline-block w-auto">
                                <button type="submit" class="btn btn-warning btn-sm">Изменить</button>
                            </form>
                        `;
                        }
                    } else {
                        alert('Ошибка: ' + data.message);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        }
        // Отписаться
        else if (e.target.classList.contains('unsubscribe-form')) {
            e.preventDefault();

            const offerId = e.target.dataset.offerId;
            const item = document.querySelector(`[data-id="${offerId}"]`);

            if (!item) {
                alert('Оффер не найден.');
                return;
            }

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
                        const activeColumn = document.querySelector('[data-column="active"]');
                        if (activeColumn) {
                            activeColumn.appendChild(item);
                            item.classList.remove('offer-subscribed');
                            item.classList.add('offer-active');

                            // Очищаем/скрываем наценку
                            const markupDisplaySpan = item.querySelector(`#markup-display-${offerId}`);
                            const markupValueSpan = item.querySelector(`#markup-display-${offerId} .markup-value`);

                            if (markupDisplaySpan && markupValueSpan) {
                                // чистим наценку опять
                                markupValueSpan.textContent = '';
                                markupDisplaySpan.style.display = 'none';
                            }

                            const actionsDiv = item.querySelector('.offer-actions');
                            actionsDiv.innerHTML = `
                    <form method="POST" action="/webmaster/subscribe/${offerId}" class="d-inline subscribe-form" data-offer-id="${offerId}">
        <input type="hidden" name="_token" value="${document.querySelector('meta[name="csrf-token"]').getAttribute('content')}">
        <input type="number" name="markup" placeholder="Наценка" step="0.01" min="0" required class="form-control-sm d-inline-block w-auto">
        <button type="submit" class="btn btn-primary btn-sm">Подписаться</button>
    </form>
`;
                            // сбрасываем  markup после вставки TODO по другому не получилось избавиться при переносе
                            setTimeout(() => {
                                const newMarkupInput = actionsDiv.querySelector('input[name="markup"]');
                                if (newMarkupInput) {
                                    newMarkupInput.value = '';
                                    newMarkupInput.removeAttribute('value');
                                }
                            }, 0);

                        }
                    } else {
                        alert('Ошибка: ' + data.message);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        } // Изменить
        else if (e.target.classList.contains('update-markup-form')) {
            console.log("Обработчик update-markup-form сработал!");
            e.preventDefault();

            const formData = new FormData(e.target);
            const offerId = e.target.dataset.offerId;
            const item = document.querySelector(`[data-id="${offerId}"]`);

            if (!item) {
                alert('Оффер не найден.');
                return;
            }

            const newMarkupString = formData.get('markup');
            const newMarkup = parseFloat(newMarkupString);

            if (isNaN(newMarkup) || newMarkup < 0) {
                alert('Введите корректную наценку.');
                return;
            }

            if (newMarkup === 0) {
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
                body: JSON.stringify({ markup: newMarkup, _method: 'PUT' })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    const markupValueSpan = item.querySelector(`#markup-display-${offerId} .markup-value`);
                    if (markupValueSpan) {
                        markupValueSpan.textContent = newMarkup;
                    }

                    const input = item.querySelector('input[name="markup"]');
                    if (input) {
                        input.value = newMarkup;
                    }
                } else {
                    alert('Ошибка: ' + data.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
        }
    });

    // --- Drag-and-Drop ---
    const offerItems = document.querySelectorAll('.offer-item');
    const columns = document.querySelectorAll('.column');

    offerItems.forEach(item => {
        item.addEventListener('dragstart', function (e) {
            e.dataTransfer.setData("text", this.dataset.id);
        });
    });

    columns.forEach(col => {
        col.addEventListener('dragover', function (e) {
            e.preventDefault();
        });

        col.addEventListener('drop', function (e) {
            e.preventDefault();
            const offerId = e.dataTransfer.getData("text");
            const targetColumn = e.target.closest('.column').dataset.column;
            const item = document.querySelector(`[data-id="${offerId}"]`);

            if (targetColumn === 'subscribed') {
                const markup = prompt('Введите наценку:', '0');
                if (markup === null) return;

                const numMarkup = parseFloat(markup);
                if (isNaN(numMarkup) || numMarkup < 0) {
                    alert('Некорректная наценка.');
                    return;
                }

                if (numMarkup === 0) {
                    if (!confirm('Вы указали наценку 0. Уверены, что хотите продолжить?')) {
                        return;
                    }
                }

                fetch(`/webmaster/subscribe/${offerId}`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    body: JSON.stringify({ markup: numMarkup })
                })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            this.appendChild(item);
                            item.classList.remove('offer-active');
                            item.classList.add('offer-subscribed');

                            // наценка
                            const markupDisplaySpan = item.querySelector(`#markup-display-${offerId}`);
                            const markupValueSpan = item.querySelector(`#markup-display-${offerId} .markup-value`);

                            if (markupDisplaySpan && markupValueSpan) {
                                markupValueSpan.textContent = numMarkup;
                                markupDisplaySpan.style.display = '';
                            }
                            
                            const actionsDiv = item.querySelector('.offer-actions');
                            actionsDiv.innerHTML = `
                            <form method="POST" action="/webmaster/unsubscribe/${offerId}" class="d-inline unsubscribe-form" data-offer-id="${offerId}">
                                <input type="hidden" name="_token" value="${document.querySelector('meta[name="csrf-token"]').getAttribute('content')}">
                                <input type="hidden" name="_method" value="DELETE">
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Отписаться?')">Отписаться</button>
                            </form>
                            <form method="POST" action="/webmaster/update-markup/${offerId}" class="d-inline update-markup-form" data-offer-id="${offerId}">
                                <input type="hidden" name="_token" value="${document.querySelector('meta[name="csrf-token"]').getAttribute('content')}">
                                <input type="hidden" name="_method" value="PUT">
                                <input type="number" name="markup" value="${numMarkup}" step="0.01" min="0" class="form-control-sm d-inline-block w-auto">
                                <button type="submit" class="btn btn-warning btn-sm">Изменить</button>
                            </form>
                        `;
                        } else {
                            alert('Ошибка: ' + data.message);
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                    });
            } else if (targetColumn === 'active') {
                if (!confirm('Отписаться от этого оффера?')) {
                    return;
                }

                fetch(`/webmaster/unsubscribe/${offerId}`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    body: JSON.stringify({ _method: 'DELETE' })
                })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            this.appendChild(item);
                            item.classList.remove('offer-subscribed');
                            item.classList.add('offer-active');
                          
                            const markupDisplaySpan = item.querySelector(`#markup-display-${offerId}`);
                            const markupValueSpan = item.querySelector(`#markup-display-${offerId} .markup-value`);

                            if (markupDisplaySpan && markupValueSpan) {
                                markupValueSpan.textContent = '';
                                markupDisplaySpan.style.display = 'none';
                            }

                            const actionsDiv = item.querySelector('.offer-actions');
                            actionsDiv.innerHTML = `
                            <form method="POST" action="/webmaster/subscribe/${offerId}" class="d-inline subscribe-form" data-offer-id="${offerId}">
                                <input type="hidden" name="_token" value="${document.querySelector('meta[name="csrf-token"]').getAttribute('content')}">
                                <input type="number" name="markup" placeholder="Наценка" step="0.01" min="0" required class="form-control-sm d-inline-block w-auto">
                                <button type="submit" class="btn btn-primary btn-sm">Подписаться</button>
                            </form>
                        `;

                            setTimeout(() => {
                                const newMarkupInput = actionsDiv.querySelector('input[name="markup"]');
                                if (newMarkupInput) {
                                    newMarkupInput.value = '';
                                    newMarkupInput.removeAttribute('value');
                                }
                            }, 0);

                        } else {
                            alert('Ошибка: ' + data.message);
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                    });
            }
        });
    });
});