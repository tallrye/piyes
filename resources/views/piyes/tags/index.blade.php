@component('piyes.components.content-listing') 

	@slot('pageUrl') 
		{{ $pageUrl }} 
	@endslot

	@slot('pageName') 
		{{ $pageName }} 
	@endslot

	@slot('pageItem') 
		{{ $pageItem }} 
	@endslot

	@slot('tHead')
		<th class="actionsColumn">Position</th>
		<th>Name</th>
		<th>Created By</th>
        <th>Action</th>
	@endslot

	@slot('tBody') 
		@foreach($records as $record)
            <tr>
                <td class="actionsColumn">{{ $record->position }}</td>
                <td>{{ $record->name }}</td>
                <td>{{ $record->createdby->name .' @ '. $record->created_at->format('d/m/Y') }}</td>
                @include('piyes.includes.content-table-actions', ['record' => $record, 'pageUrl' => $pageUrl])
            </tr>
        @endforeach
	@endslot

@endcomponent