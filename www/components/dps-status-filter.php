<div>
	Filtrer sur le statut : 
	<button class='btn btn-default filter-button' data-filter='all'>Afficher tout</button>
	<button class='btn btn-warning filter-button' data-filter='not'>Non-validé</button>
	<button class='btn btn-info filter-button' data-filter='valid_rt'>Validé Antenne</button>
	<button class='btn btn-success filter-button' data-filter='valid_ddo'>Validé</button>
	<button class='btn btn-danger filter-button' data-filter='refused'>Refusé</button>
</div>

<script type='text/javascript'>
	$(document).ready(function(){
		$(".filter-button").click(function(){
			var value = $(this).attr('data-filter');
			if(value == "all")
			{
				$('.filter').show('1000');
			}
			else
			{
				$(".filter").not('.'+value).hide('3000');
				$('.filter').filter('.'+value).show('3000');
			}
		});
	});
</script>
