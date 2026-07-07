@extends('admin.layout')
@section('title', 'Analytics')

@section('content')
<div class="admin-page-header">
    <div>
        <h1 class="admin-page-title">Analytics Overview <small>Performance metrics and conversion tracking</small></h1>
    </div>
</div>

<div class="stats-grid">
    <div class="stat-card">
        <div class="stat-icon blue"><i class="fas fa-eye"></i></div>
        <div class="stat-info">
            <div class="stat-label">Page Views (30d)</div>
            <div class="stat-value">12,480</div>
            <div class="stat-sub" style="color:var(--admin-success);">↑ 18% vs last month</div>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon cyan"><i class="fas fa-user-check"></i></div>
        <div class="stat-info">
            <div class="stat-label">Unique Visitors</div>
            <div class="stat-value">3,241</div>
            <div class="stat-sub" style="color:var(--admin-success);">↑ 12% growth</div>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon gold"><i class="fas fa-funnel-dollar"></i></div>
        <div class="stat-info">
            <div class="stat-label">Conversion Rate</div>
            <div class="stat-value">4.8%</div>
            <div class="stat-sub">Leads / Visitors</div>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon green"><i class="fas fa-clock"></i></div>
        <div class="stat-info">
            <div class="stat-label">Avg. Session Time</div>
            <div class="stat-value">3m 42s</div>
            <div class="stat-sub">Per visitor</div>
        </div>
    </div>
</div>

<div class="grid-2">
    <div class="data-card">
        <div class="data-card-header">
            <div class="data-card-title"><i class="fas fa-globe"></i> Top Countries</div>
        </div>
        <div class="data-card-body">
            @foreach(['Canada' => 42, 'Australia' => 28, 'United Kingdom' => 18, 'Germany' => 8, 'New Zealand' => 4] as $country => $pct)
            <div style="display:flex;align-items:center;gap:12px;margin-bottom:14px;">
                <span style="font-size:13px;font-weight:500;width:140px;">{{ $country }}</span>
                <div style="flex:1;background:#f1f5f9;border-radius:50px;height:8px;overflow:hidden;">
                    <div style="width:{{ $pct }}%;height:100%;background:linear-gradient(90deg,#0B3D91,#00A4E4);border-radius:50px;"></div>
                </div>
                <span style="font-size:12px;color:var(--admin-muted);width:32px;text-align:right;">{{ $pct }}%</span>
            </div>
            @endforeach
        </div>
    </div>

    <div class="data-card">
        <div class="data-card-header">
            <div class="data-card-title"><i class="fas fa-share-alt"></i> Lead Sources</div>
        </div>
        <div class="data-card-body">
            @foreach(['Organic Search' => 38, 'Social Media' => 24, 'Direct' => 20, 'Referral' => 12, 'WhatsApp' => 6] as $src => $pct)
            <div style="display:flex;align-items:center;gap:12px;margin-bottom:14px;">
                <span style="font-size:13px;font-weight:500;width:140px;">{{ $src }}</span>
                <div style="flex:1;background:#f1f5f9;border-radius:50px;height:8px;overflow:hidden;">
                    <div style="width:{{ $pct }}%;height:100%;background:linear-gradient(90deg,#D4AF37,#f59e0b);border-radius:50px;"></div>
                </div>
                <span style="font-size:12px;color:var(--admin-muted);width:32px;text-align:right;">{{ $pct }}%</span>
            </div>
            @endforeach
        </div>
    </div>
</div>

<div class="data-card">
    <div class="data-card-header">
        <div class="data-card-title"><i class="fas fa-info-circle"></i> Connect Google Analytics</div>
    </div>
    <div class="data-card-body" style="text-align:center;padding:40px 20px;">
        <i class="fab fa-google" style="font-size:48px;color:#ea4335;margin-bottom:16px;display:block;"></i>
        <h3 style="margin-bottom:8px;color:var(--admin-text);">Connect Google Analytics</h3>
        <p style="color:var(--admin-muted);max-width:400px;margin:0 auto 20px;">Add your GA4 Measurement ID in Settings to see real-time analytics data here.</p>
        <a href="{{ route('admin.settings') }}" class="btn btn-primary"><i class="fas fa-cogs"></i> Go to Settings</a>
    </div>
</div>
@endsection
