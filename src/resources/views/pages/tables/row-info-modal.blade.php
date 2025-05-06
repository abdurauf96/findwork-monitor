<!-- Modal -->
<div id="RowInfo_{{ $row->id }}_{{ $column }}" class="modal fade" tabindex="-1" aria-labelledby="modalLabel_{{ $row->id }}_{{ $column }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" >ID :<span class="badge rounded-pill bg-success float-end" key="t-new"> #{{ $row->id }}</span></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h5>Column: {{$column}}</h5>
                 <p class="text-danger">  {{ $row->$column }}</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary waves-effect" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
