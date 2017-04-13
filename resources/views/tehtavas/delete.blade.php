@if(Auth::check() && ((Auth::user()->id == App\User::find($tehtavalista->tehtlista_luoja_id)->id) || Auth::user()->isAdmin()))
	<form id="delete" method="POST" action="/tehtavas/{{ $tehtava->id }}/delete">
		{{ csrf_field() }}
		<div class="form-group">  

			<input type="submit" name="delete" value="Delete!">    
			<a class="" href='/tehtavas/{{ $tehtava->id }}/edit'>Edit</a>  
			 </div>
	</form>
@endif
