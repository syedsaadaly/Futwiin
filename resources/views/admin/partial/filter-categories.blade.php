@if ($parent_categories->count() > 0)
    <div class="child-categories ps-5 mt-2 ml-4">
        @foreach ($parent_categories as $category)
            <div class="form-check category-wrapper" data-category-id="{{ $category->id }}" data-category-name="{{ strtolower($category->name) }}" data-parents="{{ $category->parent?->pluck('name')->toJson() }}">
                <input class="form-check-input child-checkbox" type="checkbox" 
                    name="categories[]" 
                    value="{{ $category->id }}" 
                    id="category_{{ $category->id }}"
                    @if(isset($selected_categories) && in_array($category->id, $selected_categories)) checked @endif>
                <label class="form-check-label text-dark" for="category_{{ $category->id }}">
                    {{ $category->name }}
                </label>
            </div>
            @if ($category->childs()->whereIn('id', $categoryIds)->count() > 0)
                @include('admin.partial.filter-categories', [
                    'parent_categories' => $category->childs()->whereIn('id', $categoryIds)->get(),
                    'selected_categories' => $selected_categories ?? []
                ])
            @endif
        @endforeach
    </div>
@endif