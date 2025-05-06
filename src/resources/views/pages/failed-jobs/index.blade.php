@extends('layouts.admin')

@section('page-title')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">⛔ Failed Jobs</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{route('home')}};">Home</a></li>
                        <li class="breadcrumb-item active">Failed jobs</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>

    <form id="search-form" action="{{ route('failed-jobs.index') }}" method="GET" class="row">
        <div class="col-sm-12 col-lg-6 mb-2">
            <input type="text" name="search" value="{{ request('search') }}" class="form-control" placeholder="Search..">
        </div>
        <div class="col-sm-12 col-lg-6 mb-2">
            <div class="btn-group w-100" role="group">
                <a href="{{ route('failed-jobs.retry-all') }}" class="btn-rounded btn btn-primary">
                    <i class="bx bx-rotate-left font-size-18"></i> Retry All
                </a>

                <button type="button" onclick="deleteConfirmation('delete-form-failed-job-all')" class="btn-rounded btn btn-danger">
                    <i class="fas fa-trash font-size-14"></i> Delete All
                </button>

                <button type="submit" form="search-form" class="btn-rounded btn btn-success">
                    <i class="fas fa-search font-size-14"></i> Search
                </button>
                <a href="{{route('failed-jobs.index')}}" class="btn-rounded btn btn-warning">
                    <i class="fas fa-sync font-size-14"></i> Clear
                </a>
            </div>
        </div>
    </form>

    {{-- Separate hidden delete form --}}
    <form id="delete-form-failed-job-all" action="{{ route('failed-jobs.destroy-all') }}" method="POST" style="display:none;">
        @csrf
        @method('DELETE')
    </form>

@endsection

@section('content')

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row mb-2">
                        <div class="col-sm-12 col-lg-6">
                            <h4 class="card-title">Failed columns : {{$jobs->count()}} </h4>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <div class="dataTables_wrapper dt-bootstrap4 no-footer">
                            <div class="col-sm-12">
                                <table class="table align-middle table-nowrap table-check w-100 dataTable no-footer dtr-inline collapsed">
                                    <thead class="table-light">
                                    <tr>
                                        <th>ID</th>
                                        <th>Connection</th>
                                        <th>Queue</th>
                                        <th>Error</th>
                                        <th>Failed At</th>
                                        <th>Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($jobs as $job)
                                        <tr>
                                            <td>{{ $job->id }}</td>
                                            <td>{{ $job->connection }}</td>
                                            <td>{{ $job->queue }}</td>
                                            <td title="{{ $job->exception }}"
                                                data-bs-toggle="modal"
                                                data-bs-target="#RowInfoFailed_{{ $job->id }}">{{ Str::limit($job->exception, 50) }}
                                            </td>
                                            <td>{{ $job->failed_at }}</td>
                                            <td>
                                                <form action="{{ route('failed-jobs.retry', $job->uuid) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    <button class="btn btn-primary btn-sm">Retry</button>
                                                </form>

                                                <form  id="delete-failed-job-{{ $job->id }}"
                                                       action="{{ route('failed-jobs.destroy', $job->id) }}"
                                                       method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')

                                                    <button type="button"  onclick="deleteConfirmation('delete-failed-job-{{ $job->id }}')" class="btn btn-danger btn-sm">Delete
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                        {{--Modal for exception--}}
                                        @include('pages.failed-jobs.row-info-modal')
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            {{--Pagination --}}
                            <ul class="pagination pagination-rounded justify-content-end mb-2">
                                                                {!! $jobs->links() !!}
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
@endsection
