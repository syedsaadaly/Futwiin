{{-- resources/views/admin/sayings/index.blade.php --}}
@extends('admin.layouts.admin')

@section('title', 'Manage Sayings')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card card-primary" data-aos="fade-up" data-aos-duration="1000">
            <div class="card-header text-white pb-0" style="background-color: rgb(0, 0, 0);">
                <div class="d-flex justify-content-between align-items-center">
                    <h1 style="font-size: 24px" class="page-heading">
                        Manage Sayings
                    </h1>
                    <a href="{{ route('admin.saying.create') }}">
                        <button class="btn btn-dark">+ Add New</button>
                    </a>
                </div>
            </div>

            <div class="card-body">
                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                <div class="row">
                    <div class="col-12">
                        <table id="sayingsTable" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Designation</th>
                                    <th>Rating</th>
                                    <th>Message</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($sayings as $s)
                                    <tr>
                                        <td>{{ $s->name ?? '-' }}</td>
                                        <td>{{ $s->designation ?? '-' }}</td>
                                        <td>{{ $s->rating ?? '-' }}</td>
                                        <td>{{ Str::limit($s->message, 50) }}</td>
                                        <td>
                                            <a href="{{ route('admin.saying.edit', $s->id) }}"
                                               class="btn btn-info btn-sm" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>

                                            <form action="{{ route('admin.saying.destroy', $s->id) }}"
                                                  method="POST" style="display:inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm"
                                                        onclick="return confirm('Are you sure?')">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center text-muted">No sayings added yet.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('common_script')
<script>
$(document).ready(function() {
    $('#sayingsTable').DataTable({
        responsive: true,
        dom: '<"top"lf>rt<"bottom"ip>',
        language: {
            search: "_INPUT_",
            searchPlaceholder: "Search...",
        }
    });
});
</script>
@endsection
