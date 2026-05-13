@extends('layouts.app')
@section('title', 'Messages')
@section('page-title', 'Messages')
@section('content')
<div class="page-header d-flex align-items-center justify-content-between">
    <div><h1>Messages</h1><p>Your conversations with advisors</p></div>
    <a href="{{ route('student.messages.create') }}" class="btn btn-primary d-flex align-items-center gap-2">
        <x-icon name="send" :size="15" /> New Message
    </a>
</div>

<div class="card">
    @if($conversations->isEmpty())
        <div class="card-body">
            <div class="empty-state">
                <x-icon name="message" :size="48" />
                <p class="mt-3 fw-semibold">No conversations yet</p>
                <p>Send a message to your advisor to get started.</p>
                <a href="{{ route('student.messages.create') }}" class="btn btn-primary btn-sm mt-2">Start Conversation</a>
            </div>
        </div>
    @else
        @foreach($conversations as $otherId => $lastMsg)
            @php
                $other = $lastMsg->sender_id === $userId ? $lastMsg->receiver : $lastMsg->sender;
                $unreadCount = \App\Models\Message::where('sender_id', $other->id)
                    ->where('receiver_id', $userId)
                    ->whereNull('read_at')
                    ->count();
                $isUnread = $unreadCount > 0;
            @endphp
            <a href="{{ route('student.messages.thread', $other->id) }}"
               class="d-flex align-items-center gap-3 px-4 py-3 text-decoration-none"
               style="border-bottom:1px solid #f1f5f9;color:inherit;transition:background .15s;background:{{ $isUnread ? '#f8fbff' : 'transparent' }};"
               onmouseover="this.style.background='#f1f5f9'" onmouseout="this.style.background='{{ $isUnread ? '#f8fbff' : 'transparent' }}'">

                <div style="width:44px;height:44px;border-radius:12px;background:#eff6ff;display:flex;align-items:center;justify-content:center;font-weight:700;color:#1a56db;font-size:16px;flex-shrink:0;position:relative;">
                    {{ strtoupper(substr($other->name, 0, 1)) }}
                    @if($isUnread)
                        <span style="position:absolute;top:-3px;right:-3px;width:10px;height:10px;background:#1a56db;border-radius:50%;border:2px solid #fff;"></span>
                    @endif
                </div>

                <div style="flex:1;min-width:0;">
                    <div class="d-flex align-items-center justify-content-between">
                        <span style="font-size:13.5px;font-weight:{{ $isUnread ? '700' : '600' }};color:#1e293b;">{{ $other->name }}</span>
                        <span style="font-size:11.5px;color:#94a3b8;white-space:nowrap;margin-left:8px;">{{ $lastMsg->created_at->diffForHumans() }}</span>
                    </div>
                    <div style="font-size:13px;color:{{ $isUnread ? '#1e293b' : '#64748b' }};font-weight:{{ $isUnread ? '500' : '400' }};overflow:hidden;text-overflow:ellipsis;white-space:nowrap;">
                        @if($lastMsg->sender_id === $userId)<span style="color:#94a3b8;">You: </span>@endif
                        {{ Str::limit($lastMsg->body, 70) }}
                    </div>
                </div>

                @if($isUnread)
                    <span style="min-width:20px;height:20px;padding:0 6px;background:#1a56db;color:#fff;border-radius:10px;font-size:11px;font-weight:700;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                        {{ $unreadCount }}
                    </span>
                @endif
            </a>
        @endforeach
    @endif
</div>
@endsection