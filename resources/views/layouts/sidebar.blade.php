<div id="header_top" class="header_top">
	<div class="container">
		<div class="hleft">
			{{-- <img src="{{ asset('/front/images/chat-logo.png') }}" style="width: 35px; margin-top: 10px;"> --}}
			<div class="dropdown">
			</div>
		</div>
		<div class="hright">
			<div class="dropdown">
				<a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="nav-link icon"><i class="fa fa-sign-out"></i></a>
				<a href="javascript:void(0)" class="nav-link icon menu_toggle"><i class="fa fa-align-left"></i></a>
			</div>            
		</div>
	</div>
</div>

<div id="left-sidebar" class="sidebar ">
	<h5 class="brand-name">Tohama</h5>
	<nav id="left-sidebar-nav" class="sidebar-nav">
		<ul class="metismenu">
			<li class="g_heading">Main Menu</li>
			<li class="{{ request()->is('home*') ? 'active' : '' }}">
				<a href="{{ route('home') }}"><i class="icon-home"></i><span>Dashboard</span></a>
			</li>
			<li class="{{ request()->is('demands*') ? 'active' : '' }}">
				<a href="{{route('demand')}}"><i class="icon-notebook"></i><span>Request</span></a>
			</li>
		</ul>
	</nav>        
</div>