<!-- Button trigger modal -->
<button type="button" class="btn btn-outline-danger btn-sm " data-bs-toggle="modal"
    data-bs-target="#delete_client{{ $client->id }}">
    <i class="bi bi-trash"></i>
</button>

<!-- Modal -->
<div class="modal fade" id="delete_client{{ $client->id }}" data-bs-backdrop="static" data-bs-keyboard="false"
    tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">{{ $client->name }}</h5>
                <button type="button" class="btn-close btn-dark btn-sm" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>

            <form action="{{ route('admin.client.delete', $client) }}" method="post">
                @csrf
                @method('DELETE')

                <div class="modal-body">
                    <img class="img-thumbnail" height="200px" width="200px" src="{{ $client->PictureClient}}">
                    <p class="card-text text-danger text-center font-weight-bold" >
                        {{"There Are You Delete ? "}}
                    </p>

                    <div class="modal-footer">

                        <button type="button" class="btn btn-outline-dark btn-sm"
                            data-bs-dismiss="modal">{{ 'Close' }}</button>
                        <button type="submit" class="btn btn-outline-danger btn-sm">{{ 'Delete' }}</button>

                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
