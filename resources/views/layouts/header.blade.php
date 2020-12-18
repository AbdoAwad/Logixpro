<div id="page_top" class="section-body ">
	<div class="container-fluid">
		<div class="page-header">
			<div class="left">
				<h1 class="page-title">{{ $header_title }}</h1>
			</div>
			<div class="right">
				<ul class="nav nav-pills">
					<div class="dropdown d-flex">
						<a class="nav-link icon d-none d-md-flex btn btn-default btn-icon ml-1" data-toggle="dropdown">
							{{ auth()->user()->name }} <span class="caret"></span>
							<a class="header-brand" style="background-image: url('{{ auth()->user()->avatar }}'); background-position: center; background-size: cover; border-radius: 17.5px; height: 35px; width: 35px;"></a>
						</a>
						<div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
							<a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="dropdown-icon fe fe-log-out"></i> Sign out</a>

							<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
								@csrf
							</form>
						</div>
					</div>
				</ul>
			</div>
		</div>
	</div>
</div>