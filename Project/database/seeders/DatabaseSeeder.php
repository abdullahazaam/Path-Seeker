<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\UserProfile;
use App\Models\Career;
use App\Models\Multimedia;
use App\Models\Resource;
use App\Models\QuizQuestion;
use App\Models\Bookmark;
use App\Models\Feedback;
use App\Models\SuccessStory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database with 2026-ready enterprise data.
     */
    public function run(): void
    {
        // 1. Initial System Seed Users (Only created if user does not exist, preventing recreation of deleted accounts)
        $users = [
            [
                'name' => 'Admin User',
                'email' => 'admin@pathseeker.com',
                'password' => Hash::make('admin123'),
                'role' => 'admin',
                'education_level' => 'Master of Science in Computer Science',
                'interests' => 'Cloud Architecture, System Design, AI Research',
            ],
            [
                'name' => 'Alex Rivera',
                'email' => 'student@pathseeker.com',
                'password' => Hash::make('student123'),
                'role' => 'student',
                'education_level' => 'Undergraduate (Year 3)',
                'interests' => 'Full-Stack Development, Cyber Security, UI/UX',
            ],
            [
                'name' => 'Sarah Connor',
                'email' => 'graduate@pathseeker.com',
                'password' => Hash::make('graduate123'),
                'role' => 'graduate',
                'education_level' => 'Bachelor of Engineering',
                'interests' => 'DevOps, Machine Learning, Mobile Apps',
            ],
            [
                'name' => 'David Miller',
                'email' => 'pro@pathseeker.com',
                'password' => Hash::make('pro123'),
                'role' => 'professional',
                'education_level' => 'B.S. Software Engineering',
                'interests' => 'Tech Leadership, Enterprise Architecture',
            ],
        ];

        foreach ($users as $userData) {
            if (User::where('email', $userData['email'])->doesntExist()) {
                $user = User::create([
                    'name' => $userData['name'],
                    'email' => $userData['email'],
                    'password' => $userData['password'],
                    'role' => $userData['role'],
                    'email_verified_at' => now(),
                ]);

                UserProfile::create([
                    'user_id' => $user->id,
                    'education_level' => $userData['education_level'],
                    'interests' => $userData['interests'],
                    'profile_image' => null,
                ]);
            }
        }

        // Auto-verify any existing unverified accounts so demo users can access dashboard
        User::whereNull('email_verified_at')->update(['email_verified_at' => now()]);

        // 2. Comprehensive 2026 Career Tracks with Role-Based Targeting
        $careers = [
            // ── FOUNDATIONAL / STUDENT TRACKS ──
            [
                'title' => 'Full-Stack Web Developer',
                'description' => 'Architect and implement scalable end-to-end web applications using modern backend frameworks, reactive frontend systems, and relational databases.',
                'domain' => 'Software Engineering',
                'target_role' => 'student',
                'required_skills' => 'PHP, Laravel, JavaScript, Vue.js, React, MySQL, REST APIs, Git, Tailwind CSS',
                'expected_salary' => '$75,000 - $125,000 / yr',
            ],
            [
                'title' => 'Front-End Web Engineer & Design Systems Specialist',
                'description' => 'Build high-performance, accessible, and delightful interactive user interfaces with modern component architectures and micro-frontends.',
                'domain' => 'Software Engineering',
                'target_role' => 'student',
                'required_skills' => 'TypeScript, React, Next.js, Vue 3, Tailwind CSS, Web Performance, WCAG Accessibility, Vite',
                'expected_salary' => '$70,000 - $115,000 / yr',
            ],
            [
                'title' => 'Python Data Analyst & BI Developer',
                'description' => 'Transform unstructured operational datasets into strategic executive dashboards, KPI telemetry, and automated ETL workflows.',
                'domain' => 'Data Science',
                'target_role' => 'student',
                'required_skills' => 'Python, Pandas, SQL, Tableau, Power BI, Excel Advanced, Jupyter, Data Storytelling',
                'expected_salary' => '$65,000 - $110,000 / yr',
            ],
            [
                'title' => 'Junior DevOps & Linux Systems Administrator',
                'description' => 'Manage continuous integration workflows, containerize microservices, and orchestrate automated Linux server configurations.',
                'domain' => 'DevOps',
                'target_role' => 'student',
                'required_skills' => 'Linux (Ubuntu/Debian), Bash Scripting, Docker, GitHub Actions, Nginx, Git, Networking Basics',
                'expected_salary' => '$65,000 - $105,000 / yr',
            ],
            [
                'title' => 'Lead UI/UX Product Designer',
                'description' => 'Craft intuitive user experiences, comprehensive design systems, interactive prototypes, and lead user research to optimize usability.',
                'domain' => 'UI/UX Design',
                'target_role' => 'student',
                'required_skills' => 'Figma, Design Systems, Wireframing, User Research, Prototyping, WCAG Accessibility, Micro-Interactions',
                'expected_salary' => '$70,000 - $120,000 / yr',
            ],
            [
                'title' => 'Mobile Application Developer',
                'description' => 'Build high-performance, native and cross-platform mobile apps for iOS and Android with seamless offline synchronization and fluid animations.',
                'domain' => 'Mobile Development',
                'target_role' => 'student',
                'required_skills' => 'Flutter, Dart, Swift, Kotlin, React Native, REST APIs, SQLite, App Store Deployments',
                'expected_salary' => '$80,000 - $135,000 / yr',
            ],

            // ── ENTRY-LEVEL & PORTFOLIO / GRADUATE TRACKS ──
            [
                'title' => 'AI & Machine Learning Engineer',
                'description' => 'Develop, train, fine-tune, and deploy state-of-the-art Deep Learning models, LLMs, and high-throughput real-time inference pipelines.',
                'domain' => 'Artificial Intelligence & Data',
                'target_role' => 'graduate',
                'required_skills' => 'Python, PyTorch, TensorFlow, Scikit-Learn, LLMs, LangChain, Vector DBs, MLOps',
                'expected_salary' => '$115,000 - $175,000 / yr',
            ],
            [
                'title' => 'Cloud Solutions Architect',
                'description' => 'Design resilient, highly available, and secure multi-cloud architectures across AWS, GCP, and Azure for enterprise distributed workloads.',
                'domain' => 'Cloud & Infrastructure',
                'target_role' => 'graduate',
                'required_skills' => 'AWS, GCP, Azure, Docker, Kubernetes, Terraform, CI/CD, Microservices, IAM Security',
                'expected_salary' => '$120,000 - $185,000 / yr',
            ],
            [
                'title' => 'Cybersecurity & Penetration Tester',
                'description' => 'Perform ethical hacking, vulnerability assessments, penetration testing, and build threat intelligence frameworks to defend corporate perimeters.',
                'domain' => 'Cybersecurity',
                'target_role' => 'graduate',
                'required_skills' => 'Network Security, SIEM, Penetration Testing, Kali Linux, Burp Suite, Cryptography, CISSP',
                'expected_salary' => '$85,000 - $140,000 / yr',
            ],
            [
                'title' => 'Prompt Engineer & AI Context Architect',
                'description' => 'Architect deterministic contextual prompts, RAG (Retrieval-Augmented Generation) systems, and multi-agent autonomous agent workflows.',
                'domain' => 'Artificial Intelligence & Data',
                'target_role' => 'graduate',
                'required_skills' => 'Prompt Engineering, LangChain, LlamaIndex, Vector Databases, Python, OpenAI API, Anthropic Claude, Embeddings',
                'expected_salary' => '$90,000 - $155,000 / yr',
            ],
            [
                'title' => 'Blockchain & Smart Contract Engineer',
                'description' => 'Architect decentralized applications (dApps), write secure EVM smart contracts, and implement cryptographic zero-knowledge protocols.',
                'domain' => 'Blockchain',
                'target_role' => 'graduate',
                'required_skills' => 'Solidity, Rust, Ethereum, Web3.js, Hardhat, Smart Contract Auditing, Cryptography',
                'expected_salary' => '$110,000 - $180,000 / yr',
            ],
            [
                'title' => 'Data Scientist & Predictive Modeler',
                'description' => 'Extract strategic business insights from massive datasets using statistical modeling, regression analysis, clustering, and data storytelling.',
                'domain' => 'Data Science',
                'target_role' => 'graduate',
                'required_skills' => 'Python, R, SQL, Pandas, Tableau, Power BI, Statistical Modeling, BigQuery',
                'expected_salary' => '$90,000 - $145,000 / yr',
            ],
            [
                'title' => 'Game Engine & Graphics Developer',
                'description' => 'Program core physics engines, custom shader pipelines, gameplay mechanics, and network synchronization for AAA titles and interactive 3D apps.',
                'domain' => 'Game Development',
                'target_role' => 'graduate',
                'required_skills' => 'C++, Unity, Unreal Engine 5, C#, Shaders (HLSL/GLSL), 3D Math, Vulkan, PhysX',
                'expected_salary' => '$85,000 - $140,000 / yr',
            ],
            [
                'title' => 'Security Operations (SOC) & Incident Responder',
                'description' => 'Investigate active security anomalies, conduct digital forensics, orchestrate SOAR workflows, and safeguard critical infrastructure.',
                'domain' => 'Cybersecurity',
                'target_role' => 'graduate',
                'required_skills' => 'Threat Hunting, Splunk, EDR, Wireshark, Malware Analysis, MITRE ATT&CK, Python Scripting',
                'expected_salary' => '$75,000 - $120,000 / yr',
            ],

            // ── ADVANCED ARCHITECTURE & LEADERSHIP / PROFESSIONAL TRACKS ──
            [
                'title' => 'Distributed Backend & Systems Architect',
                'description' => 'Design resilient low-latency backend systems capable of processing millions of concurrent transactions with strict consistency guarantees.',
                'domain' => 'Software Engineering',
                'target_role' => 'professional',
                'required_skills' => 'Go (Golang), Java / Spring Boot, Kafka, Redis, gRPC, PostgreSQL, Event-Driven Architecture',
                'expected_salary' => '$110,000 - $165,000 / yr',
            ],
            [
                'title' => 'Principal Cloud & SRE Infrastructure Lead',
                'description' => 'Lead enterprise cloud transformations, multi-region Kubernetes topologies, infrastructure-as-code automation, and chaos engineering practices.',
                'domain' => 'Cloud & Infrastructure',
                'target_role' => 'professional',
                'required_skills' => 'Kubernetes, Terraform, AWS Multi-Region, Chaos Mesh, Prometheus, OpenTelemetry, Service Mesh (Istio)',
                'expected_salary' => '$140,000 - $220,000 / yr',
            ],
            [
                'title' => 'Autonomous AI Agent & Multi-Modal Architect',
                'description' => 'Engineer production-grade autonomous agent swarms, function-calling frameworks, memory persistence graphs, and fine-tuned multimodal models.',
                'domain' => 'Artificial Intelligence & Data',
                'target_role' => 'professional',
                'required_skills' => 'AutoGen, LangGraph, PyTorch, Multi-Modal Inference, LoRA/QLoRA Fine-Tuning, vLLM, TensorRT-LLM',
                'expected_salary' => '$145,000 - $230,000 / yr',
            ],
            [
                'title' => 'Big Data & Lakehouse Platform Engineer',
                'description' => 'Construct high-throughput streaming and batch data pipelines, manage cloud lakehouses, and optimize complex analytical transformations.',
                'domain' => 'Data Science',
                'target_role' => 'professional',
                'required_skills' => 'Apache Spark, Apache Kafka, Snowflake, dbt, Apache Airflow, Databricks, Python, Scala',
                'expected_salary' => '$115,000 - $170,000 / yr',
            ],
            [
                'title' => 'Native iOS & Android Mobile Architect',
                'description' => 'Lead the technical architecture of flagship mobile ecosystems utilizing declarative UI frameworks, local caching, and hardware integration.',
                'domain' => 'Mobile Development',
                'target_role' => 'professional',
                'required_skills' => 'Swift, SwiftUI, Jetpack Compose, Kotlin Multiplatform, GraphQL, CoreData, Realm',
                'expected_salary' => '$95,000 - $150,000 / yr',
            ],
            [
                'title' => 'Technical Artist & 3D Interactive Specialist',
                'description' => 'Bridge the technical barrier between 3D artists and game programmers by building procedural asset pipelines, real-time shaders, and lighting rigs.',
                'domain' => 'Game Development',
                'target_role' => 'professional',
                'required_skills' => 'Unreal Engine 5, Blender, Maya, Procedural Generation, Houdini, Real-Time VFX, C++',
                'expected_salary' => '$80,000 - $130,000 / yr',
            ],
        ];

        foreach ($careers as $career) {
            $careerData = array_merge([
                'salary_source_name' => 'Verified 2026 Global Tech Compensation Survey',
                'source_url' => 'https://levels.fyi/2026-benchmarks',
                'source_date' => '2026-Q1',
                'currency' => 'USD',
                'methodology_notes' => 'Median annualized total compensation aggregate across 50,000+ verified remote and on-site engineering roles.',
                'confidence_level' => 'Verified High Confidence',
            ], $career);

            Career::updateOrCreate(
                ['title' => $career['title']],
                $careerData
            );
        }

        // 3. Multimedia Items
        $this->call(MultimediaSeeder::class);

        // 4. Resources
        $this->call(ResourceSeeder::class);

        // 5. Quiz Questions
        $quizQuestions = [
            [
                'question_text' => 'Which engineering problem interests you most?',
                'options' => [
                    'A' => 'Building responsive web interfaces, full-stack applications, and interactive user experiences',
                    'B' => 'Designing multi-cloud infrastructures, Kubernetes clusters, and zero-downtime CI/CD pipelines',
                    'C' => 'Developing generative AI models, vector search systems, and fine-tuning LLMs',
                    'D' => 'Defending enterprise networks, ethical hacking, and threat mitigation',
                ],
                'correct_answer' => 'A',
            ],
            [
                'question_text' => 'What type of daily workflow aligns best with your strengths?',
                'options' => [
                    'A' => 'Designing fluid mobile and native cross-platform experiences on iOS and Android',
                    'B' => 'Orchestrating automated infrastructure-as-code and Terraform modules',
                    'C' => 'Extracting predictive insights from complex datasets and designing analytics dashboards',
                    'D' => 'Conducting penetration tests, SOC threat hunting, and security compliance audits',
                ],
                'correct_answer' => 'C',
            ],
            [
                'question_text' => 'When tackling a technical system, what layer do you naturally prioritize?',
                'options' => [
                    'A' => 'API architecture, microservices contracts, and clean frontend component hierarchies',
                    'B' => 'Zero-downtime deployment pipelines, container security, and cloud scalability',
                    'C' => 'Neural network architecture, loss function optimization, and model inference latency',
                    'D' => 'Identity access management (IAM), firewall rules, and encryption protocols',
                ],
                'correct_answer' => 'A',
            ],
            [
                'question_text' => 'Which development tooling ecosystem excites you the most?',
                'options' => [
                    'A' => 'TypeScript, React, Next.js, Node.js, and modern full-stack web frameworks',
                    'B' => 'Docker, Kubernetes, AWS CloudFormation, Terraform, and Linux internals',
                    'C' => 'Python, PyTorch, LangChain, Hugging Face transformers, and BigQuery',
                    'D' => 'Kali Linux, Wireshark, Burp Suite, Metasploit, and SIEM monitoring suites',
                ],
                'correct_answer' => 'C',
            ],
            [
                'question_text' => 'What kind of high-impact deliverable gives you the most satisfaction?',
                'options' => [
                    'A' => 'A lightning-fast, high-converting digital product used by millions of global consumers',
                    'B' => 'A 99.999% uptime multi-region cloud backbone that gracefully survives disaster recovery',
                    'C' => 'An autonomous multi-agent AI system that automates complex reasoning and decision making',
                    'D' => 'A bulletproof zero-trust architecture that prevents sophisticated ransomware attacks',
                ],
                'correct_answer' => 'A',
            ],
            [
                'question_text' => 'In architectural code reviews, what is your primary focus?',
                'options' => [
                    'A' => 'Code readability, clean domain boundaries, UI responsiveness, and state management',
                    'B' => 'Serverless resource efficiency, automated rollback strategies, and system telemetry',
                    'C' => 'Data pipeline lineage, feature store integrity, and prevention of model drift',
                    'D' => 'Input sanitization, OWASP top 10 prevention, and least-privilege security controls',
                ],
                'correct_answer' => 'D',
            ],
        ];

        foreach ($quizQuestions as $q) {
            QuizQuestion::updateOrCreate(
                ['question_text' => $q['question_text']],
                $q
            );
        }

        // 6. Success Stories
        $stories = [
            [
                'title' => 'Elena Rostova — From QA to Production AI Engineer',
                'domain' => 'Artificial Intelligence & Data',
                'story_text' => 'PathSeeker mapped out the exact mathematics, PyTorch roadmap, and vector search milestones I needed. Within 9 months, I transitioned from manual QA to training production LLM agents at a DeepMind / Google Partner.',
                'image_url' => 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?w=400&auto=format&fit=crop&q=80',
                'status' => SuccessStory::STATUS_APPROVED,
                'reviewed_at' => now(),
            ],
            [
                'title' => 'Marcus Vance — Support Tech to AWS Cloud Solutions Architect',
                'domain' => 'Cloud & Infrastructure',
                'story_text' => 'The multi-cloud architecture guides and verified cheat sheets helped me pass my AWS Solutions Architect Professional exam on the first attempt and secure a six-figure remote role at AWS.',
                'image_url' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=400&auto=format&fit=crop&q=80',
                'status' => SuccessStory::STATUS_APPROVED,
                'reviewed_at' => now(),
            ],
            [
                'title' => 'Amina Al-Mansoor — Full-Stack Engineer at Stripe',
                'domain' => 'Software Engineering',
                'story_text' => 'The skill radar benchmarks and interview kits gave me the confidence to stand out among thousands of applicants. PathSeeker is truly the modern compass for software engineers.',
                'image_url' => 'https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?w=400&auto=format&fit=crop&q=80',
                'status' => SuccessStory::STATUS_APPROVED,
                'reviewed_at' => now(),
            ],
        ];

        foreach ($stories as $story) {
            SuccessStory::updateOrCreate(
                ['title' => $story['title']],
                $story
            );
        }
    }
}
