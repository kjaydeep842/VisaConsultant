@extends('admin.layout')
@section('title', 'Banner Manager')

@section('content')
<div class="admin-page-header">
    <div><h1 class="admin-page-title">Banner Manager <small>Manage home page hero banners</small></h1></div>
    <div class="admin-page-actions">
        <a href="{{ route('admin.banners.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Add Banner</a>
    </div>
</div>
<div class="data-card">
    <div class="data-card-header"><div class="data-card-title"><i class="fas fa-image"></i> Home Banners</div></div>
    <div class="admin-table-wrap">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Title</th>
                    <th>Subtitle</th>
                    <th>Order</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($banners as $banner)
                <tr>
                    <td>
                        @if($banner->image_path)
                            <img src="{{ asset($banner->image_path) }}" alt="{{ $banner->title }}" style="width: 100px; height: 50px; object-fit: cover; border-radius: 4px; border: 1px solid #e2e8f0;">
                        @else
                            <span style="font-size:12px; color:var(--admin-muted);">No image</span>
                        @endif
                    </td>
                    <td style="font-weight:600;">{{ $banner->title }}</td>
                    <td style="color:var(--admin-muted); font-size:13px;">{{ Str::limit($banner->subtitle, 50) }}</td>
                    <td>{{ $banner->order }}</td>
                    <td>
                        <span class="badge badge-{{ $banner->is_active ? 'active' : 'pending' }}">
                            {{ $banner->is_active ? 'Active' : 'Hidden' }}
                        </span>
                    </td>
                    <td>
                        <div style="display:flex;gap:6px;">
                            <a href="{{ route('admin.banners.edit', $banner->id) }}" class="btn btn-sm btn-outline btn-icon"><i class="fas fa-edit"></i></a>
                            <form action="{{ route('admin.banners.destroy', $banner->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger btn-icon" onclick="return confirm('Delete this banner?')" title="Delete"><i class="fas fa-trash"></i></button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr class="empty-row"><td colspan="6"><i class="fas fa-images" style="font-size:24px;display:block;margin-bottom:8px;"></i>No banners created yet</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
