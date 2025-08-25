<div class="form-group mb-3">
    <label>Name</label>
    <input type="text" name="name" class="form-control" required value="{{ old('name', $featuredPlayer->name ?? '') }}">
</div>

<div class="form-group mb-3">
    <label>Club</label>
    <input type="text" name="club" class="form-control" required value="{{ old('club', $featuredPlayer->club ?? '') }}">
</div>

<div class="form-group mb-3">
    <label>Age</label>
    <input type="number" name="age" class="form-control" value="{{ old('age', $featuredPlayer->age ?? '') }}">
</div>

<div class="form-group mb-3">
    <label>Position</label>
    <input type="text" name="position" class="form-control" value="{{ old('position', $featuredPlayer->position ?? '') }}">
</div>

<div class="form-group mb-3">
    <label>Country Flag</label>
    <input type="text" name="country_flag" class="form-control" value="{{ old('country_flag', $featuredPlayer->country_flag ?? '') }}">
</div>

<div class="form-group mb-3">
    <label>Image</label><br>
    @if(!empty($featuredPlayer->image))
        <img src="{{ asset('storage/'.$featuredPlayer->image) }}" width="80" class="mb-2"><br>
    @endif
    <input type="file" name="image" class="form-control">
</div>

<div class="form-group mb-3">
    <label>Season Stats</label>
    <input type="text" name="season_stats" class="form-control" value="{{ old('season_stats', $featuredPlayer->season_stats ?? '') }}">
</div>

<div class="form-group mb-3">
    <label>Description</label>
    <textarea name="description" class="form-control">{{ old('description', $featuredPlayer->description ?? '') }}</textarea>
</div>

<div class="form-group mb-3">
    <label>Sort Order</label>
    <input type="number" name="sort_order" class="form-control" value="{{ old('sort_order', $featuredPlayer->sort_order ?? 0) }}">
</div>

<div class="form-group mb-3">
    <label>Status</label><br>
    <input type="checkbox" name="status" value="1" {{ old('status', $featuredPlayer->status ?? false) ? 'checked' : '' }}> Active
</div>
