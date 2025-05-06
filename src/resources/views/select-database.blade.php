@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12 col-lg-12 col-xl-5">
            <h4>Select Database</h4>

            <form action="{{ route('select-db.store') }}" method="POST">
                @csrf

                <div class="form-check">
                    <input class="form-check-input" type="radio" name="selected_db" id="clientDb" value="client">
                    <label class="form-check-label" for="clientDb">Client database</label>
                </div>

                <div class="form-check">
                    <input class="form-check-input" type="radio" name="selected_db" id="adminDb" value="admin">
                    <label class="form-check-label" for="adminDb">Admin database</label>
                </div>

                <button type="submit" class="btn btn-primary mt-3">Continue</button>
            </form>

        </div>
    </div>
    <div class="container mt-5">
    </div>
@endsection
