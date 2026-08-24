<?php

namespace Database\Seeders;

use App\Models\Resource;
use Illuminate\Database\Seeder;

class ResourceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $resources = [
            [
                'title' => 'React & Next.js 15 Enterprise Architecture Blueprint',
                'category' => 'Architecture PDF',
                'file_url' => 'https://www.w3.org/WAI/ER/tests/xhtml/testfiles/resources/pdf/dummy.pdf',
                'thumbnail_url' => 'https://images.unsplash.com/photo-1633356122544-f134324a6cee?w=800&auto=format&fit=crop&q=80',
            ],
            [
                'title' => 'AWS Certified Solutions Architect (SAA-C03) Mega Cheat Sheet',
                'category' => 'Cloud Cheat Sheet',
                'file_url' => 'https://www.w3.org/WAI/ER/tests/xhtml/testfiles/resources/pdf/dummy.pdf',
                'thumbnail_url' => 'https://images.unsplash.com/photo-1451187580459-43490279c0fa?w=800&auto=format&fit=crop&q=80',
            ],
            [
                'title' => 'Node.js & Express Enterprise Backend Engineering Handbook',
                'category' => 'Backend Guide',
                'file_url' => 'https://www.w3.org/WAI/ER/tests/xhtml/testfiles/resources/pdf/dummy.pdf',
                'thumbnail_url' => 'https://images.unsplash.com/photo-1558494949-ef010cbdcc31?w=800&auto=format&fit=crop&q=80',
            ],
            [
                'title' => 'Kubernetes & Docker Production Orchestration Playbook',
                'category' => 'DevOps Playbook',
                'file_url' => 'https://www.w3.org/WAI/ER/tests/xhtml/testfiles/resources/pdf/dummy.pdf',
                'thumbnail_url' => 'https://images.unsplash.com/photo-1618401471353-b98afee0b2eb?w=800&auto=format&fit=crop&q=80',
            ],
            [
                'title' => 'PyTorch & Transformer Deep Learning Mathematics Guide',
                'category' => 'AI / ML Handbook',
                'file_url' => 'https://www.w3.org/WAI/ER/tests/xhtml/testfiles/resources/pdf/dummy.pdf',
                'thumbnail_url' => 'https://images.unsplash.com/photo-1620712943543-bcc4688e7485?w=800&auto=format&fit=crop&q=80',
            ],
            [
                'title' => 'Cybersecurity Ethical Hacking, Burp Suite & Kali Linux Manual',
                'category' => 'Security Manual',
                'file_url' => 'https://www.w3.org/WAI/ER/tests/xhtml/testfiles/resources/pdf/dummy.pdf',
                'thumbnail_url' => 'https://images.unsplash.com/photo-1550751827-4bd374c3f58b?w=800&auto=format&fit=crop&q=80',
            ],
            [
                'title' => 'Laravel 12 Domain-Driven Design & Clean Architecture PDF',
                'category' => 'E-Book / Guide',
                'file_url' => 'https://www.w3.org/WAI/ER/tests/xhtml/testfiles/resources/pdf/dummy.pdf',
                'thumbnail_url' => 'https://images.unsplash.com/photo-1498050108023-c5249f4df085?w=800&auto=format&fit=crop&q=80',
            ],
            [
                'title' => 'Golang High-Concurrency Microservices & gRPC Patterns',
                'category' => 'Systems Handbook',
                'file_url' => 'https://www.w3.org/WAI/ER/tests/xhtml/testfiles/resources/pdf/dummy.pdf',
                'thumbnail_url' => 'https://images.unsplash.com/photo-1526374965328-7f61d4dc18c5?w=800&auto=format&fit=crop&q=80',
            ],
            [
                'title' => 'Flutter & Dart Mobile Clean Architecture & Riverpod Blueprint',
                'category' => 'Mobile Architecture',
                'file_url' => 'https://www.w3.org/WAI/ER/tests/xhtml/testfiles/resources/pdf/dummy.pdf',
                'thumbnail_url' => 'https://images.unsplash.com/photo-1512941937669-90a1b58e7e9c?w=800&auto=format&fit=crop&q=80',
            ],
            [
                'title' => 'SwiftUI & Combine iOS App Architecture Master Manual',
                'category' => 'iOS Toolkit',
                'file_url' => 'https://www.w3.org/WAI/ER/tests/xhtml/testfiles/resources/pdf/dummy.pdf',
                'thumbnail_url' => 'https://images.unsplash.com/photo-1526498460520-4c246339dccb?w=800&auto=format&fit=crop&q=80',
            ],
            [
                'title' => 'Data Science, Pandas & BigQuery SQL Performance Cheat Sheet',
                'category' => 'Data Science',
                'file_url' => 'https://www.w3.org/WAI/ER/tests/xhtml/testfiles/resources/pdf/dummy.pdf',
                'thumbnail_url' => 'https://images.unsplash.com/photo-1551288049-bebda4e38f71?w=800&auto=format&fit=crop&q=80',
            ],
            [
                'title' => 'Solidity & EVM Smart Contract Security Auditing Handbook',
                'category' => 'Blockchain Security',
                'file_url' => 'https://www.w3.org/WAI/ER/tests/xhtml/testfiles/resources/pdf/dummy.pdf',
                'thumbnail_url' => 'https://images.unsplash.com/photo-1639762681485-074b7f938ba0?w=800&auto=format&fit=crop&q=80',
            ],
            [
                'title' => 'GitHub Actions CI/CD & Automated Security Scanning Guide',
                'category' => 'CI/CD Playbook',
                'file_url' => 'https://www.w3.org/WAI/ER/tests/xhtml/testfiles/resources/pdf/dummy.pdf',
                'thumbnail_url' => 'https://images.unsplash.com/photo-1504639725590-34d0984388bd?w=800&auto=format&fit=crop&q=80',
            ],
            [
                'title' => 'Tech Resume & Portfolio Template Kit (ATS 99% Rated)',
                'category' => 'Career Templates',
                'file_url' => 'https://www.w3.org/WAI/ER/tests/xhtml/testfiles/resources/pdf/dummy.pdf',
                'thumbnail_url' => 'https://images.unsplash.com/photo-1586281380349-632531db7ed4?w=800&auto=format&fit=crop&q=80',
            ],
            [
                'title' => 'System Design & High-Throughput Interview Master Cheat Sheet',
                'category' => 'Interview Prep',
                'file_url' => 'https://www.w3.org/WAI/ER/tests/xhtml/testfiles/resources/pdf/dummy.pdf',
                'thumbnail_url' => 'https://images.unsplash.com/photo-1517694712202-14dd9538aa97?w=800&auto=format&fit=crop&q=80',
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