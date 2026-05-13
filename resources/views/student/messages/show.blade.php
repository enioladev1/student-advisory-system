@extends('layouts.app')
@section('title', 'Chat with '.$user->name)
@section('page-title', 'Messages')
@section('content')
<div class="page-header d-flex align-items-center gap-3">
    <a href="{{ route('student.messages.index') }}" class="btn btn-outline-secondary btn-sm d-flex align-items-center gap-1">
        <x-icon name="arrow-left" :size="14" /> Back
    </a>
    <div class="d-flex align-items-center gap-3">
        <div style="width:40px;height:40px;border-radius:10px;background:#eff6ff;display:flex;align-items:center;justify-content:center;font-weight:700;color:#1a56db;font-size:16px;flex-shrink:0;">
            {{ strtoupper(substr($user->name,0,1)) }}
        </div>
        <div>
            <h1 style="font-size:18px;margin:0;">{{ $user->name }}</h1>
            <p style="margin:2px 0 0;font-size:12.5px;color:#64748b;">
                @if($user->advisorProfile) {{ $user->advisorProfile->department }} @endif
            </p>
        </div>
    </div>
</div>

<div class="card" style="display:flex;flex-direction:column;">
    {{-- Message thread --}}
    <div id="threadContainer" style="padding:20px;display:flex;flex-direction:column;gap:12px;min-height:300px;max-height:520px;overflow-y:auto;">
        @if($thread->isEmpty())
            <div class="empty-state"><p>No messages yet. Say hello!</p></div>
        @else
            @foreach($thread as $msg)
                @php $isMine = $msg->sender_id === auth()->id(); @endphp
                <div style="display:flex;flex-direction:column;align-items:{{ $isMine ? 'flex-end' : 'flex-start' }};">
                    {{-- Subject label (first message or subject changed) --}}
                    @if($loop->first || $msg->subject !== $thread[$loop->index-1]->subject)
                        <div style="font-size:11px;color:#94a3b8;margin-bottom:4px;{{ $isMine ? 'text-align:right;' : '' }}">
                            {{ $msg->subject }}
                        </div>
                    @endif
                    <div style="max-width:72%;padding:12px 16px;border-radius:{{ $isMine ? '16px 4px 16px 16px' : '4px 16px 16px 16px' }};background:{{ $isMine ? '#1a56db' : '#f1f5f9' }};color:{{ $isMine ? '#fff' : '#1e293b' }};font-size:13.5px;line-height:1.6;word-break:break-word;">
                        {{ $msg->body }}
                    </div>
                    <div style="font-size:11px;color:#94a3b8;margin-top:4px;{{ $isMine ? 'text-align:right;' : '' }}">
                        {{ $msg->created_at->format('d M Y, h:i A') }}
                        @if($isMine && $msg->read_at)
                            &middot; <span style="color:#16a34a;">Read</span>
                        @endif
                    </div>
                </div>
            @endforeach
        @endif
    </div>

    {{-- Reply form --}}
    <div style="border-top:1px solid #e2e8f0;padding:16px 20px;">
        <form method="POST" action="{{ route('student.messages.store') }}" id="replyForm">
            @csrf
            <input type="hidden" name="receiver_id" value="{{ $user->id }}">
            @php
                $baseSubject = $thread->first()?->subject ?? 'Conversation';
                $baseSubject = preg_replace('/^(Re:\s+)+/i', '', $baseSubject);
                $replySubject = 'Re: ' . $baseSubject;
            @endphp
            <input type="hidden" name="subject" value="{{ $replySubject }}">
            <div class="d-flex gap-2 align-items-end">
                <textarea name="body" id="replyBody" class="form-control" rows="2"
                    placeholder="Write a message..." required
                    style="resize:none;border-radius:10px;font-size:13.5px;"
                    onkeydown="if(event.ctrlKey&&event.key==='Enter'){this.form.submit();}"></textarea>
                <button type="submit" class="btn btn-primary d-flex align-items-center gap-1" style="height:42px;white-space:nowrap;">
                    <x-icon name="send" :size="15" /> Send
                </button>
            </div>
            <div style="font-size:11.5px;color:#94a3b8;margin-top:6px;">Ctrl+Enter to send</div>
        </form>
    </div>
</div>

@push('scripts')
<script>
    // Auto-scroll to bottom of thread
    const tc = document.getElementById('threadContainer');
    if (tc) tc.scrollTop = tc.scrollHeight;
</script>
@endpush
@endsection