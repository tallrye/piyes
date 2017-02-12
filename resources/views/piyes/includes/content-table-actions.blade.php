<td class="center actionsColumn">
	<a 	href="{{ route('piyes.'.$pageUrl.'.edit', ['role' => $record->id]) }}" 
		class="btn btn-sm btn-info">
		<i class="fa fa-edit"></i>
	</a>
	<button type="button" 
			class="btn btn-danger btn-sm" 
			data-toggle="modal" 
			data-target="#deleteModal{{ $record->id }}"><i class="fa fa-trash"></i>
	</button>
	@include('piyes.includes.delete-modal', [ 
		'modal_id' => 'deleteModal'.$record->id, 
		'route' => 'piyes.'.$pageUrl.'.delete', 
		'id' => ['role' => $record->id]
	]) 
</td>