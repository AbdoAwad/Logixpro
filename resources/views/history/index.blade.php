
@extends('layouts.app', ['header_title' => 'History'])
@include('plugins.dropify')
@include('plugins.datatable')

@push('css')
@endpush

@section('content')

<div id="table-requests">
    <div class="container-fluid mb-3">
        <div class="section-body mt-3">
            <div class="container-fluid">
                <div class="row clearfix">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">My Requests</h3>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-hover js-basic-example dataTable table_custom border-style spacing5">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Status</th>
                                                <th>Created at</th>
                                                <th> Action </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($demands as $demand)
                                            <tr>
                                                <td>{{$demand->title}}</td>
                                                <td>Finished</td>
                                                <td>{{date('d-m-Y', strtotime($demand->created_at))}}</td>
                                                <td class="actions">
                                                    <a class="btn btn-sm btn-icon on-default m-r-5 button-edit" href="{{route('history.items', $demand->id)}}"><i class="feather  fa fa-eye"></i></a>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>                
                </div>
            </div>
        </div>
    </div>
</div>

<div id="table-requests">
    <div class="container-fluid mb-3">
        <div class="section-body mt-3">
            <div class="container-fluid">
                <div class="row clearfix">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Requests Passed To This Level</h3>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-hover js-basic-example dataTable table_custom border-style spacing5">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                
                                                <th>Status</th>
                                                <th>Created by</th>

                                                <th>Created at</th>
                                                <th> Action </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($passedDemands as $demand)
                                            <tr>
                                                <td>{{$demand->title}}</td>
                                                <td>Finished</td>
                                                <td>Level {{$demand->user_id}}</td>
                                                <td>{{date('d-m-Y', strtotime($demand->created_at))}}</td>
                                                <td class="actions">
                                                    <a class="btn btn-sm btn-icon on-default m-r-5 button-edit" href="{{route('history.items', $demand->id)}}"><i class="feather  fa fa-eye"></i></a>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>                
                </div>
            </div>
        </div>
    </div>
</div> 





@endsection

@push('js')
<script>
</script>
    
@endpush
