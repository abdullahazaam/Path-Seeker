<?php

function createSimplePdf($title, $subtitle, $category, $sections) {
    $contentLines = [];
    $contentLines[] = "BT";
    
    // Header Banner Box
    $contentLines[] = "0.12 0.15 0.28 rg";
    $contentLines[] = "0 0 0 RG";
    $contentLines[] = "ET";
    $contentLines[] = "q";
    $contentLines[] = "0.08 0.11 0.22 rg";
    $contentLines[] = "30 710 552 60 re f";
    $contentLines[] = "0.4 0.3 0.9 rg";
    $contentLines[] = "30 706 552 4 re f";
    $contentLines[] = "Q";
    
    $contentLines[] = "BT";
    $contentLines[] = "1 1 1 rg";
    $contentLines[] = "/F1 15 Tf";
    $contentLines[] = "45 742 Td";
    $contentLines[] = "(" . escapePdfText($title) . ") Tj";
    
    $contentLines[] = "0.7 0.8 1.0 rg";
    $contentLines[] = "/F2 10 Tf";
    $contentLines[] = "0 -18 Td";
    $contentLines[] = "(PATHSEEKER 2026 TECHNICAL TOOLKIT  |  " . escapePdfText($category) . ") Tj";

    $contentLines[] = "0.1 0.1 0.15 rg";
    $contentLines[] = "/F1 11.5 Tf";
    $contentLines[] = "0 -40 Td";
    $contentLines[] = "(" . escapePdfText($subtitle) . ") Tj";

    $contentLines[] = "/F2 9.5 Tf";
    $contentLines[] = "0.2 0.2 0.25 rg";
    
    foreach ($sections as $heading => $bullets) {
        $contentLines[] = "0 -22 Td";
        $contentLines[] = "0.25 0.2 0.6 rg";
        $contentLines[] = "/F1 11 Tf";
        $contentLines[] = "(" . escapePdfText($heading) . ") Tj";
        
        $contentLines[] = "0.15 0.15 0.2 rg";
        $contentLines[] = "/F2 9 Tf";
        foreach ($bullets as $b) {
            $contentLines[] = "0 -15 Td";
            $contentLines[] = "(  * " . escapePdfText($b) . ") Tj";
        }
    }

    // Footer
    $contentLines[] = "0.5 0.5 0.6 rg";
    $contentLines[] = "/F2 8 Tf";
    $contentLines[] = "0 -35 Td";
    $contentLines[] = "(Generated for verified candidates at https://pathseeker.com  |  Confidential & Educational Resource) Tj";

    $contentLines[] = "ET";

    $stream = implode("\n", $contentLines);
    $streamLen = strlen($stream);

    $objects = [];
    $objects[1] = "<< /Type /Catalog /Pages 2 0 R >>";
    $objects[2] = "<< /Type /Pages /Kids [3 0 R] /Count 1 >>";
    $objects[3] = "<< /Type /Page /Parent 2 0 R /MediaBox [0 0 612 792] /Contents 4 0 R /Resources << /Font << /F1 5 0 R /F2 6 0 R >> >> >>";
    $objects[4] = "<< /Length " . $streamLen . " >>\nstream\n" . $stream . "\nendstream";
    $objects[5] = "<< /Type /Font /Subtype /Type1 /BaseFont /Helvetica-Bold >>";
    $objects[6] = "<< /Type /Font /Subtype /Type1 /BaseFont /Helvetica >>";

    $pdf = "%PDF-1.4\n";
    $offsets = [];
    
    for ($i = 1; $i <= 6; $i++) {
        $offsets[$i] = strlen($pdf);
        $pdf .= $i . " 0 obj\n" . $objects[$i] . "\nendobj\n";
    }

    $xrefOffset = strlen($pdf);
    $pdf .= "xref\n0 7\n";
    $pdf .= "0000000000 65535 f \n";
    for ($i = 1; $i <= 6; $i++) {
        $pdf .= sprintf("%010d 00000 n \n", $offsets[$i]);
    }

    $pdf .= "trailer\n<< /Size 7 /Root 1 0 R >>\n";
    $pdf .= "startxref\n" . $xrefOffset . "\n%%EOF\n";

    return $pdf;
}

