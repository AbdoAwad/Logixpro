
@extends('layouts.app', ['header_title' => 'Requests'])
@include('plugins.dropify')
@include('plugins.datatable')

@push('css')
@endpush

@section('content')

<div id="table-requests"></div>

@push('modal')
    <div class="modal fade" id="modal-request" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Create Request</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <form id="form-add" method="POST" action="{{ route('demand') }}">
                        @csrf
                        <div class="row clearfix p-2">
                            <div class="col-sm-12">
                                <div class="form-group ">
                                    <label class="form-label">Title</label>
                                    <input name="title" autocomplete="off" required type="text" class="form-control circle">
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group ">
                                        <div class="form-group ">
                                            <label class="form-label">Items</label>
                                            <input name="items[]" autocomplete="off" required type="text" class="form-control circle item">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                <div class="form-group ">
                                        <div class="form-group ">
                                            <label class="form-label">Quantitis</label>
                                            <input name="quantities[]" autocomplete="off" required type="text" class="form-control circle quantity">
                                        </div>
                                    </div>
                                </div>
                                
                                
                            
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary" data-submit="form-add" >Create Request</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endpush
@endsection

@push('js')
<script>
    function autoIncrement() {
		$(".item").on('keydown', function() {
            console.log('here');
			if($(this).val() == '') {
				if($(this).next('input').length == 0) {
                    $(this).parent().append(' <input name="items[]" autocomplete="off"  type="text" class="form-control circle item">');
                    $('.quantity').parent().append(' <input name="quantities[]" autocomplete="off"  type="text" class="form-control circle quantity">');
					autoIncrement();
				}
			}
		});

		$(".item").on('blur', function() {
			if($(this).val() == '') {
				if($(this).next('input').length > 0) {
					$(this).remove();
				}
			}
        });
        
    }

    autoIncrement();
    $( document ).ready(function() {
        fetchCategoryList();
    });

    function fetchCategoryList(){
        $("#table-requests").load("{{ request()->fullUrl() }}");
    }

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

                            fetchCategoryList();
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
