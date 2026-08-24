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
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Users & UserProfiles (Safe Idempotent Creation)
        $users = [
            [
                'name' => 'Admin User',
                'email' => 'admin@pathseeker.com',
                'password' => Hash::make('password123'),
                'role' => 'admin',
                'education_level' => 'Master of Science in Computer Science',
                'interests' => 'Cloud Architecture, System Design, AI Research',
            ],
            [
                'name' => 'Alex Rivera',
                'email' => 'student@pathseeker.com',
                'password' => Hash::make('password123'),
                'role' => 'student',
                'education_level' => 'Undergraduate (Year 3)',
                'interests' => 'Full-Stack Development, Cyber Security, UI/UX',
            ],
            [
                'name' => 'Sarah Connor',
                'email' => 'graduate@pathseeker.com',
                'password' => Hash::make('password123'),
                'role' => 'graduate',
                'education_level' => 'Bachelor of Engineering',
                'interests' => 'DevOps, Machine Learning, Mobile Apps',
            ],
            [
                'name' => 'David Miller',
                'email' => 'pro@pathseeker.com',
                'password' => Hash::make('password123'),
                'role' => 'professional',
                'education_level' => 'B.S. Software Engineering',
                'interests' => 'Tech Leadership, Enterprise Architecture',
            ],
            [
                'name' => 'Abdullah Azaam',
                'email' => 'abdullahazaam1505@gmail.com',
                'password' => Hash::make('password123'),
                'role' => 'student',
                'education_level' => 'Bachelor of Science in Computer Science',
                'interests' => 'Full-Stack Development, Cloud Architecture, AI Systems',
            ],
        ];

        foreach ($users as $userData) {
            $user = User::firstOrCreate(
                ['email' => $userData['email']],
                $userData
            );

            UserProfile::firstOrCreate(
                ['user_id' => $user->id],
                [
                    'education_level' => $userData['education_level'],
                    'interests' => $userData['interests'],
                    'profile_image' => null,
                ]
            );
        }

        // 2. 15 Diverse, High-Demand Career Tracks
        $careers = [
            [
                'title' => 'Full-Stack Web Developer',
                'description' => 'Architect and implement scalable end-to-end web applications using modern backend frameworks, reactive frontend systems, and relational databases.',
                'domain' => 'Software Engineering',
                'required_skills' => 'PHP, Laravel, JavaScript, Vue.js, React, MySQL, REST APIs, Git, Tailwind CSS',
                'expected_salary' => '$75,000 - $125,000 / yr',
            ],
            [
                'title' => 'Cloud Solutions Architect',
                'description' => 'Design resilient, highly available, and secure multi-cloud architectures across AWS, GCP, and Azure for enterprise distributed workloads.',
                'domain' => 'Cloud & Infrastructure',
                'required_skills' => 'AWS, GCP, Azure, Docker, Kubernetes, Terraform, CI/CD, Microservices, IAM Security',
                'expected_salary' => '$120,000 - $185,000 / yr',
            ],
            [
                'title' => 'AI & Machine Learning Engineer',
                'description' => 'Develop, train, fine-tune, and deploy state-of-the-art Deep Learning models, LLMs, and high-throughput real-time inference pipelines.',
                'domain' => 'Artificial Intelligence & Data',
                'required_skills' => 'Python, PyTorch, TensorFlow, Scikit-Learn, LLMs, LangChain, Vector DBs, MLOps',
                'expected_salary' => '$115,000 - $175,000 / yr',
            ],
            [
                'title' => 'Cybersecurity & Penetration Tester',
                'description' => 'Perform ethical hacking, vulnerability assessments, penetration testing, and build threat intelligence frameworks to defend corporate perimeters.',
                'domain' => 'Cybersecurity',
                'required_skills' => 'Network Security, SIEM, Penetration Testing, Kali Linux, Burp Suite, Cryptography, CISSP',
                'expected_salary' => '$85,000 - $140,000 / yr',
            ],
            [
                'title' => 'Mobile Application Developer',
                'description' => 'Build high-performance, native and cross-platform mobile apps for iOS and Android with seamless offline synchronization and fluid animations.',
                'domain' => 'Mobile Development',
                'required_skills' => 'Flutter, Dart, Swift, Kotlin, React Native, REST APIs, SQLite, App Store Deployments',
                'expected_salary' => '$80,000 - $135,000 / yr',
            ],
            [
                'title' => 'DevOps & Site Reliability Engineer',
                'description' => 'Automate deployment lifecycles, engineer zero-downtime infrastructure, and maintain continuous monitoring, telemetry, and chaos engineering.',
                'domain' => 'DevOps',
                'required_skills' => 'GitHub Actions, Jenkins, Ansible, Prometheus, Grafana, Linux Kernels, Docker, Helm',
                'expected_salary' => '$105,000 - $160,000 / yr',
            ],
            [
                'title' => 'Lead UI/UX Product Designer',
                'description' => 'Craft intuitive user experiences, comprehensive design systems, interactive prototypes, and lead user research to optimize conversion and usability.',
                'domain' => 'UI/UX Design',
                'required_skills' => 'Figma, Design Systems, Wireframing, User Research, Prototyping, WCAG Accessibility',
                'expected_salary' => '$70,000 - $120,000 / yr',
            ],
            [
                'title' => 'Blockchain & Smart Contract Engineer',
                'description' => 'Architect decentralized applications (dApps), write secure EVM smart contracts, and implement cryptographic zero-knowledge protocols.',
                'domain' => 'Blockchain',
                'required_skills' => 'Solidity, Rust, Ethereum, Web3.js, Hardhat, Smart Contract Auditing, Cryptography',
                'expected_salary' => '$110,000 - $180,000 / yr',
            ],
            [
                'title' => 'Data Scientist & Predictive Modeler',
                'description' => 'Extract strategic business insights from massive datasets using statistical modeling, regression analysis, clustering, and data storytelling.',
                'domain' => 'Data Science',
                'required_skills' => 'Python, R, SQL, Pandas, Tableau, Power BI, Statistical Modeling, BigQuery',
                'expected_salary' => '$90,000 - $145,000 / yr',
            ],
            [
                'title' => 'Game Engine & Graphics Developer',
                'description' => 'Program core physics engines, custom shader pipelines, gameplay mechanics, and network synchronization for AAA titles and interactive 3D apps.',
                'domain' => 'Game Development',
                'required_skills' => 'C++, Unity, Unreal Engine 5, C#, Shaders (HLSL/GLSL), 3D Math, Vulkan, PhysX',
                'expected_salary' => '$85,000 - $140,000 / yr',
            ],
            [
                'title' => 'Distributed Backend & Systems Architect',
                'description' => 'Design resilient low-latency backend systems capable of processing millions of concurrent transactions with strict consistency guarantees.',
                'domain' => 'Software Engineering',
                'required_skills' => 'Go (Golang), Java / Spring Boot, Kafka, Redis, gRPC, PostgreSQL, Event-Driven Architecture',
                'expected_salary' => '$110,000 - $165,000 / yr',
            ],
            [
                'title' => 'Big Data & Lakehouse Platform Engineer',
                'description' => 'Construct high-throughput streaming and batch data pipelines, manage cloud lakehouses, and optimize complex analytical transformations.',
                'domain' => 'Data Science',
                'required_skills' => 'Apache Spark, Apache Kafka, Snowflake, dbt, Apache Airflow, Databricks, Python, Scala',
                'expected_salary' => '$115,000 - $170,000 / yr',
            ],
            [
                'title' => 'Security Operations (SOC) & Incident Responder',
                'description' => 'Investigate active security anomalies, conduct digital forensics, orchestrate SOAR workflows, and safeguard critical infrastructure.',
                'domain' => 'Cybersecurity',
                'required_skills' => 'Threat Hunting, Splunk, EDR, Wireshark, Malware Analysis, MITRE ATT&CK, Python Scripting',
                'expected_salary' => '$75,000 - $120,000 / yr',
            ],
            [
                'title' => 'Native iOS & Android Mobile Architect',
                'description' => 'Lead the technical architecture of flagship mobile ecosystems utilizing declarative UI frameworks, local caching, and hardware integration.',
                'domain' => 'Mobile Development',
                'required_skills' => 'Swift, SwiftUI, Jetpack Compose, Kotlin Multiplatform, GraphQL, CoreData, Realm',
                'expected_salary' => '$95,000 - $150,000 / yr',
            ],
            [
                'title' => 'Technical Artist & 3D Interactive Specialist',
                'description' => 'Bridge the technical barrier between 3D artists and game programmers by building procedural asset pipelines, real-time shaders, and lighting rigs.',
                'domain' => 'Game Development',
                'required_skills' => 'Unreal Engine 5, Blender, Maya, Procedural Generation, Houdini, Real-Time VFX, C++',
                'expected_salary' => '$80,000 - $130,000 / yr',
            ],
        ];

        foreach ($careers as $career) {
            Career::firstOrCreate(
                ['title' => $career['title']],
                $career
            );
        }

        // 3. 16 Comprehensive Multimedia Items with Valid, Open YouTube Embed URLs
        $multimedia = [
            [
                'title' => 'Full-Stack Web Development 2026: Architecture & Frameworks',
                'description' => 'Master modern full-stack web engineering from frontend reactivity (Vue/React) to robust backend APIs (Laravel/Node) and relational databases.',
                'type' => 'video',
                'url' => 'https://www.youtube.com/embed/kJQP7kiw5Fk',
                'thumbnail_url' => 'https://images.unsplash.com/photo-1498050108023-c5249f4df085?w=800&auto=format&fit=crop&q=80',
                'duration' => '28:45',
                'tags' => 'Software Engineering, Laravel, React, Full-Stack',
            ],
            [
                'title' => 'Cloud Solutions Architecture & AWS/GCP Multi-Cloud Blueprint',
                'description' => 'Deep dive into architecting resilient cloud systems, VPC networking, IAM security, and serverless compute paradigms on AWS and Google Cloud.',
                'type' => 'video',
                'url' => 'https://www.youtube.com/embed/M988_fsOSWo',
                'thumbnail_url' => 'https://images.unsplash.com/photo-1451187580459-43490279c0fa?w=800&auto=format&fit=crop&q=80',
                'duration' => '42:15',
                'tags' => 'Cloud, AWS, Kubernetes, Distributed Systems',
            ],
            [
                'title' => 'Machine Learning & Generative AI Engineering in Production',
                'description' => 'Learn how to train, fine-tune, and deploy transformer models, LLMs, and real-time inference pipelines using PyTorch and MLOps tools.',
                'type' => 'video',
                'url' => 'https://www.youtube.com/embed/i_LwzRVP7bg',
                'thumbnail_url' => 'https://images.unsplash.com/photo-1620712943543-bcc4688e7485?w=800&auto=format&fit=crop&q=80',
                'duration' => '35:20',
                'tags' => 'Artificial Intelligence, Python, LLMs, Neural Networks, MLOps',
            ],
            [
                'title' => 'Cybersecurity Defense, Ethical Hacking & Perimeter Hardening',
                'description' => 'Essential walkthrough on reconnaissance, vulnerability assessment, penetration testing, network sniffing, and defensive perimeter auditing.',
                'type' => 'video',
                'url' => 'https://www.youtube.com/embed/3Kq1MIfTWCE',
                'thumbnail_url' => 'https://images.unsplash.com/photo-1550751827-4bd374c3f58b?w=800&auto=format&fit=crop&q=80',
                'duration' => '31:10',
                'tags' => 'Cybersecurity, Ethical Hacking, Threat Hunting, Kali Linux',
            ],
            [
                'title' => 'Cross-Platform Mobile Development with Flutter & Dart',
                'description' => 'Step-by-step masterclass on building responsive mobile user interfaces with Flutter and Dart, connecting RESTful backends and local SQLite databases.',
                'type' => 'video',
                'url' => 'https://www.youtube.com/embed/VPvVD8t02U8',
                'thumbnail_url' => 'https://images.unsplash.com/photo-1512941937669-90a1b58e7e9c?w=800&auto=format&fit=crop&q=80',
                'duration' => '34:00',
                'tags' => 'Mobile Development, Flutter, iOS, Android, Dart',
            ],
            [
                'title' => 'Modern DevOps Pipelines: Docker, Kubernetes & GitHub Actions',
                'description' => 'Comprehensive tutorial on creating automated CI/CD deployment pipelines, containerizing services with Docker, and orchestrating with Kubernetes.',
                'type' => 'video',
                'url' => 'https://www.youtube.com/embed/scEDHsr3APg',
                'thumbnail_url' => 'https://images.unsplash.com/photo-1618401471353-b98afee0b2eb?w=800&auto=format&fit=crop&q=80',
                'duration' => '24:50',
                'tags' => 'DevOps, CI/CD, Containerization, Automation, Docker',
            ],
            [
                'title' => 'Advanced System Design & Microservices Architecture Masterclass',
                'description' => 'Comprehensive masterclass on designing low-latency distributed architectures, event-driven microservices, database partitioning, and high-availability patterns.',
                'type' => 'video',
                'url' => 'https://www.youtube.com/embed/un6ZyFkqFJU',
                'thumbnail_url' => 'https://images.unsplash.com/photo-1558494949-ef010cbdcc31?w=800&auto=format&fit=crop&q=80',
                'duration' => '38:15',
                'tags' => 'Software Engineering, System Design, Microservices, Distributed Systems',
            ],
            [
                'title' => 'Blockchain Engineering: Solidity & Ethereum Smart Contracts',
                'description' => 'Learn to code, test, and audit decentralized smart contracts with Solidity, Hardhat, and Web3.js on the Ethereum Virtual Machine (EVM).',
                'type' => 'video',
                'url' => 'https://www.youtube.com/embed/M576WGiDBdQ',
                'thumbnail_url' => 'https://images.unsplash.com/photo-1639762681485-074b7f938ba0?w=800&auto=format&fit=crop&q=80',
                'duration' => '40:25',
                'tags' => 'Blockchain, Solidity, Ethereum, Web3, Smart Contracts',
            ],
            [
                'title' => 'Data Science & Machine Learning with Python: Full Crash Course',
                'description' => 'Complete end-to-end data analysis using Pandas, NumPy, statistical hypothesis testing, Scikit-Learn regression, and interactive dashboarding.',
                'type' => 'video',
                'url' => 'https://www.youtube.com/embed/ua-CiDNNj30',
                'thumbnail_url' => 'https://images.unsplash.com/photo-1551288049-bebda4e38f71?w=800&auto=format&fit=crop&q=80',
                'duration' => '37:45',
                'tags' => 'Data Science, Python, Pandas, Analytics, Statistics',
            ],
            [
                'title' => 'Game Engine Programming: Unreal Engine 5 & C++ Foundations',
                'description' => 'Program realistic physics collisions, custom character controllers, dynamic lighting, and HLSL shaders inside Unreal Engine 5.',
                'type' => 'video',
                'url' => 'https://www.youtube.com/embed/gQmtPE79P4A',
                'thumbnail_url' => 'https://images.unsplash.com/photo-1550745165-9bc0b252726f?w=800&auto=format&fit=crop&q=80',
                'duration' => '48:10',
                'tags' => 'Game Development, Unreal Engine 5, C++, 3D Graphics',
            ],
            [
                'title' => 'High-Performance Distributed Systems & Golang Microservices',
                'description' => 'Architecture patterns for low-latency backend systems, event streaming with Apache Kafka, gRPC communication, and distributed caching.',
                'type' => 'video',
                'url' => 'https://www.youtube.com/embed/un6ZyFkqFJU',
                'thumbnail_url' => 'https://images.unsplash.com/photo-1558494949-ef010cbdcc31?w=800&auto=format&fit=crop&q=80',
                'duration' => '33:20',
                'tags' => 'Software Engineering, Golang, Microservices, Distributed Systems',
            ],
            [
                'title' => 'Big Data Engineering: Apache Spark & Cloud Lakehouse Architecture',
                'description' => 'Build scalable batch and stream data pipelines using Apache Spark, Databricks, Delta Lake, and dbt for enterprise data warehousing.',
                'type' => 'video',
                'url' => 'https://www.youtube.com/embed/_C8kWso4ebw',
                'thumbnail_url' => 'https://images.unsplash.com/photo-1518770660439-4636190af475?w=800&auto=format&fit=crop&q=80',
                'duration' => '36:50',
                'tags' => 'Data Science, Big Data, Apache Spark, Databricks, ETL',
            ],
            [
                'title' => 'SOC Analyst & Incident Response: Threat Hunting Masterclass',
                'description' => 'Real-world walkthrough on SIEM log analysis in Splunk, detecting malware lateral movement, and applying the MITRE ATT&CK framework.',
                'type' => 'video',
                'url' => 'https://www.youtube.com/embed/O6y4k5H1_rU',
                'thumbnail_url' => 'https://images.unsplash.com/photo-1563986768609-322da13575f3?w=800&auto=format&fit=crop&q=80',
                'duration' => '30:15',
                'tags' => 'Cybersecurity, SOC, Splunk, Incident Response, Threat Intelligence',
            ],
            [
                'title' => 'Native iOS Development with Swift & SwiftUI Architecture',
                'description' => 'Build modern declarative user interfaces with SwiftUI, integrate Combine for reactive state management, and implement CoreData caching.',
                'type' => 'video',
                'url' => 'https://www.youtube.com/embed/comQ1-x2a1Q',
                'thumbnail_url' => 'https://images.unsplash.com/photo-1526498460520-4c246339dccb?w=800&auto=format&fit=crop&q=80',
                'duration' => '39:00',
                'tags' => 'Mobile Development, Swift, SwiftUI, iOS Architecture',
            ],
            [
                'title' => 'Technical Art & Real-Time VFX in Unreal Engine 5',
                'description' => 'Bridge the gap between art and code with procedural mesh generation, custom Niagara particle systems, and HLSL shader optimization.',
                'type' => 'video',
                'url' => 'https://www.youtube.com/embed/8wZ31s3L4fA',
                'thumbnail_url' => 'https://images.unsplash.com/photo-1618005182384-a83a8bd57fbe?w=800&auto=format&fit=crop&q=80',
                'duration' => '27:30',
                'tags' => 'Game Development, 3D VFX, Technical Art, Niagara, Shaders',
            ],
            [
                'title' => 'Career Passport Podcast: Transitioning to Global Tech Leadership',
                'description' => 'Industry leaders share insider advice on resumes, portfolio reviews, salary negotiation, and navigating technical interviews.',
                'type' => 'audio',
                'url' => 'https://www.youtube.com/embed/bJzb-Ey42G4',
                'thumbnail_url' => 'https://images.unsplash.com/photo-1590602847861-f357a9332bbc?w=800&auto=format&fit=crop&q=80',
                'duration' => '45:00',
                'tags' => 'Podcast, Mentorship, Tech Leadership, Career Pivot',
            ],
        ];

        foreach ($multimedia as $item) {
            Multimedia::firstOrCreate(
                ['title' => $item['title']],
                $item
            );
        }

        // 4. Resources
        $this->call(ResourceSeeder::class);

        // 5. Quiz Questions
        $quizQuestions = [
            [
                'question_text' => 'Which engineering problem interests you most?',
                'options' => [
                    'A' => 'Building responsive web interfaces, full-stack applications, and interactive user experiences',
                    'B' => 'Configuring automated cloud deployment pipelines, Kubernetes clusters, and container orchestration',
                    'C' => 'Developing predictive machine learning models, statistical neural networks, and Big Data pipelines',
                    'D' => 'Securing network infrastructure, performing ethical penetration testing, and vulnerability defense'
                ],
                'correct_answer' => 'A',
            ],
            [
                'question_text' => 'What is your preferred development environment and tool stack?',
                'options' => [
                    'A' => 'VS Code, Laravel / React, REST API development, and database schema design',
                    'B' => 'Linux terminal, Terraform, Docker, AWS Console, and CI/CD pipelines',
                    'C' => 'Jupyter Notebooks, Python, Pandas, TensorFlow, and SQL data warehouses',
                    'D' => 'Wireshark, Kali Linux, Burp Suite, and security log monitoring tools'
                ],
                'correct_answer' => 'A',
            ],
            [
                'question_text' => 'What type of career impact excites you most?',
                'options' => [
                    'A' => 'Launching web products that thousands of daily active users interact with',
                    'B' => 'Ensuring 99.999% uptime and zero-downtime infrastructure resilience',
                    'C' => 'Discovering actionable AI insights from billions of data points',
                    'D' => 'Preventing data breaches and safeguarding enterprise cyber assets'
                ],
                'correct_answer' => 'A',
            ],
        ];

        foreach ($quizQuestions as $q) {
            QuizQuestion::firstOrCreate(
                ['question_text' => $q['question_text']],
                $q
            );
        }

        // 6. Success Stories
        $studentUser = User::where('email', 'student@pathseeker.com')->first();
        $proUser = User::where('email', 'pro@pathseeker.com')->first();

        if ($studentUser) {
            SuccessStory::firstOrCreate(
                ['title' => 'From University Sophomore to Full-Stack Software Engineer'],
                [
                    'domain' => 'Software Engineering',
                    'story_text' => 'Using PathSeeker Career Bank and practice assessments, Alex mastered Laravel and JavaScript, landing a competitive software engineering fellowship.',
                    'image_url' => null,
                    'submitted_by' => $studentUser->id,
                ]
            );
        }

        if ($proUser) {
            SuccessStory::firstOrCreate(
                ['title' => 'Pivoting from Sysadmin to Certified Cloud Solutions Architect'],
                [
                    'domain' => 'Cloud & Infrastructure',
                    'story_text' => 'David leveraged the career roadmap and certification resources to pivot into AWS Solutions Architecture with a 40% salary bump.',
                    'image_url' => null,
                    'submitted_by' => $proUser->id,
                ]
            );
        }
    }
}