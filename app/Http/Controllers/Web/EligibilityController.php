<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Lead;
use Illuminate\Http\Request;

class EligibilityController extends Controller
{
    public function index()
    {
        return view('web.eligibility');
    }

    public function calculate(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|string',
            'age' => 'required|integer|min:18|max:65',
            'education' => 'required|string',
            'experience' => 'required|integer|min:0',
            'english_score' => 'nullable|numeric|min:0|max:9',
            'country' => 'required|string',
            'occupation' => 'nullable|string',
            'budget' => 'nullable|numeric',
            'family_members' => 'nullable|integer',
        ]);

        $score = $this->calculateScore($request->all());
        $recommendation = $this->getRecommendation($score, $request->country);

        // Save as lead
        $lead = Lead::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'age' => $request->age,
            'education' => $request->education,
            'experience_years' => $request->experience,
            'english_score' => $request->english_score,
            'country_interested' => $request->country,
            'occupation' => $request->occupation,
            'budget' => $request->budget,
            'family_members' => $request->family_members,
            'eligibility_score' => $score,
            'source' => 'eligibility_checker',
        ]);

        return view('web.eligibility-result', compact('score', 'recommendation', 'lead', 'request'));
    }

    private function calculateScore(array $data): int
    {
        $score = 0;

        // Age points (max 30)
        $age = (int) $data['age'];
        if ($age >= 18 && $age <= 30) $score += 30;
        elseif ($age >= 31 && $age <= 35) $score += 25;
        elseif ($age >= 36 && $age <= 40) $score += 15;
        elseif ($age >= 41 && $age <= 45) $score += 10;
        else $score += 5;

        // Education points (max 25)
        $educationMap = [
            'phd' => 25, 'masters' => 23, 'bachelors' => 21,
            'diploma' => 15, 'high_school' => 10, 'other' => 5,
        ];
        $score += $educationMap[$data['education']] ?? 10;

        // Experience points (max 21)
        $exp = (int) $data['experience'];
        if ($exp >= 6) $score += 21;
        elseif ($exp >= 4) $score += 15;
        elseif ($exp >= 2) $score += 10;
        elseif ($exp >= 1) $score += 5;

        // English score (max 24)
        $english = (float) ($data['english_score'] ?? 0);
        if ($english >= 8) $score += 24;
        elseif ($english >= 7) $score += 20;
        elseif ($english >= 6) $score += 16;
        elseif ($english >= 5) $score += 10;
        elseif ($english > 0) $score += 5;

        return min($score, 100);
    }

    private function getRecommendation(int $score, string $country): array
    {
        if ($score >= 70) {
            return [
                'level' => 'Excellent',
                'color' => 'green',
                'message' => "Congratulations! You have an excellent eligibility score of {$score}/100 for {$country}. Our consultants will contact you immediately.",
                'visa_types' => ['Permanent Residency', 'Skilled Worker Visa', 'Express Entry'],
                'recommended_action' => 'Book a Free Consultation',
            ];
        } elseif ($score >= 50) {
            return [
                'level' => 'Good',
                'color' => 'blue',
                'message' => "You have a good eligibility score of {$score}/100. With some preparation, you can significantly improve your chances.",
                'visa_types' => ['Work Permit', 'Visitor Visa', 'Student Visa'],
                'recommended_action' => 'Book a Consultation',
            ];
        } elseif ($score >= 30) {
            return [
                'level' => 'Fair',
                'color' => 'yellow',
                'message' => "Your eligibility score is {$score}/100. Our experts can help you identify the best pathway for immigration.",
                'visa_types' => ['Student Visa', 'Visitor Visa', 'Dependent Visa'],
                'recommended_action' => 'Speak with an Expert',
            ];
        } else {
            return [
                'level' => 'Needs Improvement',
                'color' => 'red',
                'message' => "Your current eligibility score is {$score}/100. Our consultants can guide you on how to improve your profile.",
                'visa_types' => ['Tourist Visa', 'Visitor Visa'],
                'recommended_action' => 'Get Free Advice',
            ];
        }
    }
}
