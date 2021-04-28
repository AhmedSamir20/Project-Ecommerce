
<option value="{{$child_category->id}}" @if($child_category -> id == $categories->parent_id) selected @endif >

    {{ $child_category->name }} {{str_repeat('-', $index+=1)}}

</option>

{{--so the template is recursively loading children, as long as there are categories inside of the current child category.--}}

@if ($child_category->categories)

    @foreach ($child_category->categories as $childCategory)
        @include('dashboard.categories.child_category_edit', ['child_category' => $childCategory])
    @endforeach

@endif