function escapePdfText($text) {
    return str_replace(['\\', '(', ')'], ['\\\\', '\\(', '\\)'], $text);
}

// Destination directories
$dirs = [
    __DIR__ . '/Project/public/storage/resources/pdfs',
    __DIR__ . '/Project/storage/app/public/resources/pdfs',
];

foreach ($dirs as $dir) {
    if (!is_dir($dir)) {
        mkdir($dir, 0755, true);
    }
}

$resourcesData = [
    'react-nextjs-enterprise-blueprint.pdf' => [
        'title' => 'React & Next.js 15 Enterprise Architecture Blueprint',
        'subtitle' => 'Modern Full-Stack Production Architecture, Server Components & Hydration',
        'category' => 'Architecture PDF',
        'sections' => [
            '1. Next.js 15 App Router & Server Actions' => [
                'Leverage React 19 async transitions and optimistic UI mutations with useOptimistic().',
                'Isolate Server Components from Client boundary trees to reduce initial bundle sizes by 40%.',
                'Implement granular route handlers with edge middleware caching and rate-limiting.',
            ],
            '2. State Management & Server Synchronization' => [
                'Use TanStack Query for background invalidation and optimistic mutations.',
                'Utilize Zustand for lightweight clientside global UI states.',
                'Enforce strict Zod schema validation on all incoming API boundary inputs.',
            ],
            '3. Performance & Web Vitals Optimization' => [
                'Optimize Largest Contentful Paint (LCP) with next/image priority preloading.',
                'Eliminate Cumulative Layout Shift (CLS) via explicit aspect-ratio reservation.',
            ]
        ]
    ],
    'aws-solutions-architect-cheatsheet.pdf' => [
        'title' => 'AWS Certified Solutions Architect (SAA-C03) Mega Cheat Sheet',
        'subtitle' => 'High-Availability Cloud Design, Multi-Region Failover & IAM Policies',
        'category' => 'Cloud Cheat Sheet',
        'sections' => [
            '1. Compute & High Availability' => [
                'Configure Multi-AZ EC2 Auto Scaling groups behind Application Load Balancers.',
                'Deploy AWS Lambda with provisioned concurrency for zero-cold-start microservices.',
                'Use Amazon ECS on AWS Fargate for serverless container workloads with task IAM roles.',
            ],
            '2. Storage Tiering & Database Resilience' => [
                'Amazon S3 Intelligent-Tiering to automate lifecycle cost savings without retrieval penalty.',
                'Aurora Global Databases for sub-second cross-region replication and fast disaster recovery.',
                'Amazon DynamoDB Global Tables with Point-in-Time Recovery (PITR) enabled.',
            ],
            '3. Security & Governance Standards' => [
                'Enforce Least Privilege access with AWS IAM Permission Boundaries and SCPs.',
                'Encrypt all EBS volumes and S3 buckets at rest using Customer Managed KMS Keys.',
            ]
        ]
    ],
    'nodejs-backend-engineering-handbook.pdf' => [
        'title' => 'Node.js & Express Enterprise Backend Engineering Handbook',
        'subtitle' => 'Event Loop Internals, Clustering, Worker Threads & Zero-Downtime Resilience',
        'category' => 'Backend Guide',
        'sections' => [
            '1. Event Loop & Concurrency Architecture' => [
                'Understand Phase executions: Timers, Pending Callbacks, Poll, Check (setImmediate), and Close.',
                'Offload CPU-intensive cryptography and image processing to Worker Threads (worker_threads).',
                'Prevent Event Loop starvation with asynchronous chunking and non-blocking I/O.',
            ],
            '2. API Security & Resilient Middleware' => [
                'Implement Helmet.js with strict Content Security Policy (CSP) and HSTS headers.',
                'Apply sliding-window rate limiting using Redis token buckets (ioredis).',
                'Centralize error handling with operational vs programmer error classification.',
            ],
            '3. Database Performance & Connection Pools' => [
                'Tune PostgreSQL connection pools using PgBouncer for horizontal scaling.',
                'Prevent SQL Injection using parameterized Prisma/Knex/TypeORM query builders.',
            ]
        ]
    ],
    'kubernetes-docker-playbook.pdf' => [
        'title' => 'Kubernetes & Docker Production Orchestration Playbook',
        'subtitle' => 'Declarative Infrastructure, GitOps, Helm Charts & Service Meshes',
        'category' => 'DevOps Playbook',
        'sections' => [
            '1. Container Hardening & Docker Best Practices' => [
                'Use multi-stage Docker builds with distroless or alpine base images to minimize CVEs.',
                'Run containers as non-root UID 10001 with read-only root filesystems.',
                'Scan images during CI using Trivy and Grype with automated build breaking.',
            ],
            '2. Kubernetes Pod Reliability & Autoscaling' => [
                'Configure accurate resource requests and limits to avoid noisy-neighbor OOMKills.',
                'Implement Horizontal Pod Autoscaler (HPA) using custom Prometheus metrics.',
                'Define comprehensive readiness and liveness probes with appropriate initial delays.',
            ],
            '3. Ingress & Service Mesh Networking' => [
                'Secure microservice east-west traffic with mutual TLS (mTLS) via Istio or Linkerd.',
                'Route external traffic using Envoy Ingress with automated Let\'s Encrypt SSL cert-manager.',
            ]
        ]
    ],
    'pytorch-transformer-handbook.pdf' => [
        'title' => 'PyTorch & Transformer Deep Learning Mathematics Guide',
        'subtitle' => 'Attention Mechanisms, LoRA Fine-Tuning, Quantization & Tensor Optimization',
        'category' => 'AI / ML Handbook',
        'sections' => [
            '1. Scaled Dot-Product Attention & Self-Attention' => [
                'Mathematical formula: Attention(Q, K, V) = softmax(Q * K^T / sqrt(d_k)) * V.',
                'Multi-Head Attention projects inputs across h representation subspaces simultaneously.',
                'Rotary Position Embedding (RoPE) preserves relative positional information at scale.',
            ],
            '2. Parameter-Efficient Fine-Tuning (PEFT)' => [
                'Low-Rank Adaptation (LoRA) freezes pretrained weights and injects trainable rank decomposition matrices.',
                'QLoRA quantizes base models to 4-bit NormalFloat (NF4) with double quantization.',
                'FlashAttention-2 optimizes GPU SRAM memory hierarchy for 2x faster attention compute.',
            ],
            '3. Inference Serving & Distributed Training' => [
                'Serve high-throughput models with vLLM PagedAttention and continuous batching.',
                'Scale training across multi-node GPUs with PyTorch FSDP (Fully Sharded Data Parallel).',
            ]
        ]
    ],
    'cybersecurity-ethical-hacking-checklist.pdf' => [
        'title' => 'Cybersecurity Ethical Hacking, Burp Suite & Kali Linux Manual',
        'subtitle' => 'OWASP Top 10 Defense, Penetration Testing & Threat Hunting Protocol',
        'category' => 'Security Manual',
        'sections' => [
            '1. Web Application Penetration Testing' => [
                'Identify Broken Object Level Authorization (BOLA/IDOR) across REST and GraphQL endpoints.',
                'Detect Cross-Site Scripting (Stored, Reflected, DOM-based) using Burp Suite Repeater.',
                'Mitigate Server-Side Request Forgery (SSRF) with strict internal IP allowlists.',
            ],
            '2. Network Auditing & Reconnaissance' => [
                'Execute stealth port scans and OS fingerprinting using Nmap (nmap -sS -sV -T4).',
                'Analyze packet captures and TLS handshake anomalies with Wireshark and tcpdump.',
                'Audit wireless networks and authentication protocols for WPA3 transition vulnerabilities.',
            ],
            '3. Cryptographic Standards & Zero Trust' => [
                'Enforce TLS 1.3 with forward secrecy cipher suites (AES-256-GCM, ChaCha20-Poly1305).',
                'Implement Phishing-Resistant MFA using FIDO2 / WebAuthn hardware security keys.',
            ]
        ]
    ],
    'laravel-domain-driven-design-guide.pdf' => [
        'title' => 'Laravel 12 Domain-Driven Design & Clean Architecture PDF',
        'subtitle' => 'Bounded Contexts, Action Classes, Repositories & Inversion of Control',
        'category' => 'E-Book / Guide',
        'sections' => [
            '1. Domain Architecture & Bounded Contexts' => [
                'Organize code into Domain (Core Logic), Application (Use Cases), and Infrastructure (DB/APIs).',
                'Replace bloated controllers with single-purpose Action classes (e.g., RegisterCandidateAction).',
                'Use Value Objects to encapsulate domain primitives and validation invariants.',
            ],
            '2. Eloquent Performance & Query Optimization' => [
                'Prevent N+1 query degradation with eager loading (with, loadMissing, withCount).',
                'Utilize database indexing on composite foreign keys and filtering columns.',
                'Leverage Laravel Database Transactions (DB::transaction) for multi-table atomicity.',
            ],
            '3. Event-Driven Architecture & Queue Scalability' => [
                'Dispatch asynchronous queued jobs via Redis and Laravel Horizon.',
                'Implement idempotent job handlers with automatic exponential backoff retry strategies.',
            ]
        ]
    ],
    'golang-microservices-grpc-patterns.pdf' => [
        'title' => 'Golang High-Concurrency Microservices & gRPC Patterns',
        'subtitle' => 'Goroutines, Channels, Protocol Buffers & Memory-Efficient Distributed Systems',
        'category' => 'Systems Handbook',
        'sections' => [
            '1. Go Concurrency Primitives & Memory Model' => [
                'Manage lifecycle and goroutine cancellation using context.Context with timeout/deadline.',
                'Prevent data races with sync.RWMutex, sync/atomic, and the -race detector tool.',
                'Design robust worker pools with buffered channels and graceful shutdown signals.',
            ],
            '2. gRPC & Protocol Buffers Architecture' => [
                'Define contract-first protobuf (.proto) definitions for high-speed binary serialization.',
                'Implement bi-directional gRPC streaming with keepalive ping policies.',
                'Add interceptors for distributed tracing (OpenTelemetry), metrics (Prometheus), and auth.',
            ],
            '3. Performance Tuning & Profiling' => [
                'Profile CPU, memory heap allocations, and block contention using pprof (go tool pprof).',
                'Avoid unnecessary allocations with sync.Pool for high-frequency byte buffers.',
            ]
        ]
    ],
    'flutter-clean-architecture-blueprint.pdf' => [
        'title' => 'Flutter & Dart Mobile Clean Architecture & Riverpod Blueprint',
        'subtitle' => 'Cross-Platform State Management, Offline SQLite & Dynamic Theming',
        'category' => 'Mobile Architecture',
        'sections' => [
            '1. Clean Layered Architecture' => [
                'Structure apps into Presentation (Widgets/Controllers), Domain (Entities/UseCases), Data (Models/DTOs).',
                'Enforce uni-directional data flow using Riverpod AsyncNotifier and StateNotifier.',
                'Decouple HTTP clients and local SQLite databases behind abstract repository interfaces.',
            ],
            '2. Offline Synchronization & Local Cache' => [
                'Cache remote JSON payloads locally using Drift/Isar database with background sync.',
                'Handle network reconnections gracefully with connectivity_plus stream listeners.',
            ],
            '3. 60 FPS Rendering & Memory Management' => [
                'Eliminate unnecessary widget rebuilds using const constructors and select() scoping.',
                'Profile frame rendering times and memory leaks using Dart DevTools Memory & Performance tabs.',
            ]
        ]
    ],
    'swiftui-combine-ios-manual.pdf' => [
        'title' => 'SwiftUI & Combine iOS App Architecture Master Manual',
        'subtitle' => 'Declarative UI, Actor Concurrency, SwiftData & Modular Frameworks',
        'category' => 'iOS Toolkit',
        'sections' => [
            '1. Modern Swift Concurrency & Actors' => [
                'Prevent data races in shared state using Swift Actors (@MainActor and custom actors).',
                'Replace legacy completion handlers with async/await and AsyncSequence streams.',
                'Utilize TaskGroup for structured concurrent network requests.',
            ],
            '2. SwiftUI View Lifecycle & State Management' => [
                'Leverage @Observable macro (Observation framework) for fine-grained UI reactivity.',
                'Persist relational domain data with SwiftData and CoreData schema migrations.',
                'Design adaptive responsive layouts supporting iPhone, iPad, and macOS Catalyst.',
            ],
            '3. App Store Readiness & Security' => [
                'Store sensitive candidate tokens securely in iOS Keychain (Security framework).',
                'Implement App Transport Security (ATS) and Certificate Pinning against MITM attacks.',
            ]
        ]
    ],
    'data-science-bigquery-sql-cheatsheet.pdf' => [
        'title' => 'Data Science, Pandas & BigQuery SQL Performance Cheat Sheet',
        'subtitle' => 'Vectorized Operations, Partitioned Tables, Window Functions & ML Pipelines',
        'category' => 'Data Science',
        'sections' => [
            '1. BigQuery SQL Performance Optimization' => [
                'Partition tables by DATE(_PARTITIONTIME) and cluster by high-cardinality query keys.',
                'Replace subqueries with Common Table Expressions (WITH clauses) and QUALIFY filtering.',
                'Use Analytic Window Functions (ROW_NUMBER(), DENSE_RANK(), LAG(), LEAD()) for trend analytics.',
            ],
            '2. Vectorized Pandas & Polars Analytics' => [
                'Replace slow .apply() iterators with native vectorized numpy and arrow operations.',
                'Optimize memory footprints by downcasting float64/int64 to float32/int32 and Category dtypes.',
                'Leverage Polars lazy execution frames (LazyFrame) for multi-core streaming datasets.',
            ],
            '3. ML Feature Engineering & BigQuery ML' => [
                'Train logistic regression, k-means, and ARIMA+ time-series models directly inside BigQuery.',
                'Evaluate model precision, recall, ROC-AUC, and log-loss without data egress costs.',
            ]
        ]
    ],
    'solidity-smart-contract-security-audit.pdf' => [
        'title' => 'Solidity & EVM Smart Contract Security Auditing Handbook',
        'subtitle' => 'Reentrancy Defense, Flash Loan Resilience, Gas Optimization & Formal Verification',
        'category' => 'Blockchain Security',
        'sections' => [
            '1. Smart Contract Vulnerability Defense' => [
                'Prevent Reentrancy attacks by applying the Checks-Effects-Interactions (CEI) pattern and ReentrancyGuard.',
                'Mitigate Flash Loan Oracle manipulation using Uniswap V3 TWAP (Time-Weighted Average Price).',
                'Avoid Front-Running / MEV extraction with commit-reveal schemes and private mempools.',
            ],
            '2. EVM Gas Optimization Techniques' => [
                'Pack storage variables into 32-byte slots (e.g. uint128 + uint128) to save SSTORE gas.',
                'Use custom errors (error CustomError()) instead of revert strings to save runtime gas.',
                'Cache array lengths in memory during for-loops to eliminate redundant storage reads.',
            ],
            '3. Automated Auditing & Formal Verification' => [
                'Run static security analysis using Slither and Mythril during CI pull request checks.',
                'Write property-based fuzz tests and invariant checks using Foundry (forge test).',
            ]
        ]
    ],
    'github-actions-cicd-security-guide.pdf' => [
        'title' => 'GitHub Actions CI/CD & Automated Security Scanning Guide',
        'subtitle' => 'OIDC AWS Authentication, Matrix Testing, SBOM & Supply-Chain Hardening',
        'category' => 'CI/CD Playbook',
        'sections' => [
            '1. Workflow Hardening & Least Privilege' => [
                'Eliminate static long-lived AWS keys by using GitHub Actions OIDC role assumption.',
                'Set top-level permissions: read-all and grant write permissions only to specific steps.',
                'Pin GitHub Action dependencies to full 40-character commit SHAs instead of mutable tags.',
            ],
            '2. Automated Testing & Matrix Builds' => [
                'Run multi-version PHP / Node / Python test matrices concurrently across Ubuntu runners.',
                'Cache package managers (npm, composer, pip) to reduce pipeline execution times by 70%.',
                'Enforce code coverage thresholds (e.g. min 80%) with automated PR annotations.',
            ],
            '3. Software Supply Chain & Artifact Security' => [
                'Generate Software Bill of Materials (SBOM) with Syft and sign releases with Cosign.',
                'Enforce static secret detection (TruffleHog, Gitleaks) to prevent credential leaks.',
            ]
        ]
    ],
    'autonomous-agents-prompt-engineering.pdf' => [
        'title' => 'Autonomous Agent Multi-Prompt Engineering & LangGraph Handbook',
        'subtitle' => 'Stateful Cyclic Graphs, Tool Execution, ReAct Loops & Token Efficiency',
        'category' => 'AI / ML Handbook',
        'sections' => [
            '1. Agentic Cognitive Architecture & ReAct Loops' => [
                'Implement Thought-Action-Observation loops for multi-step reasoning and tool invocation.',
                'Structure agent memory into Short-term (conversation context) and Long-term (Vector Store).',
                'Utilize LangGraph stateful cyclic graphs to handle human-in-the-loop approvals.',
            ],
            '2. Structured Outputs & Function Calling' => [
                'Enforce deterministic JSON outputs using Pydantic / Zod schema validation constraints.',
                'Implement defensive fallback parsing and retry prompts for malformed model responses.',
                'Minimize token overhead with dynamic tool filtering and system prompt compression.',
            ],
            '3. Multi-Agent Collaboration & Routing' => [
                'Design hierarchical supervisor agents that delegate specialized tasks to subagents.',
                'Measure hallucination rates and grounding fidelity using RAGAS and automated benchmarks.',
            ]
        ]
    ],
    'figma-design-tokens-wcag-checklist.pdf' => [
        'title' => 'Figma Design System Tokens & WCAG 2.2 Accessibility Checklist',
        'subtitle' => 'Color Contrast (4.5:1), Focus Indicators, ARIA Semantics & Responsive Grids',
        'category' => 'UI/UX Design',
        'sections' => [
            '1. WCAG 2.2 Level AA Compliance Guidelines' => [
                'Ensure standard body text meets minimum 4.5:1 contrast ratio against all background modes.',
                'Provide clear, high-visibility 2px focus indicators (:focus-visible) for keyboard navigation.',
                'Ensure minimum touch target dimensions of 44x44px for mobile and touch devices.',
            ],
            '2. Figma Design System & Variable Tokens' => [
                'Structure semantic design tokens: Color (Surface, Text, Border), Spacing, Typography, Radius.',
                'Support seamless Light and Dark mode switching using Figma Variable Modes.',
                'Build accessible interactive components with designated states: Default, Hover, Focus, Disabled.',
            ],
            '3. Assistive Technology & Semantic HTML' => [
                'Verify screen reader landmarks (header, nav, main, aside, footer) and aria-labels.',
                'Ensure proper heading hierarchies (H1 -> H2 -> H3) without skipping levels.',
            ]
        ]
    ],
    'tech-resume-portfolio-ats-template.pdf' => [
        'title' => 'Tech Resume & Portfolio Template Kit (ATS 99% Rated)',
        'subtitle' => 'Applicant Tracking System Scoring, Impact Bullet Formulas & Portfolio Projects',
        'category' => 'Career Templates',
        'sections' => [
            '1. ATS-Compliant Layout & Typography' => [
                'Use standard single-column layout without tables, graphics, or text box columns.',
                'Save as clean, searchable PDF or standard DOCX with plain Unicode characters.',
                'Include essential contact metadata: Name, Email, Phone, LinkedIn, GitHub, Location.',
            ],
            '2. Google XYZ Resume Bullet Formula' => [
                'Format every experience bullet: "Accomplished [X] as measured by [Y], by doing [Z]".',
                'Example: "Reduced API response latency by 45% (220ms -> 120ms) by implementing Redis caching."',
                'Quantify engineering achievements with business impact (revenue, uptime, scale, throughput).',
            ],
            '3. Portfolio Project Showcase Checklist' => [
                'Include live production URL, GitHub repository link, and architecture breakdown.',
                'Highlight technical challenges solved, engineering tradeoffs, and test coverage metrics.',
            ]
        ]
    ],
    'system-design-interview-master-cheatsheet.pdf' => [
        'title' => 'System Design & High-Throughput Interview Master Cheat Sheet',
        'subtitle' => 'CAP Theorem, Sharding, Caching Topologies, Rate Limiting & Consensus',
        'category' => 'Interview Prep',
        'sections' => [
            '1. Distributed System Tradeoffs & CAP Theorem' => [
                'Consistency vs Availability in network partition scenarios (CP vs AP database systems).',
                'PACELC Theorem: In normal state, balance Latency vs Consistency (e.g. DynamoDB vs Spanner).',
                'Understand ACID (Relational SQL) vs BASE (NoSQL Eventual Consistency) paradigms.',
            ],
            '2. Scaling Strategies & Database Sharding' => [
                'Implement Consistent Hashing with virtual nodes to distribute key-value traffic evenly.',
                'Shard databases by User ID or Tenant ID to eliminate single-point bottleneck limits.',
                'Employ Multi-Tier Caching: Edge CDN -> Reverse Proxy -> Redis Cluster -> Local Memory.',
            ],
            '3. Consensus & Message Queuing' => [
                'Understand leader election algorithms: Raft, Paxos, and ZooKeeper Zab protocol.',
                'Compare Kafka (Partitioned log streaming) vs RabbitMQ (AMQP push-based task queues).',
            ]
        ]
    ],
    'tech-lead-principal-architect-playbook.pdf' => [
        'title' => 'Tech Lead & Principal Architect Engineering Playbook 2026',
        'subtitle' => 'RFC Templates, Architecture Decision Records (ADRs), Tech Debt & Team Scaling',
        'category' => 'Leadership Toolkit',
        'sections' => [
            '1. Architecture Decision Records (ADRs)' => [
                'Document engineering decisions with Context, Options Considered, Decision, and Consequences.',
                'Maintain an immutable record of architectural evolution in the repository /docs/adr directory.',
                'Facilitate constructive Request for Comments (RFC) engineering reviews before code commits.',
            ],
            '2. Technical Debt Management & Engineering Metrics' => [
                'Allocate 20% of sprint capacity for refactoring, dependency upgrades, and tech debt reduction.',
                'Track DORA metrics: Deployment Frequency, Lead Time for Changes, Change Failure Rate, MTTR.',
                'Conduct blameless postmortems with root cause analysis (RCA) and actionable action items.',
            ],
            '3. Mentorship, Delegation & Engineering Culture' => [
                'Foster high psychological safety, code review empathy, and constructive architecture feedback.',
                'Establish clear engineering growth ladders (Junior -> Mid -> Senior -> Staff -> Principal).',
            ]
        ]
    ]
];

$generatedCount = 0;
foreach ($resourcesData as $filename => $data) {
    $pdfContent = createSimplePdf($data['title'], $data['subtitle'], $data['category'], $data['sections']);
    foreach ($dirs as $dir) {
        file_put_contents($dir . '/' . $filename, $pdfContent);
    }
    $generatedCount++;
    echo "Generated: " . $filename . " (" . strlen($pdfContent) . " bytes)\n";
}

echo "\nSuccessfully generated " . $generatedCount . " real topic PDFs across storage directories!\n";
