<div id="delete-modal{{ $activity->id }}" class="modal fade" tabindex="-1" aria-labelledby="standard-modalLabel"
    style="display: none;" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-light">
                <h4 class="modal-title text-danger" id="myCenterModalLabel">
                    Delete Activity
                </h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
            <div class="modal-body p-4">
                <form method="POST" action="{{ route('activity.destroy', ['id' => $activity->id]) }}">
                    @method('delete')
                    @csrf

                    <p>
                        Are you sure want to delete action <br>
                        {{ $activity->description }}
                    </p>

                    <div class="text-end">
                        <button type="submit" class="btn btn-danger waves-effect waves-light">Delete activity</button>
                        <button type="button" class="btn btn-secondary waves-effect waves-light"
                            data-bs-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
