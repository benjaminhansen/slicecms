@foreach($items as $item)
  <li@lm-attrs($item) @if($item->hasChildren() && isset($dropdown_submenu) && $dropdown_submenu) class="dropdown-submenu" @elseif($item->hasChildren() && !isset($dropdown_submenu)) class="dropdown" @endif @lm-endattrs>
    @if($item->link)
    <a@lm-attrs($item->link) @if($item->hasChildren()) class="dropdown-toggle" data-toggle="dropdown" @endif @lm-endattrs href="{!! $item->url() !!}">
      {!! $item->title !!}
      @if($item->hasChildren()) <b class="caret"></b> @endif
    </a>
    @else
      {!! $item->title !!}
    @endif
    @if($item->hasChildren())
      <ul class="dropdown-menu">
        @include('slice.nav.bootstrap3', array('items' => $item->children(), 'dropdown_submenu' => true))
      </ul>
    @endif
  </li>
  @if($item->divider)
  	<li{!! Lavary\Menu\Builder::attributes($item->divider) !!}></li>
  @endif
@endforeach
