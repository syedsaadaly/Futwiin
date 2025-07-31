@foreach ($categories as $parent)
    <div class="form-check category-wrapper p-2" data-category-id="{{ $parent->id }}" data-category-name="{{ strtolower($parent->name) }}" data-key="{{ $parent->id }}" data-parents="{{ $parent->parent?->pluck('id')->toJson() }}">
        <input class="form-check-input parent-checkbox" type="checkbox"
            name="categories[]" value="{{ $parent->id }}"
            id="category_{{ $parent->id }}" data-category-id="{{ $parent->id }}"
            {{ in_array($parent->id, $product->categories->pluck('id')->toArray()) ? 'checked' : '' }}>
        <label class="form-check-label fw-bold"
            for="category_{{ $parent->id }}">{{ $parent->name }}</label>
        @include('admin.partial.filter-categories', [
            'parent_categories' => $parent->childs()->whereIn('id', $categoryIds)->get(),
            'selected_categories' => $product->categories->pluck('id')->toArray(),
            'categoryIds' => $categoryIds,
        ])
    </div>
    <hr class="my-2">
@endforeach