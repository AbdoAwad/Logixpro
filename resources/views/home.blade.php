@extends('layouts.app')

@section('content')
<div class="container-fluid">
	<div class="row clearfix">
		<div class="col-lg-12 text-left">
			<div class="mb-4">
				<h4>Welcome {{ auth()->user()->name }}!</h4>
			</div>                        
		</div>
	</div>
	<div class="row clearfix">
		<div class="col-6 col-md-4 col-xl-4">
			<div class="card">
				<div class="card-body ribbon">
					<a href="#" class="my_sort_cut text-muted">
						<i class="icon-notebook"></i>
						<span>Requests</span>
					</a>
				</div>
			</div>
        </div>
	</div>
</div>
@endsection

