
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
                                <h3 class="card-title">{{$demand->title}}</h3>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-hover js-basic-example dataTable table_custom border-style spacing5">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Quantity</th>
                                                <th>Status</th>
                                                <th>Created at</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($items as $item)
                                            <tr>
                                                <td>{{$item->name}}</td>
                                                <td>{{$item->quantity}}</td>
                                                <td>{{$status[$item->status-1]}}</td>
                                                <td>{{date('d-m-Y', strtotime($item->created_at))}}</td>
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
