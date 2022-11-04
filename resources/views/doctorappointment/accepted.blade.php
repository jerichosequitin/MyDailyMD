<!-- Accepted Modal -->
<div class="modal fade" id="edit{{$app->id}}" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" style="background-color: #DEF1FD">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel">Accept Appointment</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="post" action="{{ route('doctorappointment.accepted', $app->id) }}">
                    @csrf
                    @method('PATCH')
                    <div class="container">
                        <center>
                            <div class="user-details">
                                <input type="text" name="status" value="Accepted" required readonly hidden>
                                <input type="text" name="patient_user_id" value="{{$app->patient_user_id}}" required readonly hidden>
                                <input type="text" name="patient_id" value="{{$app->patient_id}}" required readonly hidden>
                                <input type="text" name="doctor_user_id" value="{{$app->doctor_user_id}}" required readonly hidden>
                                <input type="text" name="doctor_id" value="{{$app->doctor_id}}" required readonly hidden>
                                <input type="text" name="linkStatus" value="Active" required readonly hidden>
                                <div class="input-box">
                                    <span class="details">Appointment Date</span>
                                    <input type="text" value="{{ date('F j, Y', strtotime($app->date)) }}" class="form-control" name="date" disabled>
                                </div>
                                <div class="input-box">
                                    <span class="details">Appointment Time</span>
                                    <input type="text" value="{{ date('h:i A', strtotime($app->start)) }} - {{ date('h:i A', strtotime($app->end)) }}" class="form-control" disabled>
                                </div>
                                <div class="input-box">
                                    <span class="details">Meeting Link</span>
                                    <textarea name="meetingLink" class="form-control" style="height: 100px" placeholder="https://meet.google.com/ or https://zoom.us/" required>{{ $app->meetingLink }}</textarea>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal"> Cancel</button>
                                <button class="btn btn-success">Accept</button>
                            </div>
                        </center>
                    </div>
                </form>
            </div>
            </div>
        </div>
    </div>
</div>
