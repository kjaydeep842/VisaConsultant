@extends('admin.layout')
@section('title', 'Blogs & Articles')

@section('content')
<div class="admin-page-header">
    <div>
        <h1 class="admin-page-title">Blogs & Articles <small>Publish immigration news, guides, and updates</small></h1>
    </div>
    <div class="admin-page-actions">
        <a href="{{ route('admin.blogs.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Write Article</a>
    </div>
</div>

<div class="data-card">
    <div class="data-card-header">
        <div class="data-card-title"><i class="fas fa-newspaper"></i> All Articles</div>
        <span style="font-size:12px;color:var(--admin-muted);">{{ $blogs->total() }} total posts</span>
    </div>
    <div class="admin-table-wrap">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Slug</th>
                    <th>Views</th>
                    <th>Status</th>
                    <th>Published</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($blogs as $blog)
                <tr>
                    <td>
                        <div style="font-weight:600;max-width:280px;">{{ $blog->title }}</div>
                        @if($blog->category)<div style="font-size:11px;color:var(--admin-muted);">{{ $blog->category }}</div>@endif
                    </td>
                    <td><code style="background:#f1f5f9;padding:2px 8px;border-radius:4px;font-size:11px;">{{ $blog->slug }}</code></td>
                    <td>
                        <span style="font-size:13px;"><i class="fas fa-eye" style="color:var(--admin-muted);margin-right:4px;font-size:11px;"></i>{{ number_format($blog->views) }}</span>
                    </td>
                    <td><span class="badge badge-{{ $blog->status ?? 'published' }}">{{ $blog->status ?? 'published' }}</span></td>
                    <td style="font-size:12px;color:var(--admin-muted);">
                        {{ $blog->published_at ? $blog->published_at->format('d M Y') : 'Draft' }}
                    </td>
                    <td>
                        <div style="display:flex;gap:6px;">
                            <a href="{{ route('blog.show', $blog->slug) }}" target="_blank" class="btn btn-sm btn-outline btn-icon" title="View"><i class="fas fa-external-link-alt"></i></a>
                            <a href="{{ route('admin.blogs.edit', $blog->id) }}" class="btn btn-sm btn-outline btn-icon" title="Edit"><i class="fas fa-edit"></i></a>
                            <button type="button" class="btn btn-sm btn-danger btn-icon" onclick="confirmAndSubmitDelete('{{ route('admin.blogs.destroy', $blog->id) }}', 'Delete this article?')" title="Delete"><i class="fas fa-trash"></i></button>
                        </div>
                    </td>
                </tr>
                @empty
                <tr class="empty-row"><td colspan="6"><i class="fas fa-newspaper" style="font-size:24px;display:block;margin-bottom:8px;"></i>No articles published yet</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($blogs->hasPages())
    <div style="padding:16px 20px;border-top:1px solid #e2e8f0;">{{ $blogs->links() }}</div>
    @endif
</div>
@endsection
