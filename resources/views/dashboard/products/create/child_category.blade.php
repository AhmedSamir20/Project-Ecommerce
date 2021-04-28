


<option value="{{$child_category->id}}">

    {{ $child_category->name }} {{str_repeat('-',  $index+=1)}}

</option>
@if ($child_category->categories)

        @foreach ($child_category->categories as $childCategory)
            @include('dashboard.categories.child_category', ['child_category' => $childCategory])


        @endforeach

@endif
