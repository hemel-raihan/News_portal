<ol class="dd-list">
    @foreach($itemm->childs as $childItem)
<li class="dd-item" data-id="{{$childItem->id}}">

<div class="pull-right item_actions">

    {{-- <a href="{{route('admin.menuitem.edit',['id'=>$menu->id,'menuId'=>$childItem->id])}}" class="btn btn-success">
        <i class="fa fa-edit"></i>
    </a> --}}

    <a onclick="Foo_child({{ $childItem->id}})" href="#" class="btn btn-success">
        <i class="fa fa-edit"></i>
    </a>

   <a class="btn btn-danger waves effect" href="{{route('admin.menuitem.destroy',['id'=>$menu->id, 'menuId'=>$childItem->id])}}" >
       <i class="fa fa-trash"></i>
    </a>
</div>

    <div class="dd-handle">
        @if($childItem->type == 'divider')
        <strong> Divider: {{$childItem->divider_title }}</strong>
        @else
        <span  id="titlee-{{$childItem->id}}" > {{$childItem->title }}</span>
        @isset($childItem->url)
        <small id="url-{{$childItem->id}}" class="url">{{$childItem->url}}</small>
        <small id="slug-{{$childItem->id}}" class="url">0</small>
        @else
        <small id="slug-{{$childItem->id}}" class="url">{{$childItem->slug}}</small>
        <small id="url-{{$childItem->id}}" class="url">0</small>
        @endisset
        @endif
    </div>

    @if($itemm->childs->count()>0)
    @include('backend.admin.frontmenu.child', ['itemm' => $childItem])
    @endif

</li>
@endforeach
</ol>

