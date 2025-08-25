@extends('admin.layouts.admin')

@section('title', 'Manage Twitter Section')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card card-primary" data-aos="fade-up" data-aos-duration="1000">

            {{-- Header --}}
            <div class="card-header text-white d-flex justify-content-between align-items-center"
                 style="background-color: rgb(0, 0, 0);">
                <h1 style="font-size: 24px;" class="page-heading">Manage Twitter Section</h1>
                <div>
                    {{-- <a href="{{ route('admin.twitter-section.update') }}" 
                       onclick="event.preventDefault(); document.getElementById('update-section-form').submit();" 
                       class="btn btn-secondary">
                        Edit Section
                    </a> --}}
                </div>
            </div>

            {{-- Section Update Form (Hidden trigger) --}}
            <form id="update-section-form" action="{{ route('admin.twitter-section.update') }}" method="POST" style="display:none;">
                @csrf
                @method('PUT')
            </form>

            {{-- Body --}}
            <div class="card-body table-responsive">

                {{-- Flash Message --}}
                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                {{-- Add new tweet --}}
                <form action="{{ route('admin.twitter-items.store') }}" method="POST" class="mb-4">
                    @csrf
                    <div class="row g-2">
                        <div class="col-md-3">
                            <input type="text" name="username" placeholder="Username" class="form-control" required>
                        </div>
                        <div class="col-md-3">
                            <input type="text" name="handle" placeholder="Handle (@)" class="form-control" required>
                        </div>
                        <div class="col-md-4">
                            <input type="text" name="content" placeholder="Tweet Content" class="form-control" required>
                        </div>
                        <div class="col-md-2">
                            <button class="btn btn-dark w-100">+ Add Tweet</button>
                        </div>
                    </div>
                </form>

                {{-- Items Table --}}
                <table class="table table-bordered align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th>#</th>
                            <th>Username</th>
                            <th>Handle</th>
                            <th>Content</th>
                            <th class="text-center" width="20%">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($items as $key => $item)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td><strong>{{ $item->username }}</strong></td>
                                <td>{{ $item->handle }}</td>
                                <td>{{ Str::limit($item->content, 80) }}</td>
                                <td class="text-center">
                                    {{-- Edit Button --}}
                                    <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#editModal{{ $item->id }}">
                                        Edit
                                    </button>

                                    {{-- Delete Form --}}
                                    <form action="{{ route('admin.twitter-items.destroy', $item->id) }}" method="POST"
                                          style="display:inline-block"
                                          onsubmit="return confirm('Are you sure you want to delete this tweet?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">
                                            Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>

                            {{-- Edit Modal --}}
                            <div class="modal fade" id="editModal{{ $item->id }}" tabindex="-1">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <form action="{{ route('admin.twitter-items.update', $item->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')

                                            <div class="modal-header">
                                                <h5 class="modal-title">Edit Tweet</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="mb-2">
                                                    <label>Username</label>
                                                    <input type="text" name="username" value="{{ $item->username }}" class="form-control" required>
                                                </div>
                                                <div class="mb-2">
                                                    <label>Handle</label>
                                                    <input type="text" name="handle" value="{{ $item->handle }}" class="form-control" required>
                                                </div>
                                                <div class="mb-2">
                                                    <label>Content</label>
                                                    <textarea name="content" class="form-control" rows="3" required>{{ $item->content }}</textarea>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                <button type="submit" class="btn btn-primary">Update</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center text-muted">No Twitter Items Found</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</div>
@endsection
