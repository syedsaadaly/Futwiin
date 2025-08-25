@extends('admin.layouts.admin')

@section('title', 'Manage How It Works')

@section('content')
<div class="row">
    <div class="col-12">

        <div class="card card-primary shadow-sm" data-aos="fade-up" data-aos-duration="1000">

            {{-- Header --}}
            <div class="card-header text-white d-flex justify-content-between align-items-center"
                 style="background-color: rgb(0,0,0);">
                <h1 class="page-heading mb-0" style="font-size: 22px;">How It Works</h1>
                <a href="{{ route('admin.how-it-works.create') }}" class="btn btn-success btn-sm">
                    <i class="fas fa-plus me-1"></i> Add New Item
                </a>
            </div>

            {{-- Table --}}
            <div class="card-body p-0">
                <table class="table table-bordered mb-0">
                    <thead class="table-dark">
                        <tr>
                            <th style="width: 80px;">Icon</th>
                            <th style="width: 200px;">Title</th>
                            <th>Description</th>
                            <th style="width: 180px;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($items as $item)
                        <tr>
                            <td class="text-center">
                                <i class="{{ $item->icon }} fa-2x"></i>
                            </td>
                            <td>{{ $item->title }}</td>
                            <td>{{ $item->description }}</td>
                            <td class="text-center">
                                <a href="{{ route('admin.how-it-works.edit', $item->id) }}"
                                   class="btn btn-primary btn-sm me-1">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                <form action="{{ route('admin.how-it-works.destroy', $item->id) }}"
                                      method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm"
                                            onclick="return confirm('Are you sure?')">
                                        <i class="fas fa-trash"></i> Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-center text-muted">
                                No items added yet.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>

    </div>
</div>
@endsection
