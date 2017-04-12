<div class="card">
	<div class="card-block">
		<form method="POST" action="/tehtavalistas/{{ $tehtavalista->id }}/tehtavas">

		  {{ csrf_field() }}

		  <div class="form-group">
		    <label for="teht_kuvaus">Anna tehtävän kuvaus</label>
		    <input type="text" class="form-control" id="teht_kuvaus" name="teht_kuvaus" required>
		  </div>

		  <div class="form-group">
		    <label for="esim_vastaus">Anna esimerkkivastaus</label>
		    <input type="text" class="form-control" id="esim_vastaus" name="esim_vastaus" required>
		  </div>

		  <div class="form-group">
		    <label for="kysely_tyyppi">Anna kyselyn tyyppi</label>
		    <input type="text" class="form-control" id="kysely_tyyppi" name="kysely_tyyppi" required>
		  </div>

		  <div class="form-group">
		  	<button type="submit" class="btn btn-primary">Luo tehtävä</button>
		  </div>


		  @include('layouts.errors')

		</form>
	</div>

</div>