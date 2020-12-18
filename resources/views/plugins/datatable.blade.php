@push('css')
<link rel="stylesheet" href="{{ asset('plugins/datatable/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/datatable/fixedeader/dataTables.fixedcolumns.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/datatable/fixedeader/dataTables.fixedheader.bootstrap4.min.css') }}">


@endpush

@push('js')
<script src="{{ asset('bundles/dataTables.bundle.js') }}"></script>
<script src="{{ asset('js/table/datatable.js') }}"></script>
@endpush