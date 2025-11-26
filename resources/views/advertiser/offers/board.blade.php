<div class="board">
    <div class="column" data-status="draft" ondrop="drop(event)" ondragover="allowDrop(event)">
        <h3>Черновик</h3>
        @foreach($offers->where('status', 'draft') as $offer)
            <div class="offer-item" draggable="true" ondragstart="drag(event)" data-id="{{ $offer->id }}">
                {{ $offer->name }}
            </div>
        @endforeach
    </div>
    <div class="column" data-status="active" ondrop="drop(event)" ondragover="allowDrop(event)">
        <h3>Активен</h3>
    </div>
    <div class="column" data-status="inactive" ondrop="drop(event)" ondragover="allowDrop(event)">
        <h3>Неактивен</h3>
    </div>
</div>

<script>
function allowDrop(ev) {
    ev.preventDefault();
}

function drag(ev) {
    ev.dataTransfer.setData("text", ev.target.dataset.id);
}

function drop(ev) {
    ev.preventDefault();
    const offerId = ev.dataTransfer.getData("text");
    const newStatus = ev.target.closest('.column').dataset.status;

    fetch(`/offers/${offerId}/status`, {
        method: 'PUT',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({ status: newStatus })
    })
    .then(response => response.json())
    .then(data => {
        ev.target.appendChild(document.querySelector(`[data-id="${offerId}"]`));
        alert(data.message);
    })
    .catch(error => {
        console.error('Error:', error);
    });
}
</script>