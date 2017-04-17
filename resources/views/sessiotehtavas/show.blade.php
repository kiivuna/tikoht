<div class="comments">
	<ul class="list-group">
		@foreach (DB::table('tehtavas')->having('tehtavalista_id', $sessio->tehtlista_id)->groupBy('id')->get() as $tehtava)
			<li class="list-group-item">
				
				Tehtävän kuvaus: 
				{{ $tehtava->teht_kuvaus }}
				</br>
				Tehtävän esimerkkivastaus:
				{{ $tehtava->esim_vastaus }}
				</br>
				Tehtävän kyselytyyppi:
				{{ $tehtava->kysely_tyyppi }}
				<hr>

			</li>
		@endforeach
	</ul>
</div>