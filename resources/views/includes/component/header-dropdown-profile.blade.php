<div class="dropdown-menu dropdown-menu-end">
	<a href="javascript:" class="dropdown-item">Edit Profile</a>
	@if (Auth::check())
		@if(Auth::user()->getCheckedInAttribute() == 1)
			<a href="/checkin" class="dropdown-item">Check Out</a>
		@else
		<a href="/checkin" class="dropdown-item">Check In</a>
		@endif
	@endif
	<!-- <a href="javascript:;" class="dropdown-item"><span class="badge bg-danger float-end rounded-pill">2</span> Inbox</a>
	<a href="javascript:;" class="dropdown-item">Calendar</a>
	<a href="javascript:;" class="dropdown-item">Setting</a>-->
	<div class="dropdown-divider"></div>
	<a href="/auth/logout" class="dropdown-item">Log Out</a>
</div>
