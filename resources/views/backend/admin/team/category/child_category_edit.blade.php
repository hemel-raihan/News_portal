@isset($category)
<ul class="transfer-double-group-list-li-ul transfer-double-group-list-li-ul-1636878492751">
    @foreach($sub_category->childrenRecursive as $key => $sub)

        <li class="transfer-double-group-list-li-ul-li transfer-double-group-list-li-ul-li-1636878492751">
        <div class="checkbox-group">
                <input type="checkbox" name="parent_id" value="{{$sub->id}}" {{$sub->id == $category->parent_id ? 'checked' : ''}}  class="checkbox-normal group-checkbox-item-1636878492751 belongs-group-0-1636878492751" id="group_<?php echo $sub_category->id; ?>_checkbox_<?php echo $key ?>_1636878492751" />
                <label for="group_<?php echo $sub_category->id; ?>_checkbox_<?php echo $key; ?>_1636878492751" class="group-checkbox-name-1636878492751">{{$sub->name}}</label>
            </div>

            @if($categoryy->childrenRecursive->count()>0)
            @include('backend.admin.team.category.child_category_edit', ['sub_category' => $sub])
            @endif
         </li>
         @endforeach
</ul>
@endisset

