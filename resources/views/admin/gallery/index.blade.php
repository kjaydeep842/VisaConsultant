@extends('admin.layout')
@section('title', 'Gallery Manager')

@section('content')
<div class="admin-page-header">
    <div><h1 class="admin-page-title">Gallery Manager <small>Manage customer gallery images and descriptions</small></h1></div>
    <div class="admin-page-actions">
        <a href="{{ route('admin.gallery.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Upload Image</a>
    </div>
</div>
<div class="data-card">
    <div class="data-card-header"><div class="data-card-title"><i class="fas fa-images"></i> Customer Gallery Items</div></div>
    <div class="admin-table-wrap">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Category</th>
                    <th>Country</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($gallery as $item)
                <tr>
                    <td>
                        @if($item->image)
                            <img src="{{ storageFile($item->image) }}" alt="{{ $item->title }}" style="width: 80px; height: 50px; object-fit: cover; border-radius: 4px; border: 1px solid #e2e8f0;">
                        @else
                            <span style="font-size:12px; color:var(--admin-muted);">No image</span>
                        @endif
                    </td>
                    <td style="font-weight:600;">{{ $item->title }}</td>
                    <td style="max-width:300px; color:var(--admin-muted); font-size:13px;">{{ Str::limit($item->description, 100) }}</td>
                    <td><span style="font-size:12px;text-transform:capitalize;background:#f1f5f9;padding:3px 8px;border-radius:4px;">{{ $item->category ?? 'General' }}</span></td>
                    <td><span style="font-size:12px;font-weight:500;color:var(--primary-color);">{{ $item->country->name ?? 'All Countries' }}</span></td>
                    <td>
                        <span class="badge badge-{{ $item->is_active ? 'active' : 'pending' }}">
                            {{ $item->is_active ? 'Active' : 'Hidden' }}
                        </span>
                    </td>
                    <td>
                        <div style="display:flex;gap:6px;">
                            <a href="{{ route('admin.gallery.edit', $item->id) }}" class="btn btn-sm btn-outline btn-icon"><i class="fas fa-edit"></i></a>
                            <button type="button" class="btn btn-sm btn-danger btn-icon" onclick="confirmAndSubmitDelete('{{ route('admin.gallery.destroy', $item->id) }}', 'Delete this gallery item?')" title="Delete"><i class="fas fa-trash"></i></button>
                        </div>
                    </td>
                </tr>
                @empty
                <tr class="empty-row"><td colspan="7"><i class="fas fa-images" style="font-size:24px;display:block;margin-bottom:8px;"></i>No gallery items uploaded yet</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($gallery->hasPages())<div style="padding:16px 20px;border-top:1px solid #e2e8f0;">{{ $gallery->links() }}</div>@endif
</div>
@endsection
