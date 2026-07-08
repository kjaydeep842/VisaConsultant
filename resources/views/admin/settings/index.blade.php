@extends('admin.layout')
@section('title', 'Settings')

@section('content')
    <div class="admin-page-header">
        <div>
            <h1 class="admin-page-title">System Settings <small>Configure site details, contact info, and
                    integrations</small></h1>
        </div>
    </div>

    <div style="max-width:720px;">
        <div class="data-card" style="margin-bottom:20px;">
            <div class="data-card-header">
                <div class="data-card-title"><i class="fas fa-globe"></i> General Settings</div>
            </div>
            <div class="data-card-body">
                <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="admin-form-grid">
                        <div class="admin-form-group full"
                            style="display:flex; align-items:center; gap:20px; border-bottom:1px solid #e2e8f0; padding-bottom:20px; margin-bottom:15px;">
                            <div style="flex-shrink:0;">
                                <label style="display:block; margin-bottom:8px;"><i class="fas fa-image"
                                        style="color:var(--admin-secondary);margin-right:6px;"></i>Current Logo</label>
                                @if(isset($settings['company_logo']) && $settings['company_logo'])
                                    <div
                                        style="background:var(--admin-bg); padding:10px; border-radius:8px; border:1px solid #e2e8f0; display:inline-block;">
                                        <img src="{{ asset('storage/' . $settings['company_logo']) }}" alt="Company Logo"
                                            style="max-height:50px; display:block;">
                                    </div>
                                @else
                                    <div
                                        style="background:var(--admin-bg); width:80px; height:50px; border-radius:8px; border:1px dashed #cbd5e1; display:flex; align-items:center; justify-content:center; color:var(--admin-muted); font-size:11px;">
                                        No Logo
                                    </div>
                                @endif
                            </div>
                            <div style="flex-grow:1;">
                                <label style="display:block; margin-bottom:8px;">Upload Company Logo</label>
                                <input type="file" name="company_logo" class="admin-form-control" accept="image/*">
                                <small style="color:var(--admin-muted); display:block; margin-top:4px;">Supported formats:
                                    JPG, PNG, WEBP, SVG. Max size: 2MB.</small>
                            </div>
                        </div>

                        <div class="admin-form-group full">
                            <label><i class="fas fa-tag" style="color:var(--admin-secondary);margin-right:6px;"></i>Website
                                Name</label>
                            <input type="text" name="site_name" class="admin-form-control"
                                value="{{ $settings['site_name'] ?? 'NV Visa Consultancy' }}" required>
                        </div>
                        <div class="admin-form-group">
                            <label><i class="fas fa-envelope"
                                    style="color:var(--admin-secondary);margin-right:6px;"></i>Support Email</label>
                            <input type="email" name="support_email" class="admin-form-control"
                                value="{{ $settings['support_email'] ?? 'support@nvvisa.com' }}" required>
                        </div>
                        <div class="admin-form-group">
                            <label><i class="fas fa-phone"
                                    style="color:var(--admin-secondary);margin-right:6px;"></i>Contact Phone</label>
                            <input type="text" name="phone" class="admin-form-control"
                                value="{{ $settings['phone'] ?? '+91 98765 43210' }}">
                        </div>
                        <div class="admin-form-group full">
                            <label><i class="fas fa-map-marker-alt"
                                    style="color:var(--admin-secondary);margin-right:6px;"></i>Office Address</label>
                            <textarea name="address" class="admin-form-control"
                                rows="2">{{ $settings['address'] ?? '123, Visa Tower, Mumbai - 400001, India' }}</textarea>
                        </div>
                    </div>

                    <hr style="border:none;border-top:1px solid #e2e8f0;margin:20px 0;">
                    <h4 style="font-size:14px;font-weight:700;color:var(--admin-text);margin-bottom:16px;"><i
                            class="fas fa-key" style="color:var(--admin-secondary);margin-right:6px;"></i>API Integrations
                    </h4>

                    <div class="admin-form-grid">
                        <div class="admin-form-group">
                            <label>Stripe Public Key</label>
                            <input type="text" name="stripe_key" class="admin-form-control"
                                value="{{ $settings['stripe_key'] ?? '' }}" placeholder="pk_live_...">
                        </div>
                        <div class="admin-form-group">
                            <label>Google Analytics ID</label>
                            <input type="text" name="ga_id" class="admin-form-control"
                                value="{{ $settings['ga_id'] ?? '' }}" placeholder="G-XXXXXXXXXX">
                        </div>
                        <div class="admin-form-group">
                            <label>WhatsApp Number</label>
                            <input type="text" name="whatsapp" class="admin-form-control"
                                value="{{ $settings['whatsapp'] ?? '' }}" placeholder="918980751038">
                        </div>
                        <div class="admin-form-group">
                            <label>Facebook Pixel ID</label>
                            <input type="text" name="fb_pixel" class="admin-form-control"
                                value="{{ $settings['fb_pixel'] ?? '' }}" placeholder="XXXXXXXXXXXX">
                        </div>
                    </div>

                    <div style="margin-top:8px;">
                        <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Save All Settings</button>
                    </div>
                </form>
            </div>
        </div>

        {{-- Quick Info Cards --}}
        <div class="grid-3" style="margin-top:0;">
            <div class="data-card" style="margin-bottom:0;">
                <div class="data-card-body" style="text-align:center;">
                    <div style="font-size:28px;color:var(--admin-success);margin-bottom:8px;"><i
                            class="fas fa-check-circle"></i></div>
                    <div style="font-size:12px;color:var(--admin-muted);">System Status</div>
                    <strong style="font-size:16px;color:var(--admin-success);">Operational</strong>
                </div>
            </div>
            <div class="data-card" style="margin-bottom:0;">
                <div class="data-card-body" style="text-align:center;">
                    <div style="font-size:28px;color:var(--admin-primary);margin-bottom:8px;"><i
                            class="fas fa-code-branch"></i></div>
                    <div style="font-size:12px;color:var(--admin-muted);">Laravel Version</div>
                    <strong style="font-size:16px;">12.x</strong>
                </div>
            </div>
            <div class="data-card" style="margin-bottom:0;">
                <div class="data-card-body" style="text-align:center;">
                    <div style="font-size:28px;color:var(--admin-secondary);margin-bottom:8px;"><i
                            class="fas fa-shield-alt"></i></div>
                    <div style="font-size:12px;color:var(--admin-muted);">SSL Status</div>
                    <strong style="font-size:16px;color:var(--admin-secondary);">Active</strong>
                </div>
            </div>
        </div>
    </div>
@endsection