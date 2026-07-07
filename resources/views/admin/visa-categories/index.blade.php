@extends('admin.layout')
@section('title', 'Visa Categories')

@section('content')
<div class="admin-page-header">
    <div><h1 class="admin-page-title">Visa Categories <small>Manage visa types and service categories</small></h1></div>
    <div class="admin-page-actions">
        <a href="{{ route('admin.visa-categories.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Add Category</a>
    </div>
</div>
<div class="data-card">
    <div class="data-card-header"><div class="data-card-title"><i class="fas fa-id-card"></i> All Visa Categories</div></div>
    <div class="admin-table-wrap">
        <table class="admin-table">
            <thead><tr><th>Icon</th><th>Name</th><th>Slug</th><th>Description</th><th>Actions</th></tr></thead>
            <tbody>
                @forelse($categories as $cat)
                <tr>
                    <td><i class="{{ $cat->icon ?? 'fas fa-id-card' }}" style="font-size:20px;color:var(--admin-primary);"></i></td>
                    <td><strong>{{ $cat->name }}</strong></td>
                    <td><code style="background:#f1f5f9;padding:2px 8px;border-radius:4px;font-size:11px;">{{ $cat->slug }}</code></td>
                    <td style="max-width:280px;font-size:12px;color:var(--admin-muted);">{{ Str::limit($cat->description, 60) }}</td>
                    <td>
                        <div style="display:flex;gap:6px;">
                            <a href="{{ route('admin.visa-categories.edit', $cat->id) }}" class="btn btn-sm btn-outline btn-icon"><i class="fas fa-edit"></i></a>
                            <button type="button" class="btn btn-sm btn-danger btn-icon" onclick="confirmAndSubmitDelete('{{ route('admin.visa-categories.destroy', $cat->id) }}', 'Delete this visa category?')" title="Delete"><i class="fas fa-trash"></i></button>
                        </div>
                    </td>
                </tr>
                @empty
                <tr class="empty-row"><td colspan="5"><i class="fas fa-id-card" style="font-size:24px;display:block;margin-bottom:8px;"></i>No visa categories added yet</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($categories->hasPages())<div style="padding:16px 20px;border-top:1px solid #e2e8f0;">{{ $categories->links() }}</div>@endif
</div>
@endsection
