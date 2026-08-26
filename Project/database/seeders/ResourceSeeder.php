<?php

namespace Database\Seeders;

use App\Models\Resource;
use Illuminate\Database\Seeder;

class ResourceSeeder extends Seeder
{
    /**
     * Run the database seeds with 2026-ready enterprise technical toolkits.
     */
    public function run(): void
    {
        $resources = [
            [
                'title' => 'React & Next.js 15 Enterprise Architecture Blueprint',
                'category' => 'Architecture PDF',
                'description' => 'Comprehensive enterprise guide covering Server Components, streaming SSR, state management, and edge deployment topologies.',
                'file_url' => '/storage/resources/pdfs/react-nextjs-enterprise-blueprint.pdf',
                'thumbnail_url' => 'https://images.unsplash.com/photo-1633356122544-f134324a6cee?w=800&auto=format&fit=crop&q=80',
            ],
            [
                'title' => 'AWS Certified Solutions Architect (SAA-C03) Mega Cheat Sheet',
                'category' => 'Cloud Cheat Sheet',
                'description' => 'High-yield exam review covering multi-region VPCs, IAM policies, RDS Aurora failovers, and cost optimization architectures.',
                'file_url' => '/storage/resources/pdfs/aws-solutions-architect-cheatsheet.pdf',
                'thumbnail_url' => 'https://images.unsplash.com/photo-1451187580459-43490279c0fa?w=800&auto=format&fit=crop&q=80',
            ],
            [
                'title' => 'Node.js & Express Enterprise Backend Engineering Handbook',
                'category' => 'Backend Guide',
                'description' => 'Event-loop performance tuning, clustering, Redis caching patterns, and zero-downtime microservice architecture guidelines.',
                'file_url' => '/storage/resources/pdfs/nodejs-backend-engineering-handbook.pdf',
                'thumbnail_url' => 'https://images.unsplash.com/photo-1558494949-ef010cbdcc31?w=800&auto=format&fit=crop&q=80',
            ],
            [
                'title' => 'Kubernetes & Docker Production Orchestration Playbook',
                'category' => 'DevOps Playbook',
                'description' => 'Production containerization workflows, Helm charts, ingress controllers, HPA autoscaling, and zero-trust network policies.',
                'file_url' => '/storage/resources/pdfs/kubernetes-docker-playbook.pdf',
                'thumbnail_url' => 'https://images.unsplash.com/photo-1667372393119-3d4c48d07fc9?w=800&auto=format&fit=crop&q=80',
            ],
            [
                'title' => 'PyTorch & Transformer Deep Learning Mathematics Guide',
                'category' => 'AI / ML Handbook',
                'description' => 'Mathematical foundations of multi-head self-attention, backpropagation calculus, and gradient clipping for production training.',
                'file_url' => '/storage/resources/pdfs/pytorch-transformer-handbook.pdf',
                'thumbnail_url' => 'https://images.unsplash.com/photo-1618005182384-a83a8bd57fbe?w=800&auto=format&fit=crop&q=80',
            ],
            [
                'title' => 'Cybersecurity Ethical Hacking, Burp Suite & Kali Linux Manual',
                'category' => 'Security Manual',
                'description' => 'Hands-on penetration testing methodologies, OWASP Top 10 exploits, reverse engineering, and threat defense tactics.',
                'file_url' => '/storage/resources/pdfs/cybersecurity-ethical-hacking-checklist.pdf',
                'thumbnail_url' => 'https://images.unsplash.com/photo-1563986768609-322da13575f3?w=800&auto=format&fit=crop&q=80',
            ],
            [
                'title' => 'Laravel 12 Domain-Driven Design & Clean Architecture PDF',
                'category' => 'E-Book / Guide',
                'description' => 'Decoupling business logic with Action classes, DTOs, custom Eloquent builders, and transactional event listeners.',
                'file_url' => '/storage/resources/pdfs/laravel-domain-driven-design-guide.pdf',
                'thumbnail_url' => 'https://images.unsplash.com/photo-1555066931-4365d14bab8c?w=800&auto=format&fit=crop&q=80',
            ],
            [
                'title' => 'Golang High-Concurrency Microservices & gRPC Patterns',
                'category' => 'Systems Handbook',
                'description' => 'Goroutines concurrency orchestration, sync channels, Protobuf contracts, and low-latency gRPC stream multiplexing.',
                'file_url' => '/storage/resources/pdfs/golang-microservices-grpc-patterns.pdf',
                'thumbnail_url' => 'https://images.unsplash.com/photo-1526374965328-7f61d4dc18c5?w=800&auto=format&fit=crop&q=80',
            ],
            [
                'title' => 'Flutter & Dart Mobile Clean Architecture & Riverpod Blueprint',
                'category' => 'Mobile Architecture',
                'description' => 'Declarative state management, immutable domain models, offline-first SQLite synchronization, and native platform channels.',
                'file_url' => '/storage/resources/pdfs/flutter-clean-architecture-blueprint.pdf',
                'thumbnail_url' => 'https://images.unsplash.com/photo-1551650975-87deedd944c3?w=800&auto=format&fit=crop&q=80',
            ],
            [
                'title' => 'SwiftUI & Combine iOS App Architecture Master Manual',
                'category' => 'iOS Toolkit',
                'description' => 'Modern iOS declarative layout hierarchies, async/await concurrency, CoreData persistent stores, and biometric auth flows.',
                'file_url' => '/storage/resources/pdfs/swiftui-combine-ios-manual.pdf',
                'thumbnail_url' => 'https://images.unsplash.com/photo-1526498460520-4c246339dccb?w=800&auto=format&fit=crop&q=80',
            ],
            [
                'title' => 'Data Science, Pandas & BigQuery SQL Performance Cheat Sheet',
                'category' => 'Data Science',
                'description' => 'Optimizing billion-row partitioning, vectorized dataframe aggregations, window functions, and predictive data pipelines.',
                'file_url' => '/storage/resources/pdfs/data-science-bigquery-sql-cheatsheet.pdf',
                'thumbnail_url' => 'https://images.unsplash.com/photo-1551288049-bebda4e38f71?w=800&auto=format&fit=crop&q=80',
            ],
            [
                'title' => 'Solidity & EVM Smart Contract Security Auditing Handbook',
                'category' => 'Blockchain Security',
                'description' => 'Reentrancy defense, flash-loan attack prevention, gas optimization assembly tricks, and formal verification auditing.',
                'file_url' => '/storage/resources/pdfs/solidity-smart-contract-security-audit.pdf',
                'thumbnail_url' => 'https://images.unsplash.com/photo-1639762681485-074b7f938ba0?w=800&auto=format&fit=crop&q=80',
            ],
            [
                'title' => 'GitHub Actions CI/CD & Automated Security Scanning Guide',
                'category' => 'CI/CD Playbook',
                'description' => 'Automated matrix testing, Trivy vulnerability scans, SonarQube quality gates, and automated blue-green deployments.',
                'file_url' => '/storage/resources/pdfs/github-actions-cicd-security-guide.pdf',
                'thumbnail_url' => 'https://images.unsplash.com/photo-1618401471353-b98afee0b2eb?w=800&auto=format&fit=crop&q=80',
            ],
            [
                'title' => 'Autonomous Agent Multi-Prompt Engineering & LangGraph Handbook',
                'category' => 'AI / ML Handbook',
                'description' => 'Cyclic multi-agent orchestration, state persistence graphs, tool-calling validation, and contextual RAG memory systems.',
                'file_url' => '/storage/resources/pdfs/autonomous-agents-prompt-engineering.pdf',
                'thumbnail_url' => 'https://images.unsplash.com/photo-1677442136019-21780efad99a?w=800&auto=format&fit=crop&q=80',
            ],
            [
                'title' => 'Figma Design System Tokens & WCAG 2.2 Accessibility Checklist',
                'category' => 'UI/UX Design',
                'description' => 'Scalable design token hierarchies, dark-mode variable modes, semantic typography scales, and keyboard focus states.',
                'file_url' => '/storage/resources/pdfs/figma-design-tokens-wcag-checklist.pdf',
                'thumbnail_url' => 'https://images.unsplash.com/photo-1581291518857-4e27b48ff24e?w=800&auto=format&fit=crop&q=80',
            ],
            [
                'title' => 'Tech Resume & Portfolio Template Kit (ATS 99% Rated)',
                'category' => 'Career Templates',
                'description' => 'Silicon Valley formatted resumes, impact-driven bullet point formulas, and portfolio architecture templates.',
                'file_url' => '/storage/resources/pdfs/tech-resume-portfolio-ats-template.pdf',
                'thumbnail_url' => 'https://images.unsplash.com/photo-1586281380349-632531db7ed4?w=800&auto=format&fit=crop&q=80',
            ],
            [
                'title' => 'System Design & High-Throughput Interview Master Cheat Sheet',
                'category' => 'Interview Prep',
                'description' => 'Load balancing topologies, database sharding, CAP theorem trade-offs, rate limiters, and distributed cache design.',
                'file_url' => '/storage/resources/pdfs/system-design-interview-master-cheatsheet.pdf',
                'thumbnail_url' => 'https://images.unsplash.com/photo-1517694712202-14dd9538aa97?w=800&auto=format&fit=crop&q=80',
            ],
            [
                'title' => 'Tech Lead & Principal Architect Engineering Playbook 2026',
                'category' => 'Leadership Toolkit',
                'description' => 'Technical RFC drafting, architectural decision records (ADRs), engineering team scaling, and tech debt management.',
                'file_url' => '/storage/resources/pdfs/tech-lead-principal-architect-playbook.pdf',
                'thumbnail_url' => 'https://images.unsplash.com/photo-1531403009284-440f080d1e12?w=800&auto=format&fit=crop&q=80',
            ],
        ];

        foreach ($resources as $res) {
            Resource::updateOrCreate(
                ['title' => $res['title']],
                $res
            );
        }
    }
}
