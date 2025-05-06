@extends('layouts.admin')

@section('page-title')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">{{session()->get('selected_db')}} Tables</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{route('home')}};">Home</a></li>
                        <li class="breadcrumb-item active">{{session()->get('selected_db')}} tables</li>
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
                <button type="submit" class="btn-rounded btn btn-primary">
                    <i class="fas fa-search font-size-14"></i> Search
                </button>
                <a href="{{'tables'}}" class="btn-rounded btn btn-success">
                    <i class="bx bx-rotate-left font-size-18"></i> Clear filter
                </a>
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
                            <h4 class="card-title">Tables : {{$tables->count()}}</h4>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <div class="dataTables_wrapper dt-bootstrap4 no-footer">
                            <div class="col-sm-12">
                                <table class="table align-middle table-nowrap table-check w-100 dataTable no-footer dtr-inline collapsed">
                                    <thead class="table-light">
                                    <tr class="">
                                        <th>ID</th>
                                        <th>Detail</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($tables as $key=> $table)
                                        <tr>
                                            <td >
                                                <a href="{{route('tableShow',$table)}}">  {{ $table }}</a>
                                            </td>
                                            <td>
                                                <a href="{{route('tableShow',$table)}}" class="btn btn-info btn-sm btn-rounded" >
                                                    View Details
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <ul class="pagination pagination-rounded justify-content-end mb-2">
                                {{--                                {!! $classes->links() !!}--}}
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
@endsection
