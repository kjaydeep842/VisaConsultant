@extends('admin.layout')
@section('title', 'Testimonials')

@section('content')
<div class="admin-page-header">
    <div>
        <h1 class="admin-page-title">Testimonials <small>Manage client success stories and reviews</small></h1>
    </div>
    <div class="admin-page-actions">
        <a href="{{ route('admin.testimonials.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Add Testimonial</a>
    </div>
</div>

<div class="data-card">
    <div class="data-card-header">
        <div class="data-card-title"><i class="fas fa-star"></i> All Testimonials</div>
    </div>
    <div class="admin-table-wrap">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>Client</th>
                    <th>Country / Visa</th>
                    <th>Rating</th>
                    <th>Message</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($testimonials as $t)
                <tr>
                    <td><strong>{{ $t->name }}</strong></td>
                    <td>
                        <div>{{ $t->country }}</div>
                        <div style="font-size:11px;color:var(--admin-muted);">{{ $t->visa_type ?? '' }}</div>
                    </td>
                    <td>
                        <span style="color:#f59e0b;">
                            @for($i=1;$i<=5;$i++)
                                <i class="fas fa-star{{ $i > $t->rating ? '-half-alt' : '' }}" style="{{ $i > $t->rating ? 'opacity:0.3' : '' }}"></i>
                            @endfor
                        </span>
                    </td>
                    <td style="max-width:260px;font-size:13px;color:var(--admin-muted);">{{ Str::limit($t->message, 80) }}</td>
                    <td><span class="badge badge-{{ $t->status ?? 'published' }}">{{ $t->status ?? 'published' }}</span></td>
                    <td>
                        <div style="display:flex;gap:6px;">
                            <a href="{{ route('admin.testimonials.edit', $t->id) }}" class="btn btn-sm btn-outline btn-icon"><i class="fas fa-edit"></i></a>
                            <button type="button" class="btn btn-sm btn-danger btn-icon" onclick="confirmAndSubmitDelete('{{ route('admin.testimonials.destroy', $t->id) }}', 'Delete this testimonial?')" title="Delete"><i class="fas fa-trash"></i></button>
                        </div>
                    </td>
                </tr>
                @empty
                <tr class="empty-row"><td colspan="6"><i class="fas fa-star" style="font-size:24px;display:block;margin-bottom:8px;"></i>No testimonials yet</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($testimonials->hasPages())
    <div style="padding:16px 20px;border-top:1px solid #e2e8f0;">{{ $testimonials->links() }}</div>
    @endif
</div>
@endsection
