@extends('admin.layout')
@section('title', 'FAQs')

@section('content')
<div class="admin-page-header">
    <div><h1 class="admin-page-title">FAQs <small>Manage frequently asked questions</small></h1></div>
    <div class="admin-page-actions">
        <a href="{{ route('admin.faqs.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Add FAQ</a>
    </div>
</div>
<div class="data-card">
    <div class="data-card-header"><div class="data-card-title"><i class="fas fa-question-circle"></i> All FAQs</div></div>
    <div class="admin-table-wrap">
        <table class="admin-table">
            <thead><tr><th>#</th><th>Question</th><th>Category</th><th>Status</th><th>Actions</th></tr></thead>
            <tbody>
                @forelse($faqs as $faq)
                <tr>
                    <td style="color:var(--admin-muted);">{{ $faq->sort_order ?? '—' }}</td>
                    <td style="max-width:400px;font-weight:500;">{{ Str::limit($faq->question, 80) }}</td>
                    <td><span style="font-size:12px;text-transform:capitalize;background:#f1f5f9;padding:3px 8px;border-radius:4px;">{{ $faq->category ?? 'general' }}</span></td>
                    <td><span class="badge badge-{{ $faq->status == 'active' ? 'active' : 'pending' }}">{{ $faq->status ?? 'active' }}</span></td>
                    <td>
                        <div style="display:flex;gap:6px;">
                            <a href="{{ route('admin.faqs.edit', $faq->id) }}" class="btn btn-sm btn-outline btn-icon"><i class="fas fa-edit"></i></a>
                            <button type="button" class="btn btn-sm btn-danger btn-icon" onclick="confirmAndSubmitDelete('{{ route('admin.faqs.destroy', $faq->id) }}', 'Delete this FAQ?')" title="Delete"><i class="fas fa-trash"></i></button>
                        </div>
                    </td>
                </tr>
                @empty
                <tr class="empty-row"><td colspan="5"><i class="fas fa-question-circle" style="font-size:24px;display:block;margin-bottom:8px;"></i>No FAQs added yet</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($faqs->hasPages())<div style="padding:16px 20px;border-top:1px solid #e2e8f0;">{{ $faqs->links() }}</div>@endif
</div>
@endsection
