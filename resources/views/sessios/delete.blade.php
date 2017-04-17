@if(Auth::check() && ((Auth::user()->id == App\User::find($sessio->session_luoja_id)->id) || Auth::user()->isAdmin()))
	<form id="delete" method="POST" action="/sessios/{{ $sessio->id }}/delete">
		{{ csrf_field() }}
		<div class="form-group">  

			<input type="submit" name="delete" value="Delete!">  
			<a class="" href='/sessios/{{ $sessio->id }}/edit'>Edit</a>  

		</div>
	</form>

@endif