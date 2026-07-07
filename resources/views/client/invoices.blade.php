@extends('layouts.app')
@section('title', 'Receipts & Invoices')

@section('content')
<section class="page-header" style="padding: 40px 0;">
    <div class="container" style="display:flex; justify-content:space-between; align-items:center; flex-wrap:wrap; gap:15px; text-align:left;">
        <div>
            <h1 style="font-size:28px; margin:0;">Invoices & Billing</h1>
            <p style="color:rgba(255,255,255,0.7); margin:0;">View your payment invoices, receipts, and outstanding dues.</p>
        </div>
        <div>
            <a href="{{ route('client.dashboard') }}" class="btn-topbar"><i class="fas fa-arrow-left"></i> Back to Dashboard</a>
        </div>
    </div>
</section>

<section class="section-padding bg-light">
    <div class="container">
        <div style="display:grid; grid-template-columns: 280px 1fr; gap:30px; align-items:flex-start;">
            
            <!-- Dashboard Sidebar -->
            <div class="form-card" style="padding: 20px;">
                <h4 style="margin-bottom:15px; font-size:14px; text-transform:uppercase; color:var(--text-muted);">Client Menu</h4>
                <ul style="list-style:none; padding:0; display:flex; flex-direction:column; gap:10px;">
                    <li>
                        <a href="{{ route('client.dashboard') }}" style="display:flex; align-items:center; gap:10px; padding:10px 15px; border-radius:8px;">
                            <i class="fas fa-chart-line"></i> Dashboard Overview
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('client.applications') }}" style="display:flex; align-items:center; gap:10px; padding:10px 15px; border-radius:8px;">
                            <i class="fas fa-folder-open"></i> My Applications
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('client.appointments') }}" style="display:flex; align-items:center; gap:10px; padding:10px 15px; border-radius:8px;">
                            <i class="fas fa-calendar-alt"></i> My Appointments
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('client.documents') }}" style="display:flex; align-items:center; gap:10px; padding:10px 15px; border-radius:8px;">
                            <i class="fas fa-file-signature"></i> Uploaded Documents
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('client.invoices') }}" style="display:flex; align-items:center; gap:10px; padding:10px 15px; background:rgba(11, 61, 145, 0.05); color:var(--primary-color); border-radius:8px; font-weight:600;">
                            <i class="fas fa-file-invoice-dollar"></i> Receipts & Invoices
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('client.profile') }}" style="display:flex; align-items:center; gap:10px; padding:10px 15px; border-radius:8px;">
                            <i class="fas fa-user-cog"></i> Account Settings
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Content Area -->
            <div class="form-card">
                <h3>Billing & Payments Ledger</h3>
                <p style="color:var(--text-muted); font-size:14px; margin-bottom:25px;">Pay outstanding dues securely using credit card, UPI or NetBanking via Stripe / Razorpay.</p>

                <div style="overflow-x:auto;">
                    <table style="width:100%; border-collapse:collapse; text-align:left;">
                        <thead>
                            <tr style="border-bottom:2px solid var(--border-color);">
                                <th style="padding:12px;">Invoice #</th>
                                <th style="padding:12px;">Amount</th>
                                <th style="padding:12px;">Due Date</th>
                                <th style="padding:12px;">Status</th>
                                <th style="padding:12px;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($invoices as $inv)
                            <tr style="border-bottom:1px solid var(--border-color);">
                                <td style="padding:12px;"><strong>{{ $inv->invoice_number }}</strong></td>
                                <td style="padding:12px;">${{ number_format($inv->total, 2) }}</td>
                                <td style="padding:12px;">{{ $inv->due_date ? $inv->due_date->format('d M Y') : 'N/A' }}</td>
                                <td style="padding:12px;">
                                    <span class="btn-topbar" style="background:@if($inv->status == 'paid') #1e7e34 @else #dc3545 @endif; border-radius:4px; font-size:12px; padding:2px 8px;">
                                        {{ strtoupper($inv->status) }}
                                    </span>
                                </td>
                                <td style="padding:12px;">
                                    @if($inv->status == 'unpaid')
                                        <a href="#" class="btn-outline-sm" style="padding:4px 8px; font-size:12px;">Pay Now</a>
                                    @else
                                        <a href="#" style="color:var(--primary-color);"><i class="fas fa-file-pdf"></i> Download</a>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" style="padding:20px; text-align:center; color:var(--text-muted);">
                                    You have no invoices or receipts.
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</section>
@endsection
