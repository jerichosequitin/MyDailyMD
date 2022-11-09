<!-- Accepted Modal -->
<div class="modal fade" id="edit{{$medicalHistory->id}}" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" style="background-color: #DEF1FD">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel">Are you sure you want to delete this record?</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('patientmedicalhistory.archive', $medicalHistory->id)}}" method="post" style="display: inline-block">
                    @csrf
                    @method('PATCH')
                        <center>
                            <div class="user-details">
                                <input type="text" name="status" value="Archived" required readonly hidden>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"> Cancel</button>
                                <button class="btn btn-danger">Yes</button>
                            </div>
                        </center>
                </form>
            </div>
            </div>
        </div>
    </div>
</div>
