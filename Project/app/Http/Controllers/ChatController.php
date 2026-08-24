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
        // 1. Database-grounded Career & Domain Matching
        $allCareers = Career::all();
        $matchedCareer = null;

        // Direct Title or Domain match
        foreach ($allCareers as $career) {
            $t = strtolower($career->title);
            $d = strtolower($career->domain);
            $tokens = array_filter(explode(' ', str_replace(['-', '/', '&', 'and'], ' ', $t)));

            if (str_contains($queryLower, $t) || str_contains($queryLower, $d)) {
                $matchedCareer = $career;
                break;
            }

            foreach ($tokens as $token) {
                if (strlen($token) >= 4 && str_contains($queryLower, $token)) {
                    $matchedCareer = $career;
                    break 2;
                }
            }
        }

        // Domain keyword mappings
        if (!$matchedCareer) {
            if (str_contains($queryLower, 'full-stack') || str_contains($queryLower, 'fullstack') || str_contains($queryLower, 'frontend') || str_contains($queryLower, 'backend') || str_contains($queryLower, 'web dev')) {
                $matchedCareer = $allCareers->first(fn($c) => str_contains(strtolower($c->domain), 'web') || str_contains(strtolower($c->title), 'full-stack') || str_contains(strtolower($c->title), 'full stack'));
            } elseif (str_contains($queryLower, 'cloud') || str_contains($queryLower, 'devops') || str_contains($queryLower, 'aws') || str_contains($queryLower, 'kubernetes') || str_contains($queryLower, 'terraform') || str_contains($queryLower, 'docker')) {
                $matchedCareer = $allCareers->first(fn($c) => str_contains(strtolower($c->domain), 'cloud') || str_contains(strtolower($c->title), 'cloud') || str_contains(strtolower($c->title), 'devops'));
            } elseif (str_contains($queryLower, 'ai') || str_contains($queryLower, 'machine learning') || str_contains($queryLower, 'data science') || str_contains($queryLower, 'deep learning') || str_contains($queryLower, 'llm') || str_contains($queryLower, 'ml')) {
                $matchedCareer = $allCareers->first(fn($c) => str_contains(strtolower($c->domain), 'ai') || str_contains(strtolower($c->domain), 'data') || str_contains(strtolower($c->title), 'ai') || str_contains(strtolower($c->title), 'learning'));
            } elseif (str_contains($queryLower, 'security') || str_contains($queryLower, 'cyber') || str_contains($queryLower, 'hacker') || str_contains($queryLower, 'hacking') || str_contains($queryLower, 'soc')) {
                $matchedCareer = $allCareers->first(fn($c) => str_contains(strtolower($c->domain), 'security') || str_contains(strtolower($c->title), 'security') || str_contains(strtolower($c->title), 'cyber'));
            } elseif (str_contains($queryLower, 'design') || str_contains($queryLower, 'ui') || str_contains($queryLower, 'ux') || str_contains($queryLower, 'figma') || str_contains($queryLower, 'product design')) {
                $matchedCareer = $allCareers->first(fn($c) => str_contains(strtolower($c->domain), 'design') || str_contains(strtolower($c->title), 'design') || str_contains(strtolower($c->title), 'ui'));
            } elseif (str_contains($queryLower, 'mobile') || str_contains($queryLower, 'flutter') || str_contains($queryLower, 'ios') || str_contains($queryLower, 'android')) {
                $matchedCareer = $allCareers->first(fn($c) => str_contains(strtolower($c->domain), 'mobile') || str_contains(strtolower($c->title), 'mobile') || str_contains(strtolower($c->title), 'flutter') || str_contains(strtolower($c->title), 'ios'));
            } elseif (str_contains($queryLower, 'blockchain') || str_contains($queryLower, 'crypto') || str_contains($queryLower, 'smart contract') || str_contains($queryLower, 'solidity')) {
                $matchedCareer = $allCareers->first(fn($c) => str_contains(strtolower($c->domain), 'blockchain') || str_contains(strtolower($c->title), 'blockchain'));
            }
        }

        // If specific career matched from DB
        if ($matchedCareer) {
            $roadmapText = "";
            if (str_contains($queryLower, 'roadmap') || str_contains($queryLower, 'learn') || str_contains($queryLower, 'step') || str_contains($queryLower, 'start') || str_contains($queryLower, 'how')) {
                $roadmapText = "\n\n🗺️ **Recommended Roadmap Stages:**\n" .
                               "1. **Foundation:** CS core, Git & terminal workflows\n" .
                               "2. **Specialization:** Focus on {$matchedCareer->required_skills}\n" .
                               "3. **Production Project:** Deploy full-scale portfolio systems\n" .
                               "4. **Interview Readiness:** System architecture mock reviews";
            }

            return "🎯 **{$matchedCareer->title}** (`{$matchedCareer->domain}`)\n\n" .
                   "• 💰 **Compensation Benchmark:** {$matchedCareer->expected_salary}\n" .
                   "• 🛠️ **Required Core Skills:** {$matchedCareer->required_skills}\n" .
                   "• 📌 **Role Profile:** {$matchedCareer->description}" .
                   $roadmapText . "\n\n" .
                   "👉 [View Full {$matchedCareer->title} Interactive Roadmap](" . url('/careers/' . $matchedCareer->id) . ")";
        }

        // 2. Salary & Compensation Benchmarks
        if (str_contains($queryLower, 'salary') || str_contains($queryLower, 'salaries') || str_contains($queryLower, 'pay') || str_contains($queryLower, 'compensation') || str_contains($queryLower, 'earn') || str_contains($queryLower, 'money') || str_contains($queryLower, 'package')) {
            $topPaying = Career::take(4)->get();
            $list = [];
            foreach ($topPaying as $c) {
                $list[] = "• **{$c->title}**: `{$c->expected_salary}` ({$c->domain})";
            }
            return "💰 **2026 Tech Industry Verified Salary Telemetry**\n\n" .
                   implode("\n", $list) . "\n\n" .
                   "Explore all 15+ tracks with market salary ranges in our [Career Bank](" . url('/careers') . ").";
        }

        // 3. Roadmap & Learning Paths General Query
        if (str_contains($queryLower, 'roadmap') || str_contains($queryLower, 'roadmaps') || str_contains($queryLower, 'pathway') || str_contains($queryLower, 'trajectory') || str_contains($queryLower, 'milestone') || str_contains($queryLower, 'study')) {
            return "🗺️ **PathSeeker Living Roadmaps Architecture**\n\n" .
                   "Each career track on PathSeeker features a structured 4-stage competency journey:\n" .
                   "1. **Stage 1 (Foundation):** Algorithms, version control & Linux sysadmin\n" .
                   "2. **Stage 2 (Core Skills):** Domain frameworks, REST APIs & databases\n" .
                   "3. **Stage 3 (Production Projects):** CI/CD, microservices & live deployment\n" .
                   "4. **Stage 4 (Target Career Placement):** System design & offer negotiation\n\n" .
                   "👉 Pick your track in the [Career Bank](" . url('/careers') . ") to view its live roadmap!";
        }

        // 4. Trending & Highest-Demand Tech Roles
        if (str_contains($queryLower, 'demand') || str_contains($queryLower, 'top role') || str_contains($queryLower, 'best role') || str_contains($queryLower, 'trending') || str_contains($queryLower, 'future') || str_contains($queryLower, 'recommend') || str_contains($queryLower, 'growth')) {
            return "🚀 **Top High-Growth Tech Engineering Tracks (2026 Telemetry):**\n\n" .
                   "1. **Cloud Solutions Architecture** — Hybrid VPCs, Kubernetes, multi-cloud resiliency\n" .
                   "2. **AI & Generative Systems Engineering** — Transformers, PyTorch, LLMOps pipelines\n" .
                   "3. **Cybersecurity & Threat Hunting** — Zero Trust, perimeter hardening, SIEM\n" .
                   "4. **Full-Stack Platform Engineering** — Modern reactive stacks + microservices\n\n" .
                   "Discover which track matches your unique skills with our [Interest Quiz](" . url('/quiz') . ")!";
        }

        // 5. Cognitive Quiz & Assessment Queries
        if (str_contains($queryLower, 'quiz') || str_contains($queryLower, 'assessment') || str_contains($queryLower, 'test') || str_contains($queryLower, 'match') || str_contains($queryLower, 'fit') || str_contains($queryLower, 'which career') || str_contains($queryLower, 'what should i do')) {
            return "🧠 **Cognitive Career Strengths Assessment**\n\n" .
                   "Take our 10-question multidimensional evaluation to assess your technical preferences, system thinking, and problem-solving aptitude.\n\n" .
                   "👉 [Start 5-Minute Assessment Now](" . url('/quiz') . ")";
        }

        // 6. Downloadable Toolkits & PDFs
        if (str_contains($queryLower, 'resource') || str_contains($queryLower, 'toolkit') || str_contains($queryLower, 'cheat sheet') || str_contains($queryLower, 'cheatsheet') || str_contains($queryLower, 'pdf') || str_contains($queryLower, 'download') || str_contains($queryLower, 'book') || str_contains($queryLower, 'doc')) {
            return "📂 **Resource Library & Engineering Toolkits**\n\n" .
                   "Access 15+ verified, downloadable toolkits including:\n" .
                   "• Enterprise React 19 & Next.js Architecture Blueprints\n" .
                   "• AWS Certified Solutions Architect Cheat Sheets\n" .
                   "• Docker & Production Kubernetes Playbooks\n" .
                   "• High-Throughput System Design Interview Cheatsheets\n\n" .
                   "👉 [Browse & Download Toolkits](" . url('/resources') . ")";
        }

        // 7. Video Masterclasses & Multimedia
        if (str_contains($queryLower, 'video') || str_contains($queryLower, 'multimedia') || str_contains($queryLower, 'masterclass') || str_contains($queryLower, 'watch') || str_contains($queryLower, 'stream') || str_contains($queryLower, 'podcast') || str_contains($queryLower, 'youtube')) {
            return "🎬 **HD Multimedia Masterclasses**\n\n" .
                   "Stream 16 engineering masterclasses with live YouTube embed streams covering Cloud, Full-Stack, AI/ML, Ethical Hacking, Flutter, and Golang.\n\n" .
                   "👉 [Explore Multimedia Center](" . url('/multimedia') . ")";
        }

        // 8. Interview Prep & Resume Strategy
        if (str_contains($queryLower, 'resume') || str_contains($queryLower, 'interview') || str_contains($queryLower, 'portfolio') || str_contains($queryLower, 'cv') || str_contains($queryLower, 'job') || str_contains($queryLower, 'hire')) {
            return "💼 **Tech Interview & Career Strategy Guide**\n\n" .
                   "• **Impact Resumes:** Use the Google XYZ formula: *Accomplished [X] as measured by [Y], by doing [Z]*.\n" .
                   "• **System Architecture:** Master CAP theorem, sharding, caching, and rate limiting.\n" .
                   "• **Templates:** Grab verified resume templates in our [Resource Library](" . url('/resources') . ").";
        }

        // 9. Greetings & Help
        if (str_contains($queryLower, 'hello') || str_contains($queryLower, 'hi') || str_contains($queryLower, 'hey') || $queryLower === 'help' || str_contains($queryLower, 'who are you')) {
            return "👋 **Hello! I am your PathSeeker AI Career Navigator.**\n\n" .
                   "I can help you with:\n" .
                   "• Comparing tech roles, salaries, and required toolchains\n" .
                   "• Finding custom roadmaps for Full-Stack, Cloud, AI, Security, or Mobile\n" .
                   "• Recommending verified PDF cheatsheets, masterclasses, and skill quizzes\n\n" .
                   "What tech field or career goal would you like to explore?";
        }

        // 10. Intelligent General Fallback
        return "✨ **Career Intelligence Telemetry**\n\n" .
               "I'm ready to guide your tech career journey! You can ask me:\n" .
               "• *'What are the salary benchmarks for Full-Stack vs Cloud?'*\n" .
               "• *'Show me the AI Engineering roadmap'* \n" .
               "• *'What skills are needed for Cybersecurity?'*\n" .
               "• *'Where can I download system design cheatsheets?'*\n\n" .
               "Or take our 5-minute [Interest Quiz](" . url('/quiz') . ") for tailored recommendations!";
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
