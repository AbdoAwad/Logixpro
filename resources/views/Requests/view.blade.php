@extends('layouts.app', ['header_title' => 'Project'])
@include('plugins.dropify')

@push('css')
@endpush

@section('content')
<div class="container-fluid">
<div class="card ">
    <div class="card-header">
        <h3 class="card-title">Edit Request</h3>
    </div>
    <div class="card-body">
        {{-- <form id="form-update" method="POST" action="{{ route('projects.items', $project->id) }}"> --}}
            @method('PATCH')
        <div class="row clearfix p-2">
            <div class="col-sm-12">
                <div class="form-group">
                    <ul id="package_info"></ul>
                </div>
                <div class="form-group ">
                    <label class="form-label">Name</label>
                    <input name="name" autocomplete="off" required type="text" class="form-control circle"  value="{{ $project->name }}">
                </div>
                <div class="form-group ">
                    <label class="form-label">Owenr</label>
                    <input name="owner" autocomplete="off" required type="text" class="form-control circle"  value="{{ $project->owner }}">
                </div>
                <div class="form-group ">
                    <label class="form-label">Consultantor</label>
                    <input name="consultantor" autocomplete="off" required type="text" class="form-control circle"  value="{{ $project->consultantor }}">
                </div>
            </div>
        </div>
    <div class="modal-footer">
        <a href="{{ route('project') }}" class="btn btn-default">Back</a>
        <button type="submit" data-submit="form-update" class="btn btn-primary pull-right" id="submit"><i class="fa fa-check mr-1"></i> Update</button>
    </div>
    </form>
    </div>
</div>
</div>



@endsection

@push('js')
<script type="text/javascript">
    $("#form-update").on('submit', function(e) {
    e.preventDefault();
    var form = $(this);

    $.ajax({
        headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },  
        url: form.attr('action'),
        method: form.attr('method'),
        data: new FormData(form[0]),
        dataType: 'json',
        async: true,
        contentType: false,
        processData: false,
        success: function(data) {
            Swal.fire(data.title, data.message, data.status);
        },
        error: function() {
            Swal.fire('Unexpected Error', 'The data cannot be sent. Please check your input.', 'error');
        }
    });
});
</script>
@endpush