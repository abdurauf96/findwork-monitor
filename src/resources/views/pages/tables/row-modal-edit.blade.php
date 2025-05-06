<!-- Edit modal -->
<div id="RowEdit_{{ $row->id }}" class="modal fade" tabindex="-1" aria-labelledby="editModalLabel_{{ $row->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <form action="" method="POST">
                @csrf
                @method('PUT') <!-- PUT method for update -->
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel_{{ $row->id }}">Edit row</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Yopish"></button>
                </div>
                <div class="modal-body">
                    @foreach ($columns as $column)
                        @php
                            $value = old($column, $row->$column);
                        @endphp

                        <div class="mb-3">
                            <label for="{{ $column }}_{{ $row->id }}" class="form-label">{{ ucfirst($column) }}</label>

                            @if(Str::length($value) > 60)
                                <textarea class="form-control"
                                          id="{{ $column }}_{{ $row->id }}"
                                          name="{{ $column }}"
                                          rows="4">{{ $value }}</textarea>
                            @else
                                <input type="text"
                                       class="form-control"
                                       id="{{ $column }}_{{ $row->id }}"
                                       name="{{ $column }}"
                                       value="{{ $value }}">
                            @endif
                        </div>
                    @endforeach
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Save</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
