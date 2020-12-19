@extends('layouts.app', ['header_title' => 'Request'])
@include('plugins.dropify')

@push('css')
@endpush

@section('content')
@if(Auth()->User()->id + 1 ==  $demand->level && ($demand->user_id == Auth()->User()->id ||Auth()->User()->id  == 2))
    <div class="container-fluid mb-3">
        <div class="row clearfix">
            <div class="col-12">
                <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#modal-request">
                    <i class="fa fa-plus mr-1"></i> Add Item To The Request
                </button>
            </div>
        </div>
    </div>
@endif

    <form id="form-update" method="POST" action="{{ route('demand.items', $demand->id)  }}">
        @method('PATCH')

    <div id="table-requests"></div>

    <div class="modal-footer">
        <a href="{{route('demand') }}" class="btn btn-default">Back</a><button type="submit" data-submit="form-update" class="btn btn-primary pull-right" id="submit"><i class="fa fa-check mr-1"></i> Update</button>
    </div>
    </form>

@endsection
      


@push('modal')
    <div class="modal fade" id="modal-request" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Item To The Request</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <form id="form-add" method="POST" action="{{ route('demand.items', $demand->id) }}">
                        @csrf
                        <div class="row clearfix p-2">

                            <div class="col-sm-6">
                                <div class="form-group ">
                                        <div class="form-group ">
                                            <label class="form-label">Items</label>
                                            <input name="item" autocomplete="off" required type="text" class="form-control circle item">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                <div class="form-group ">
                                        <div class="form-group ">
                                            <label class="form-label">Quantitis</label>
                                            <input name="quantity" autocomplete="off" required type="text" class="form-control circle quantity">
                                        </div>
                                    </div>
                                </div>
                                
                                
                            
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary" data-submit="form-add" >Add Item To The Request</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endpush
@push('js')
<script type="text/javascript">
    console.log({{$number}});
  

    function fetchCategoryList(){
        $("#table-requests").load("{{ request()->fullUrl() }}");
    }

    fetchCategoryList()
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

$("#form-add").on('submit', function (e) {
        console.log("here")
        e.preventDefault();
        var form = $(this);

        $.ajax({
            url: form.attr('action'),
            method: form.attr('method'),
            data: new FormData(form[0]),
            dataType: 'json',
            async: true,
            contentType: false,
            processData: false,
            success: function(data) {
                if(data.status == 'success') {
                    Swal.fire({
                        title: data.title,
                        text: data.message,
                        type: data.status,
                        showCancelButton: false,
                        closeOnConfirm: true,
                    }).then((confirm) => {
                        if(confirm.value) {
                            form.trigger('reset');
                            $('#modal-request').modal('hide');
                            $('.dropify-clear').click();
                            $('.modal-backdrop').hide();

                            location.reload()
                        }
                    });
                }
                else {
                    Swal.fire(data.title, data.message, data.status);
                }
            },
            error: function() {
                Swal.fire('Unexpected Error', 'The data cannot be sent. Please check your input.', 'error');
            }
        });
    });
    
</script>
@endpush