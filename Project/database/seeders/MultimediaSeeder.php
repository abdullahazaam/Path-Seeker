<?php

namespace Database\Seeders;

use App\Models\Multimedia;
use Illuminate\Database\Seeder;

class MultimediaSeeder extends Seeder
{
    /**
     * Run the database seeds with high-contrast, vibrant multimedia tracks.
     */
    public function run(): void
    {
        $multimedia = [
            [
                'title' => 'Full-Stack Web Development 2026: Architecture & Frameworks',
                'description' => 'Master modern full-stack web engineering from frontend reactivity (Vue/React) to robust backend APIs (Laravel/Node) and relational databases.',
                'type' => 'video',
                'url' => 'https://www.youtube.com/embed/8mAITcNt710',
                'thumbnail_url' => 'https://images.unsplash.com/photo-1555066931-4365d14bab8c?w=800&auto=format&fit=crop&q=80',
                'duration' => '8:16:00',
                'tags' => 'Software Engineering, Laravel, React, Full-Stack, Web Development',
            ],
            [
                'title' => 'Cloud Solutions Architecture & AWS/GCP Multi-Cloud Blueprint',
                'description' => 'Deep dive into architecting resilient cloud systems, VPC networking, IAM security, and serverless compute paradigms on AWS and Google Cloud.',
                'type' => 'video',
                'url' => 'https://www.youtube.com/embed/NhDYbskXRgc',
                'thumbnail_url' => 'https://images.unsplash.com/photo-1451187580459-43490279c0fa?w=800&auto=format&fit=crop&q=80',
                'duration' => '13:31:00',
                'tags' => 'Cloud, AWS, Kubernetes, Distributed Systems, GCP',
            ],
            [
                'title' => 'Machine Learning & Generative AI Engineering in Production',
                'description' => 'Learn how to train, fine-tune, and deploy transformer models, LLMs, and real-time inference pipelines using PyTorch and MLOps tools.',
                'type' => 'video',
                'url' => 'https://www.youtube.com/embed/i_LwzRVP7bg',
                'thumbnail_url' => 'https://images.unsplash.com/photo-1618005182384-a83a8bd57fbe?w=800&auto=format&fit=crop&q=80',
                'duration' => '2:52:00',
                'tags' => 'Artificial Intelligence, Python, LLMs, Neural Networks, MLOps',
            ],
            [
                'title' => 'Cybersecurity Defense, Ethical Hacking & Perimeter Hardening',
                'description' => 'Essential walkthrough on reconnaissance, vulnerability assessment, penetration testing, network sniffing, and defensive perimeter auditing.',
                'type' => 'video',
                'url' => 'https://www.youtube.com/embed/3Kq1MIfTWCE',
                'thumbnail_url' => 'https://images.unsplash.com/photo-1563986768609-322da13575f3?w=800&auto=format&fit=crop&q=80',
                'duration' => '15:00:00',
                'tags' => 'Cybersecurity, Ethical Hacking, Threat Hunting, Kali Linux',
            ],
            [
                'title' => 'Cross-Platform Mobile Development with Flutter & Dart',
                'description' => 'Step-by-step masterclass on building responsive mobile user interfaces with Flutter and Dart, connecting RESTful backends and local SQLite databases.',
                'type' => 'video',
                'url' => 'https://www.youtube.com/embed/VPvVD8t02U8',
                'thumbnail_url' => 'https://images.unsplash.com/photo-1551650975-87deedd944c3?w=800&auto=format&fit=crop&q=80',
                'duration' => '3:27:00',
                'tags' => 'Mobile Development, Flutter, iOS, Android, Dart',
            ],
            [
                'title' => 'Modern DevOps Pipelines: Docker, Kubernetes & GitHub Actions',
                'description' => 'Comprehensive tutorial on creating automated CI/CD deployment pipelines, containerizing services with Docker, and orchestrating with Kubernetes.',
                'type' => 'video',
                'url' => 'https://www.youtube.com/embed/kTp5xUtcalw',
                'thumbnail_url' => 'https://images.unsplash.com/photo-1667372393119-3d4c48d07fc9?w=800&auto=format&fit=crop&q=80',
                'duration' => '3:08:00',
                'tags' => 'DevOps, CI/CD, Containerization, Automation, Docker',
            ],
            [
                'title' => 'Advanced System Design & Microservices Architecture Masterclass',
                'description' => 'Comprehensive masterclass on designing low-latency distributed architectures, event-driven microservices, database partitioning, and high-availability patterns.',
                'type' => 'video',
                'url' => 'https://www.youtube.com/embed/F2FmTdLtb_4',
                'thumbnail_url' => 'https://images.unsplash.com/photo-1558494949-ef010cbdcc31?w=800&auto=format&fit=crop&q=80',
                'duration' => '1:14:00',
                'tags' => 'Software Engineering, System Design, Microservices, Distributed Systems',
            ],
            [
                'title' => 'Blockchain Engineering: Solidity & Ethereum Smart Contracts',
                'description' => 'Learn to code, test, and audit decentralized smart contracts with Solidity, Hardhat, and Web3.js on the Ethereum Virtual Machine (EVM).',
                'type' => 'video',
                'url' => 'https://www.youtube.com/embed/M576WGiDBdQ',
                'thumbnail_url' => 'https://images.unsplash.com/photo-1639762681485-074b7f938ba0?w=800&auto=format&fit=crop&q=80',
                'duration' => '16:00:00',
                'tags' => 'Blockchain, Solidity, Ethereum, Web3, Smart Contracts',
            ],
            [
                'title' => 'Data Science & Machine Learning with Python: Full Crash Course',
                'description' => 'Complete end-to-end data analysis using Pandas, NumPy, statistical hypothesis testing, Scikit-Learn regression, and interactive dashboarding.',
                'type' => 'video',
                'url' => 'https://www.youtube.com/embed/ua-CiDNNj30',
                'thumbnail_url' => 'https://images.unsplash.com/photo-1551288049-bebda4e38f71?w=800&auto=format&fit=crop&q=80',
                'duration' => '4:00:00',
                'tags' => 'Data Science, Python, Pandas, Analytics, Statistics',
            ],
            [
                'title' => 'Game Engine Programming: Unreal Engine 5 & C++ Foundations',
                'description' => 'Program realistic physics collisions, custom character controllers, dynamic lighting, and HLSL shaders inside Unreal Engine 5.',
                'type' => 'video',
                'url' => 'https://www.youtube.com/embed/ScMzIvxBSi4',
                'thumbnail_url' => 'https://images.unsplash.com/photo-1550745165-9bc0b252726f?w=800&auto=format&fit=crop&q=80',
                'duration' => '5:21:00',
                'tags' => 'Game Development, Unreal Engine 5, C++, 3D Graphics',
            ],
            [
                'title' => 'High-Performance Distributed Systems & Golang Microservices',
                'description' => 'Architecture patterns for low-latency backend systems, event streaming with Apache Kafka, gRPC communication, and distributed caching.',
                'type' => 'video',
                'url' => 'https://www.youtube.com/embed/un6ZyFkqFJU',
                'thumbnail_url' => 'https://images.unsplash.com/photo-1526374965328-7f61d4dc18c5?w=800&auto=format&fit=crop&q=80',
                'duration' => '3:24:00',
                'tags' => 'Software Engineering, Golang, Microservices, Distributed Systems',
            ],
            [
                'title' => 'Big Data Engineering: Apache Spark & Cloud Lakehouse Architecture',
                'description' => 'Build scalable batch and stream data pipelines using Apache Spark, Databricks, Delta Lake, and dbt for enterprise data warehousing.',
                'type' => 'video',
                'url' => 'https://www.youtube.com/embed/_C8kWso4ebw',
                'thumbnail_url' => 'https://images.unsplash.com/photo-1518770660439-4636190af475?w=800&auto=format&fit=crop&q=80',
                'duration' => '4:00:00',
                'tags' => 'Data Science, Big Data, Apache Spark, Databricks, ETL',
            ],
            [
                'title' => 'SOC Analyst & Incident Response: Threat Hunting Masterclass',
                'description' => 'Real-world walkthrough on SIEM log analysis in Splunk, detecting malware lateral movement, and applying the MITRE ATT&CK framework.',
                'type' => 'video',
                'url' => 'https://www.youtube.com/embed/O6y4k5H1_rU',
                'thumbnail_url' => 'https://images.unsplash.com/photo-1550751827-4bd374c3f58b?w=800&auto=format&fit=crop&q=80',
                'duration' => '5:47:00',
                'tags' => 'Cybersecurity, SOC, Splunk, Incident Response, Threat Intelligence',
            ],
            [
                'title' => 'Native iOS Development with Swift & SwiftUI Architecture',
                'description' => 'Build modern declarative user interfaces with SwiftUI, integrate Combine for reactive state management, and implement CoreData caching.',
                'type' => 'video',
                'url' => 'https://www.youtube.com/embed/comQ1-x2a1Q',
                'thumbnail_url' => 'https://images.unsplash.com/photo-1526498460520-4c246339dccb?w=800&auto=format&fit=crop&q=80',
                'duration' => '2:25:00',
                'tags' => 'Mobile Development, Swift, SwiftUI, iOS Architecture',
            ],
            [
                'title' => 'Technical Art & Real-Time VFX in Unreal Engine 5',
                'description' => 'Bridge the gap between art and code with procedural mesh generation, custom Niagara particle systems, and HLSL shader optimization.',
                'type' => 'video',
                'url' => 'https://www.youtube.com/embed/jNQXAC9IVRw',
                'thumbnail_url' => 'https://images.unsplash.com/photo-1508739773434-c26b3d09e071?w=800&auto=format&fit=crop&q=80',
                'duration' => '2:30:00',
                'tags' => 'Game Development, 3D VFX, Technical Art, Niagara, Shaders',
            ],
            [
                'title' => 'Autonomous Multi-Agent AI Systems & LangGraph Masterclass',
                'description' => 'Learn how to build production-grade autonomous agent loops with LangChain, LangGraph, tool-calling capabilities, and persistent memory.',
                'type' => 'video',
                'url' => 'https://www.youtube.com/embed/sal78ACtGTc',
                'thumbnail_url' => 'https://images.unsplash.com/photo-1677442136019-21780efad99a?w=800&auto=format&fit=crop&q=80',
                'duration' => '1:45:00',
                'tags' => 'Artificial Intelligence, Autonomous Agents, LangGraph, Multi-Agent, LLMs',
            ],
            [
                'title' => 'UI/UX Design Systems & Micro-Interactions in Figma 2026',
                'description' => 'Master variable tokens, auto-layout 5.0, interactive component states, WCAG contrast auditing, and seamless developer handoffs in Figma.',
                'type' => 'video',
                'url' => 'https://www.youtube.com/embed/FTFaQWZBqQ8',
                'thumbnail_url' => 'https://images.unsplash.com/photo-1581291518857-4e27b48ff24e?w=800&auto=format&fit=crop&q=80',
                'duration' => '2:15:00',
                'tags' => 'UI/UX Design, Figma, Design Systems, Accessibility, Prototyping',
            ],
            [
                'title' => 'Career Passport Podcast: Transitioning to Global Tech Leadership',
                'description' => 'Industry leaders share insider advice on resumes, portfolio reviews, salary negotiation, and navigating technical interviews.',
                'type' => 'audio',
                'url' => 'https://www.youtube.com/embed/dQw4w9WgXcQ',
                'thumbnail_url' => 'https://images.unsplash.com/photo-1590602847861-f357a9332bbc?w=800&auto=format&fit=crop&q=80',
                'duration' => '45:00',
                'tags' => 'Podcast, Mentorship, Tech Leadership, Career Pivot, Salary Negotiation',
            ],
        ];

        foreach ($multimedia as $item) {
            Multimedia::updateOrCreate(
                ['title' => $item['title']],
                $item
            );
        }
    }
}
