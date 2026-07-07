@extends('admin.layout')
@section('title', 'News')

@section('content')
<div class="admin-page-header">
    <div><h1 class="admin-page-title">News Articles <small>Manage immigration news and announcements</small></h1></div>
    <div class="admin-page-actions">
        <a href="{{ route('admin.news.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Add News</a>
    </div>
</div>
<div class="data-card">
    <div class="data-card-header"><div class="data-card-title"><i class="fas fa-bullhorn"></i> All News Articles</div></div>
    <div class="admin-table-wrap">
        <table class="admin-table">
            <thead><tr><th>Title</th><th>Status</th><th>Published</th><th>Actions</th></tr></thead>
            <tbody>
                @forelse($news as $item)
                <tr>
                    <td><strong style="font-size:14px;">{{ $item->title }}</strong></td>
                    <td><span class="badge badge-{{ $item->status ?? 'published' }}">{{ $item->status ?? 'published' }}</span></td>
                    <td style="font-size:12px;color:var(--admin-muted);">{{ $item->published_at ? $item->published_at->format('d M Y') : 'Draft' }}</td>
                    <td>
                        <div style="display:flex;gap:6px;">
                            <a href="{{ route('admin.news.edit', $item->id) }}" class="btn btn-sm btn-outline btn-icon"><i class="fas fa-edit"></i></a>
                            <button type="button" class="btn btn-sm btn-danger btn-icon" onclick="confirmAndSubmitDelete('{{ route('admin.news.destroy', $item->id) }}', 'Delete this news article?')" title="Delete"><i class="fas fa-trash"></i></button>
                        </div>
                    </td>
                </tr>
                @empty
                <tr class="empty-row"><td colspan="4"><i class="fas fa-bullhorn" style="font-size:24px;display:block;margin-bottom:8px;"></i>No news articles yet</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($news->hasPages())<div style="padding:16px 20px;border-top:1px solid #e2e8f0;">{{ $news->links() }}</div>@endif
</div>
@endsection
