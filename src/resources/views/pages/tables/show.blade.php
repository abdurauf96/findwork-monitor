@extends('layouts.admin')

@section('page-title')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">{{$table}} table</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{route('tableIndex')}}">{{session()->get('selected_db')}} tables</a></li>
                        <li class="breadcrumb-item active">{{$table}} table</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>

    <form class="row">
        <div class="col-sm-12 col-lg-8 mb-2" >
            <input type="text" name="search" value="" class="form-control" placeholder="Search..">
        </div>
        <div class="col-sm-12 col-lg-4 mb-2" >
            <div class="btn-group w-100 " role="group" >
                <a href="" class="btn-rounded btn btn-primary">
                    <i class="fas fa-search font-size-14"></i> Search
                </a>
                <button type="submit" class="btn-rounded btn btn-warning">
                    <i class="fas fa-folder-plus font-size-18"></i> Insert
                </button>
                <button name="export" value="1" class="btn-rounded btn btn-success">
                    <i class="fas fa-redo font-size-14"></i> Clear filter
                </button>
            </div>
        </div>
    </form>
@endsection

@section('content')

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row mb-2">
                        <div class="col-sm-12 col-lg-6">
                            <h4 class="card-title">Data :  </h4>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead class="table-light">
                            <tr>
                                @foreach ($columns as $column)
                                    <th>{{ ucfirst(str_replace('_', ' ', $column)) }}</th>
                                @endforeach
                                    <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($rows as $row)
                                <tr>
                                    @foreach ($columns as $column)
                                        <td>
                                            <span class="text-truncate d-inline-block" data-bs-toggle="modal"
                                                  data-bs-target="#RowInfo_{{ $row->id }}_{{ $column }}">
                                                {{ \Illuminate\Support\Str::limit($row->$column, 50) }}
                                            </span>
                                            <!-- Modal show each row -->
                                            @include('pages.tables.row-info-modal', ['row' => $row, 'column' => $column])
                                        </td>
                                    @endforeach

                                    <td>
                                        <form id="delete-form-{{ $row->id }}" method="post" action="">
                                            @csrf

                                            <button type="button"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#RowEdit_{{ $row->id }}"
                                                    class="btn btn-outline-secondary btn-sm edit"
                                                    title="Edit">
                                                <i class="fas fa-pencil-alt"></i>
                                            </button>

                                            <input name="_method"
                                                   type="hidden"
                                                   value="DELETE">
                                            <button type="button"
                                                    onclick="deleteConfirmation('delete-form-{{ $row->id }}')"
                                                    class="btn btn-outline-danger btn-sm" title="Delete">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>

                                        </form>
                                    </td>
                                        <!-- Modal show each row -->
                                        @include('pages.tables.row-modal-edit', ['row' => $row, 'column' => $column])
                                </tr>
                            @endforeach

                            </tbody>
                        </table>
                    </div>
                    {{-- Pagination --}}
                        <ul class="pagination pagination-rounded justify-content-end mb-2">
                            {!! $rows->links() !!}
                        </ul>
                </div>
            </div>

@endsection
