<?php

namespace App\Services;

use App\Models\Bulletin;
use App\Models\BulletinSend;
use App\Models\Member;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class BulletinDispatcherService
{
    /**
     * Prepares queue sends for all active members with valid email addresses.
     */
    public function prepareSends(Bulletin $bulletin): int
    {
        $members = Member::where('is_active', true)
            ->whereNotNull('email')
            ->where('email', '!=', '')
            ->get();

        $count = 0;
        foreach ($members as $member) {
            BulletinSend::updateOrCreate(
                [
                    'bulletin_id' => $bulletin->id,
                    'member_id' => $member->id,
                ],
                [
                    'email' => $member->email,
                    'status' => 'pending',
                ]
            );
            $count++;
        }

        $bulletin->update([
            'status' => 'sending',
            'total_recipients' => $count,
            'sent_count' => 0,
        ]);

        return $count;
    }

    /**
     * Processes next batch of pending sends for a bulletin with rate-limiting safety.
     */
    public function processBatch(Bulletin $bulletin, int $limit = 5): array
    {
        $pendingSends = BulletinSend::where('bulletin_id', $bulletin->id)
            ->where('status', 'pending')
            ->take($limit)
            ->get();

        $processed = 0;
        foreach ($pendingSends as $send) {
            try {
                // Send email using Laravel Mailer
                Mail::html($bulletin->content_html, function ($message) use ($send, $bulletin) {
                    $message->to($send->email)
                        ->subject($bulletin->subject)
                        ->from('boletin@gae-ag.cl', 'GAE AG - Asociación Gremial');
                });

                $send->update([
                    'status' => 'sent',
                    'sent_at' => now(),
                    'error_message' => null,
                ]);

                $bulletin->increment('sent_count');
                $processed++;
            } catch (\Exception $e) {
                Log::error("Failed to send bulletin {$bulletin->id} to {$send->email}: " . $e->getMessage());
                
                $send->update([
                    'status' => 'failed',
                    'error_message' => $e->getMessage(),
                ]);
            }
        }

        // Check if all sends are completed
        $remaining = BulletinSend::where('bulletin_id', $bulletin->id)
            ->where('status', 'pending')
            ->count();

        if ($remaining === 0) {
            $bulletin->update([
                'status' => 'sent',
                'sent_at' => now(),
            ]);
        }

        return [
            'processed' => $processed,
            'remaining' => $remaining,
            'status' => $bulletin->fresh()->status,
        ];
    }
}
