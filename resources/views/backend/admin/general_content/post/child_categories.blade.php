<!-- @php
    for ($i=0; $i < $sub_category->parent_id; $i++)
    {@endphp



    <ul class="transfer-double-group-list-li-ul transfer-double-group-list-li-ul-1636878492751">
    <li class="transfer-double-group-list-li-ul-li transfer-double-group-list-li-ul-li-1636878492751">
        <div class="checkbox-group">
            <input type="checkbox" value="122" class="checkbox-normal group-checkbox-item-1636878492751 belongs-group-0-1636878492751" id="group_0_checkbox_0_1636878492751" />
            <label for="group_0_checkbox_0_1636878492751" class="group-checkbox-name-1636878492751">{{$sub_category->name}}</label>
        </div>
    </li>
    </ul>
    @if ($sub_category->categories)
    @foreach ($sub_category->categories as $sub)
        @include('backend.admin.blog.category.child_categories', ['sub_category' => $sub])
    @endforeach
    @endif

@php
}
@endphp -->



<ul class="transfer-double-group-list-li-ul transfer-double-group-list-li-ul-1636878492751">
@foreach($sub_category->childrenRecursive as $key => $sub)
    <li class="transfer-double-group-list-li-ul-li transfer-double-group-list-li-ul-li-1636878492751">
    <div class="checkbox-group">
            <input type="checkbox" name="categories[]" value="{{$sub->id}}"  class="checkbox-normal group-checkbox-item-1636878492751 belongs-group-0-1636878492751" id="group_<?php echo $sub_category->id; ?>_checkbox_<?php echo $key ?>_1636878492751" />
            <label for="group_<?php echo $sub_category->id; ?>_checkbox_<?php echo $key; ?>_1636878492751" class="group-checkbox-name-1636878492751">{{$sub->name}}</label>
        </div>

        @if($category->childrenRecursive->count()>0)
        @include('backend.admin.general_content.post.child_categories', ['sub_category' => $sub])
        @endif
     </li>
     @endforeach
</ul>

