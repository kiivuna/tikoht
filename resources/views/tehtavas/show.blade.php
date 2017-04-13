<div class="comments">
	<ul class="list-group">
		@foreach ($tehtavalista->tehtavas as $tehtava)
			<li class="list-group-item">

				<strong>
					Lisätty:
					</br>
					{{ $tehtava->created_at->toFormattedDateString() }}
					</br>
				</strong> 
				Tehtävän kuvaus: 
				{{ $tehtava->teht_kuvaus }}
				</br>
				Tehtävän esimerkkivastaus:
				{{ $tehtava->esim_vastaus }}
				</br>
				Tehtävän kyselytyyppi:
				{{ $tehtava->kysely_tyyppi }}
				<hr>
				@include('tehtavas.delete')
			</li>
		@endforeach
	</ul>
</div>