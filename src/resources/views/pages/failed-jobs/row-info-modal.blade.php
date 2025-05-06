<!-- Modal -->
<div id="RowInfoFailed_{{$job->id}}" class="modal fade" tabindex="-1" aria-labelledby="modalLabel_{{$job->id}}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" >ID :<span class="badge rounded-pill bg-success float-end" key="t-new"> #{{$job->id}}</span></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p class="text-danger">  {{$job->exception}}</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary waves-effect" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
