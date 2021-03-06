@php
  $browse_nodes = abs_browse_nodes($item);
  $browse_nodes = array_reverse($browse_nodes);
@endphp

@if(count($browse_nodes) > 0)
  <div class="uk-card-body">
    <ul class="uk-breadcrumb">
      @foreach($browse_nodes as $node_name => $node_id)
        <li><a href="{{ route('browse', $node_id) }}">{{ abs_decode($node_name) }}</a></li>
      @endforeach
    </ul>
  </div>
@endif
