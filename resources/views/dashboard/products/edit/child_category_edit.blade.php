
<option value="{{$child_category->id}}"
        @if($product_categories->contains('id', $child_category->id ) == $child_category->id) selected @endif>

    {{ $child_category->name }}

</option>
@if ($child_category->categories)

        @foreach ($child_category->categories as $childCategory)
            @include('dashboard.products.edit.child_category_edit', ['child_category' => $childCategory])

        @endforeach

@endif
