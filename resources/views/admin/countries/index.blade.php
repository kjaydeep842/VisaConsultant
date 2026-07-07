@extends('admin.layout')
@section('title', 'Countries')

@section('content')
<div class="admin-page-header">
    <div>
        <h1 class="admin-page-title">Destination Countries <small>Manage immigration destinations</small></h1>
    </div>
    <div class="admin-page-actions">
        <a href="{{ route('admin.countries.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Add Country</a>
    </div>
</div>

<div class="data-card">
    <div class="data-card-header">
        <div class="data-card-title"><i class="fas fa-globe-americas"></i> All Countries</div>
    </div>
    <div class="admin-table-wrap">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>Flag</th>
                    <th>Country Name</th>
                    <th>Code</th>
                    <th>Slug</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($countries as $country)
                <tr>
                    <td>
                        <img src="https://flagcdn.com/w40/{{ strtolower($country->code ?? 'ca') }}.png"
                             alt="{{ $country->name }}" style="width:32px;border-radius:3px;border:1px solid #e2e8f0;">
                    </td>
                    <td><strong>{{ $country->name }}</strong></td>
                    <td><code style="background:#f1f5f9;padding:2px 8px;border-radius:4px;font-size:12px;">{{ $country->code }}</code></td>
                    <td><code style="background:#f1f5f9;padding:2px 8px;border-radius:4px;font-size:12px;">{{ $country->slug }}</code></td>
                    <td>
                        <div style="display:flex;gap:6px;">
                            <a href="{{ route('admin.countries.edit', $country->id) }}" class="btn btn-sm btn-outline btn-icon" title="Edit"><i class="fas fa-edit"></i></a>
                            <button type="button" class="btn btn-sm btn-danger btn-icon" onclick="confirmAndSubmitDelete('{{ route('admin.countries.destroy', $country->id) }}', 'Delete this country?')" title="Delete"><i class="fas fa-trash"></i></button>
                        </div>
                    </td>
                </tr>
                @empty
                <tr class="empty-row"><td colspan="5"><i class="fas fa-globe" style="font-size:24px;display:block;margin-bottom:8px;"></i>No countries added yet</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($countries->hasPages())
    <div style="padding:16px 20px;border-top:1px solid #e2e8f0;">
        {{ $countries->links() }}
    </div>
    @endif
</div>
@endsection
