<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class FileUploadController extends Controller
{
    /**
     * Forbidden executable / dangerous file extensions.
     */
    protected const DISALLOWED_EXTENSIONS = [
        'php', 'phtml', 'phar', 'php3', 'php4', 'php5', 'php7', 'phps',
        'exe', 'bat', 'cmd', 'sh', 'bash', 'bin', 'cgi', 'pl', 'py', 'js',
        'svg', 'htm', 'html', 'jar', 'vbs', 'scr', 'dll', 'so',
    ];

    /**
     * Allowed MIME types for candidate resumes and portfolio documents.
     */
    protected const ALLOWED_MIMES = [
        'application/pdf',
        'application/msword',
        'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
        'text/plain',
    ];

    /**
     * Secure file upload endpoint with strict MIME verification, extension deny-list,
     * randomized filename hashing, and private storage isolation.
     */
    public function uploadResume(Request $request): JsonResponse
    {
        $request->validate([
            'resume' => 'required|file|max:5120', // Max 5MB
        ]);

        $file = $request->file('resume');

        if (!$file->isValid()) {
            return response()->json(['error' => 'Invalid file upload.'], 422);
        }

        // 1. Real MIME type verification
        $mime = $file->getMimeType();
        if (!in_array($mime, self::ALLOWED_MIMES, true)) {
            Log::warning('File upload rejected: disallowed MIME type', [
                'user_id' => auth()->id(),
                'detected_mime' => $mime,
                'client_name' => $file->getClientOriginalName(),
            ]);
            return response()->json(['error' => 'Unsupported document format. Only PDF, DOC, DOCX, and TXT are permitted.'], 422);
        }

        // 2. Extension validation & executable rejection
        $ext = strtolower($file->getClientOriginalExtension());
        if (in_array($ext, self::DISALLOWED_EXTENSIONS, true)) {
            Log::alert('Security Alert: Executable file upload attempt blocked', [
                'user_id' => auth()->id(),
                'extension' => $ext,
                'client_name' => $file->getClientOriginalName(),
                'ip' => $request->ip(),
            ]);
            return response()->json(['error' => 'Executable or script uploads are strictly prohibited.'], 403);
        }

        // 3. Cryptographically random filename generation (prevents directory traversal / overwriting)
        $safeFileName = Str::random(40) . '.' . $ext;

        // 4. Store in secure private directory
        $path = $file->storeAs('private/resumes/' . auth()->id(), $safeFileName);

        Log::info('Candidate resume securely uploaded', [
            'user_id' => auth()->id(),
            'safe_filename' => $safeFileName,
            'size' => $file->getSize(),
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Document uploaded securely.',
            'filename' => $safeFileName,
            'file_size' => $file->getSize(),
        ]);
    }
}
