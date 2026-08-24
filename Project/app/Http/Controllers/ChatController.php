<?php

namespace App\Http\Controllers;

use App\Models\Career;
use App\Models\Multimedia;
use App\Models\Resource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ChatController extends Controller
{
    /**
     * Handle incoming real-time chatbot messages.
     */
    public function sendMessage(Request $request)
    {
        $validated = $request->validate([
            'message' => 'required|string|max:1000',
        ]);

        $userMessage = trim($validated['message']);
        $queryLower = strtolower($userMessage);

        // Check if external Gemini / OpenAI API key is set
        $geminiKey = config('services.gemini.key') ?? env('GEMINI_API_KEY');
        if ($geminiKey) {
            try {
                $aiResponse = $this->callGeminiApi($userMessage, $geminiKey);
                if ($aiResponse) {
                    return response()->json([
                        'status' => 'success',
                        'reply' => $aiResponse,
                        'source' => 'gemini-ai',
                    ]);
                }
            } catch (\Exception $e) {
                Log::warning('Gemini Chatbot API error: ' . $e->getMessage());
            }
        }

        // Real-Time Intelligent Platform Career Intelligence Engine
        $reply = $this->generateIntelligentResponse($queryLower, $userMessage);

        return response()->json([
            'status' => 'success',
            'reply' => $reply,
            'source' => 'pathseeker-engine',
        ]);
    }

    /**
     * Generate dynamic contextual intelligence from platform database.
     */
    protected function generateIntelligentResponse(string $queryLower, string $rawMessage): string
    {
        // 1. Check for specific Career matches in database
        $careers = Career::all();
        $matchedCareers = [];

        foreach ($careers as $career) {
            $titleLower = strtolower($career->title);
            $domainLower = strtolower($career->domain);

            if (
                str_contains($queryLower, $titleLower) ||
                str_contains($queryLower, $domainLower) ||
                str_contains($queryLower, strtolower(explode(' ', $career->title)[0])) ||
                (strlen($career->domain) > 3 && str_contains($queryLower, $domainLower))
            ) {
                $matchedCareers[] = $career;
            }
        }

        // If specific career(s) found
        if (!empty($matchedCareers)) {
            $career = $matchedCareers[0];
            return "🎯 **{$career->title} ({$career->domain})**\n\n" .
                   "• **Expected Compensation:** {$career->expected_salary}\n" .
                   "• **Key Required Skills:** {$career->required_skills}\n" .
                   "• **Trajectory:** {$career->description}\n\n" .
                   "👉 Explore the full roadmap: [View {$career->title} Blueprint](" . url('/careers/' . $career->id) . ")";
        }

        // 2. High-demand / Top roles / Salary queries
        if (str_contains($queryLower, 'salary') || str_contains($queryLower, 'salaries') || str_contains($queryLower, 'pay') || str_contains($queryLower, 'compensation') || str_contains($queryLower, 'highest paying')) {
            $topPaying = Career::orderBy('id')->take(4)->get();
            $list = [];
            foreach ($topPaying as $c) {
                $list[] = "• **{$c->title}**: {$c->expected_salary} ({$c->domain})";
            }
            return "💰 **2026 Tech Industry Compensation Benchmarks**\n\n" .
                   implode("\n", $list) . "\n\n" .
                   "Filter all roles with verified pay bands in our [Career Bank](" . url('/careers') . ").";
        }

        // 3. Demand / Top Roles / Recommendations
        if (str_contains($queryLower, 'demand') || str_contains($queryLower, 'top role') || str_contains($queryLower, 'best role') || str_contains($queryLower, 'trending') || str_contains($queryLower, 'future')) {
            return "🚀 **Top High-Growth Tech Pathways for 2026:**\n\n" .
                   "1. **Cloud Solutions Architecture** — Hybrid VPCs, Kubernetes, multi-cloud resiliency.\n" .
                   "2. **AI & Generative Systems Engineering** — Transformers, PyTorch, LLMOps pipelines.\n" .
                   "3. **Cybersecurity & Threat Hunting** — Zero Trust, perimeter hardening, SIEM.\n" .
                   "4. **Full-Stack Platform Engineering** — Laravel/Node backend + Vue/React reactivity.\n\n" .
                   "Take our [Interest Quiz](" . url('/quiz') . ") to evaluate your profile alignment!";
        }

        // 4. Interest Quiz / Assessment inquiries
        if (str_contains($queryLower, 'quiz') || str_contains($queryLower, 'assessment') || str_contains($queryLower, 'test') || str_contains($queryLower, 'match') || str_contains($queryLower, 'fit')) {
            return "🧠 **Cognitive Career Assessment**\n\n" .
                   "Our 10-dimension evaluation analyzes your problem-solving style, preferred tech stack, and systems thinking to calculate your exact affinity score.\n\n" .
                   "👉 [Start 5-Minute Assessment Now](" . url('/quiz') . ")";
        }

        // 5. Toolkits / Cheat Sheets / Resources
        if (str_contains($queryLower, 'resource') || str_contains($queryLower, 'toolkit') || str_contains($queryLower, 'cheat sheet') || str_contains($queryLower, 'pdf') || str_contains($queryLower, 'download') || str_contains($queryLower, 'book')) {
            return "📂 **Resource Library & Blueprints**\n\n" .
                   "We provide 15 verified downloadable toolkits including:\n" .
                   "• Next.js & React 15 Enterprise Architecture\n" .
                   "• AWS Certified Solutions Architect Cheat Sheets\n" .
                   "• Kubernetes & Docker Production Playbooks\n" .
                   "• System Design & High-Throughput Interview Guides\n\n" .
                   "👉 [Browse Resource Library](" . url('/resources') . ")";
        }

        // 6. Video Masterclasses / Multimedia
        if (str_contains($queryLower, 'video') || str_contains($queryLower, 'multimedia') || str_contains($queryLower, 'masterclass') || str_contains($queryLower, 'watch') || str_contains($queryLower, 'stream') || str_contains($queryLower, 'podcast')) {
            return "🎬 **HD Multimedia Masterclasses**\n\n" .
                   "Stream 16 engineering masterclasses covering Full-Stack, AWS Cloud, AI/ML, Ethical Hacking, Flutter, and Golang with verified embed streams.\n\n" .
                   "👉 [Explore Multimedia Center](" . url('/multimedia') . ")";
        }

        // 7. Resume / Interview Prep
        if (str_contains($queryLower, 'resume') || str_contains($queryLower, 'interview') || str_contains($queryLower, 'portfolio') || str_contains($queryLower, 'cv') || str_contains($queryLower, 'job')) {
            return "💼 **Tech Interview & Career Transition Strategy**\n\n" .
                   "• **Resume:** Quantify impact (e.g., 'Reduced latency by 35% with Redis caching').\n" .
                   "• **System Design:** Focus on CAP theorem, database sharding, and event-driven queues.\n" .
                   "• **Toolkits:** Grab our ATS-optimized templates in the [Resource Library](" . url('/resources') . ").";
        }

        // 8. Greetings
        if (str_contains($queryLower, 'hello') || str_contains($queryLower, 'hi') || str_contains($queryLower, 'hey') || $queryLower === 'help') {
            return "👋 Hello! I am your PathSeeker AI Career Navigator.\n\n" .
                   "I can assist you with:\n" .
                   "• Finding the right career track and salary expectations\n" .
                   "• Recommending specific required skills and learning paths\n" .
                   "• Connecting you with verified toolkits, cheat sheets, and masterclasses\n\n" .
                   "What tech domain or career goal are you exploring today?";
        }

        // Default intelligent fallback
        return "✨ Great inquiry! Based on PathSeeker's 2026 telemetry:\n\n" .
               "I recommend checking our [Career Bank](" . url('/careers') . ") to filter through 15+ engineering tracks, or take the [Interest Assessment](" . url('/quiz') . ") for personalized score matching.\n\n" .
               "Feel free to ask about specific stacks (e.g. *'Full-Stack'*, *'Cloud Architecture'*, *'AI Engineering'*, *'Cybersecurity'*), salaries, or downloadable blueprints!";
    }

    /**
     * Optional Gemini API integration if key exists.
     */
    protected function callGeminiApi(string $prompt, string $apiKey): ?string
    {
        $url = "https://generativelanguage.googleapis.com/v1beta/models/gemini-1.5-flash:generateContent?key=" . $apiKey;

        $systemInstruction = "You are the AI Career Guide for PathSeeker, a cutting-edge 2026 tech career navigation platform. Be concise, highly encouraging, authoritative, and provide actionable career guidance, salary benchmarks, and tech stack advice.";

        $response = Http::timeout(5)->post($url, [
            'contents' => [
                [
                    'role' => 'user',
                    'parts' => [
                        ['text' => $systemInstruction . "\n\nUser Question: " . $prompt]
                    ]
                ]
            ]
        ]);

        if ($response->successful()) {
            $data = $response->json();
            return $data['candidates'][0]['content']['parts'][0]['text'] ?? null;
        }

        return null;
    }
}
