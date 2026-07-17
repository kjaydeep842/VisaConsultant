@extends('admin.layout')
@section('title', 'Awards Manager')

@section('content')
<div class="admin-page-header">
    <div><h1 class="admin-page-title">Awards & Certificates <small>Manage company awards and achievements</small></h1></div>
    <div class="admin-page-actions">
        <a href="{{ route('admin.awards.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Add Award</a>
    </div>
</div>
<div class="data-card">
    <div class="data-card-header"><div class="data-card-title"><i class="fas fa-award"></i> Awards List</div></div>
    <div class="admin-table-wrap">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Title</th>
                    <th>Order</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($awards as $award)
                <tr>
                    <td>
                        @if($award->image_path)
                            <img src="{{ storageFile($award->image_path) }}" alt="{{ $award->title }}" style="width: 50px; height: 50px; object-fit: contain; border-radius: 4px; border: 1px solid #e2e8f0; background: #fff;">
                        @else
                            <span style="font-size:12px; color:var(--admin-muted);">No image</span>
                        @endif
                    </td>
                    <td style="font-weight:600;">{{ $award->title ?? 'N/A' }}</td>
                    <td>{{ $award->sort_order }}</td>
                    <td>
                        <span class="badge badge-{{ $award->is_active ? 'active' : 'pending' }}">
                            {{ $award->is_active ? 'Active' : 'Hidden' }}
                        </span>
                    </td>
                    <td>
                        <div style="display:flex;gap:6px;">
                            <a href="{{ route('admin.awards.edit', $award->id) }}" class="btn btn-sm btn-outline btn-icon"><i class="fas fa-edit"></i></a>
                            <form action="{{ route('admin.awards.destroy', $award->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger btn-icon" onclick="return confirm('Delete this award?')" title="Delete"><i class="fas fa-trash"></i></button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr class="empty-row"><td colspan="5"><i class="fas fa-award" style="font-size:24px;display:block;margin-bottom:8px;"></i>No awards added yet</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
