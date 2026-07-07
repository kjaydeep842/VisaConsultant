<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Country;
use App\Models\VisaCategory;
use App\Models\Lead;
use App\Models\Appointment;
use App\Models\Application;
use App\Models\ApplicationTimeline;
use App\Models\ApplicationDocument;
use App\Models\Blog;
use App\Models\Faq;
use App\Models\Setting;
use App\Models\Invoice;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Roles and Permissions
        $roles = ['superadmin', 'admin', 'consultant', 'client'];
        foreach ($roles as $roleName) {
            Role::firstOrCreate(['name' => $roleName, 'guard_name' => 'web']);
        }

        // 2. Default Users
        $adminUser = User::firstOrCreate(
            ['email' => 'admin@nvvisa.com'],
            [
                'name' => 'Aditya Sharma',
                'phone' => '+919876543210',
                'password' => Hash::make('password123'),
                'role' => 'admin',
                'email_verified_at' => now(),
            ]
        );
        $adminUser->assignRole('admin');

        $consultantUser = User::firstOrCreate(
            ['email' => 'consultant@nvvisa.com'],
            [
                'name' => 'Sarah Jenkins (RCIC)',
                'phone' => '+919876543211',
                'password' => Hash::make('password123'),
                'role' => 'consultant',
                'email_verified_at' => now(),
            ]
        );
        $consultantUser->assignRole('consultant');

        $clientUser = User::firstOrCreate(
            ['email' => 'client@nvvisa.com'],
            [
                'name' => 'Rahul Verma',
                'phone' => '+919876543212',
                'password' => Hash::make('password123'),
                'role' => 'client',
                'email_verified_at' => now(),
            ]
        );
        $clientUser->assignRole('client');

        // 3. Countries
        $countriesData = [
            ['name' => 'Canada', 'code' => 'CA', 'slug' => 'canada', 'overview' => 'Canada offers Express Entry and provincial programs for skilled professionals.', 'is_active' => true],
            ['name' => 'Australia', 'code' => 'AU', 'slug' => 'australia', 'overview' => 'Australia GSM subclass 189, 190, 491 provide great migration pathways.', 'is_active' => true],
            ['name' => 'United Kingdom', 'code' => 'GB', 'slug' => 'united-kingdom', 'overview' => 'UK Skilled Worker Visa is a points-based system for professional migration.', 'is_active' => true],
            ['name' => 'Germany', 'code' => 'DE', 'slug' => 'germany', 'overview' => 'Germany Opportunity Card (Chancenkarte) allows job seekers to enter and find work.', 'is_active' => true],
            ['name' => 'USA', 'code' => 'US', 'slug' => 'usa', 'overview' => 'USA EB-5 Investor Visa, H-1B, and L-1 work permits for corporate migration.', 'is_active' => true],
            ['name' => 'New Zealand', 'code' => 'NZ', 'slug' => 'new-zealand', 'overview' => 'New Zealand offers skilled migration and study pathways.', 'is_active' => true],
            ['name' => 'Ireland', 'code' => 'IE', 'slug' => 'ireland', 'overview' => 'Ireland has excellent opportunities for tech and healthcare workers.', 'is_active' => true],
            ['name' => 'UAE', 'code' => 'AE', 'slug' => 'uae', 'overview' => 'UAE offers Golden Visa and corporate work permit streams.', 'is_active' => true],
        ];

        foreach ($countriesData as $c) {
            Country::withTrashed()->updateOrCreate(['slug' => $c['slug']], $c)->restore();
        }

        // 4. Visa Categories
        $visaCategories = [
            ['name' => 'Permanent Residency', 'slug' => 'permanent-residency', 'description' => 'Immigrate permanently with full work and citizenship rights.', 'icon' => 'fa-home', 'is_active' => true],
            ['name' => 'Study Permit', 'slug' => 'student-visa', 'description' => 'Enroll in world-class international colleges and universities.', 'icon' => 'fa-graduation-cap', 'is_active' => true],
            ['name' => 'Work Visa', 'slug' => 'work-permit', 'description' => 'Legal permit to work for designated foreign employers.', 'icon' => 'fa-briefcase', 'is_active' => true],
            ['name' => 'Visitor Visa', 'slug' => 'visitor-visa', 'description' => 'Travel for tourism, leisure or short-term family visits.', 'icon' => 'fa-passport', 'is_active' => true],
            ['name' => 'Business Visa', 'slug' => 'business-visa', 'description' => 'Expand your business globally.', 'icon' => 'fa-handshake', 'is_active' => true],
            ['name' => 'Investor Visa', 'slug' => 'investor-visa', 'description' => 'Invest and gain residency.', 'icon' => 'fa-chart-line', 'is_active' => true],
            ['name' => 'Family Sponsorship', 'slug' => 'family-sponsorship', 'description' => 'Reunite with your loved ones.', 'icon' => 'fa-users', 'is_active' => true],
            ['name' => 'Citizenship', 'slug' => 'citizenship', 'description' => 'Become a citizen of your dream country.', 'icon' => 'fa-flag', 'is_active' => true],
            ['name' => 'Tourist Visa', 'slug' => 'tourist-visa', 'description' => 'Travel the world freely.', 'icon' => 'fa-plane', 'is_active' => true],
        ];

        foreach ($visaCategories as $vc) {
            VisaCategory::withTrashed()->updateOrCreate(['slug' => $vc['slug']], $vc)->restore();
        }

        // 5. Leads
        $leadsData = [
            ['name' => 'Priya Patel', 'email' => 'priya@gmail.com', 'phone' => '+919998887771', 'country_interested' => 'Canada', 'visa_type' => 'Permanent Residency', 'status' => 'new', 'source' => 'web_form'],
            ['name' => 'Amit Kumar', 'email' => 'amit@gmail.com', 'phone' => '+919998887772', 'country_interested' => 'Australia', 'visa_type' => 'Work Visa', 'status' => 'contacted', 'source' => 'google_ads'],
            ['name' => 'Neha Singh', 'email' => 'neha@gmail.com', 'phone' => '+919998887773', 'country_interested' => 'United Kingdom', 'visa_type' => 'Study Permit', 'status' => 'qualified', 'source' => 'facebook_ads'],
        ];

        foreach ($leadsData as $ld) {
            $ld['assigned_to'] = $consultantUser->id;
            Lead::firstOrCreate(['email' => $ld['email']], $ld);
        }

        // 6. Active Applications
        $canada = Country::where('slug', 'canada')->first();
        $pr = VisaCategory::where('slug', 'permanent-residency')->first();

        $app = Application::firstOrCreate(
            ['application_id' => 'NV20260001'],
            [
                'user_id' => $clientUser->id,
                'country_id' => $canada->id,
                'visa_category_id' => $pr->id,
                'applicant_name' => $clientUser->name,
                'passport_number' => 'Z9876543',
                'status' => 'under_review',
                'submission_date' => now()->subDays(15),
                'expected_completion' => now()->addDays(90),
            ]
        );

        // Timeline Stages
        ApplicationTimeline::firstOrCreate(
            ['application_id' => $app->id, 'stage' => 'Profile Assessment'],
            [
                'description' => 'Profile eligibility criteria successfully vetted and approved.',
                'completed_at' => now()->subDays(14),
            ]
        );

        ApplicationTimeline::firstOrCreate(
            ['application_id' => $app->id, 'stage' => 'Document Accumulation'],
            [
                'description' => 'Client submitted transcripts, IELTS scorecard, and proof of funds.',
                'completed_at' => now()->subDays(10),
            ]
        );

        ApplicationTimeline::firstOrCreate(
            ['application_id' => $app->id, 'stage' => 'Embassy Submission'],
            [
                'description' => 'Case file sent to Immigration, Refugees and Citizenship Canada (IRCC).',
                'completed_at' => now()->subDays(2),
            ]
        );

        // Documents
        ApplicationDocument::firstOrCreate(
            ['application_id' => $app->id, 'name' => 'Passport Bio Page'],
            [
                'type' => 'passport',
                'file_path' => 'docs/passport.pdf',
                'original_name' => 'passport.pdf',
                'status' => 'approved',
            ]
        );

        ApplicationDocument::firstOrCreate(
            ['application_id' => $app->id, 'name' => 'IELTS Test Report Form'],
            [
                'type' => 'ielts',
                'file_path' => 'docs/ielts.pdf',
                'original_name' => 'ielts.pdf',
                'status' => 'approved',
            ]
        );

        // Invoices
        Invoice::firstOrCreate(
            ['invoice_number' => 'NV-INV-2026-0001'],
            [
                'user_id' => $clientUser->id,
                'subtotal' => 1500.00,
                'tax' => 270.00,
                'total' => 1770.00,
                'status' => 'paid',
                'due_date' => now()->subDays(10),
            ]
        );

        // 7. Appointments
        Appointment::firstOrCreate(
            ['booking_ref' => 'NV-APT-2026-0001'],
            [
                'user_id' => $clientUser->id,
                'consultant_id' => $consultantUser->id,
                'client_name' => $clientUser->name,
                'client_email' => $clientUser->email,
                'client_phone' => $clientUser->phone,
                'appointment_date' => today()->addDays(2),
                'appointment_time' => '10:00:00',
                'meeting_type' => 'online_meet',
                'branch' => 'Virtual Branch',
                'purpose' => 'Discuss IELTS ECA scorecard submission requirements.',
                'status' => 'confirmed',
            ]
        );

        // 8. Blogs
        Blog::firstOrCreate(
            ['slug' => 'canada-express-entry-draw-2026'],
            [
                'title' => 'Canada Express Entry Draw Updates for 2026',
                'featured_image' => 'https://picsum.photos/400/250',
                'content' => 'IRCC releases new target metrics for skilled federal draws with major focus on healthcare and tech workers.',
                'author_id' => $adminUser->id,
                'status' => 'published',
                'published_at' => now(),
            ]
        );

        // 9. FAQs
        Faq::firstOrCreate(
            ['question' => 'What is the minimum score required for Canada PR?'],
            [
                'answer' => 'A minimum score of 67 points under the Federal Skilled Worker program is required to enter the Express Entry pool.',
                'category' => 'Canada Visa',
            ]
        );

        // 10. Settings
        Setting::firstOrCreate(
            ['key' => 'site_name'],
            ['value' => 'NV Visa Consultancy']
        );
        Setting::firstOrCreate(
            ['key' => 'support_email'],
            ['value' => 'support@nvvisa.com']
        );

        // 11. Team Members
        \App\Models\TeamMember::firstOrCreate(
            ['email' => 'sarah.j@nvvisa.com'],
            [
                'name' => 'Sarah Jenkins',
                'designation' => 'Managing Director & RCIC Counsel',
                'bio' => 'Sarah has over 15 years of experience in Canadian and European immigration law.',
                'specialization' => 'Canada Express Entry, Business Visas',
                'is_active' => true,
            ]
        );

        \App\Models\TeamMember::firstOrCreate(
            ['email' => 'marcus.a@nvvisa.com'],
            [
                'name' => 'Marcus Aurelius',
                'designation' => 'Senior Australia MARA Counselor',
                'bio' => 'Marcus is an expert on Australia Skilled Graduate & GSM pathway subclass streams.',
                'specialization' => 'Australia Subclass 189/190/491',
                'is_active' => true,
            ]
        );

        // 12. Testimonials
        \App\Models\Testimonial::firstOrCreate(
            ['client_name' => 'Rohan Sen'],
            [
                'client_designation' => 'Software Engineer at Amazon',
                'country_approved' => 'Canada',
                'visa_type' => 'Express Entry PR',
                'testimonial' => 'NV Visa Consultancy managed my Express Entry profile seamlessly. Their documentation checklist is incredibly detailed.',
                'rating' => 5,
                'is_featured' => true,
                'is_active' => true,
            ]
        );

        \App\Models\Testimonial::firstOrCreate(
            ['client_name' => 'Meera Nair'],
            [
                'client_designation' => 'MBA Student at Melbourne Business School',
                'country_approved' => 'Australia',
                'visa_type' => 'Student subclass 500',
                'testimonial' => 'Outstanding guidance! Got my student visa and post-graduation options cleared in a single session.',
                'rating' => 5,
                'is_featured' => true,
                'is_active' => true,
            ]
        );

        // 13. News
        \App\Models\News::firstOrCreate(
            ['slug' => 'uk-skilled-worker-visa-salary-thresholds-2026'],
            [
                'title' => 'UK Skilled Worker Visa Updates: New Salary Thresholds Announced for 2026',
                'excerpt' => 'The Home Office has introduced revised salary thresholds for the Skilled Worker visa stream, impacting new applicants starting this quarter.',
                'content' => 'The UK Government has officially updated its immigration guidance, lifting the minimum salary requirements for foreign skilled laborers entering the UK under the points-based system. Prospective applicants must meet the new criteria unless they qualify under specific exemption clauses such as healthcare professionals or designated shortage list categories. Consultation with our MARA and OISC certified team is highly recommended.',
                'status' => 'published',
                'published_at' => now()->subDays(3),
                'is_featured' => true,
            ]
        );

        \App\Models\News::firstOrCreate(
            ['slug' => 'australia-subclass-491-state-sponsorship-quotas'],
            [
                'title' => 'Australia Subclass 491 Regional Sponsorship Quotas Opened',
                'excerpt' => 'State departments have released the sponsorship allocations for regional visa streams, marking a huge opportunity for off-shore candidates.',
                'content' => 'State nominations for Australia Subclass 491 regional work permits have commenced. Quotas have seen a marginal rise compared to previous years, prioritizing candidates with healthcare, construction, and engineering backgrounds. Reach out to our regional counselors to check your EOI points calculation.',
                'status' => 'published',
                'published_at' => now()->subDays(5),
                'is_featured' => false,
            ]
        );
    }
}
