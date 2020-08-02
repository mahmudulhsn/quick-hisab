@if(session()->has('message'))
	<div class="text text-{{ session('type') }}">
		<h4 style="text-align:center;">{{ session('message') }}</h4>
	</div>
@endif