@extends('layouts.app')
@section('title', 'New Message')
@section('page-title', 'New Message')
@section('content')
<div class="page-header"><h1>New Message</h1><p>Send a message to your advisor</p></div>
<div class="row justify-content-center">
<div class="col-lg-7">
<div class="card">
    <div class="card-body">
        @if($advisors->isEmpty())
            <div class="alert alert-warning d-flex gap-2"><x-icon name="alert" :size="16" /> No advisor assigned. Contact the admin office.</div>
        @else
        <form method="POST" action="{{ route('student.messages.store') }}">
            @csrf
            <div class="mb-3">
                <label class="form-label">To</label>
                <select name="receiver_id" class="form-select @error('receiver_id') is-invalid @enderror" required>
                    <option value="">Select recipient...</option>
                    @foreach($advisors as $adv)
                        <option value="{{ $adv->id }}" {{ old('receiver_id')==$adv->id ? 'selected' : '' }}>{{ $adv->name }}</option>
                    @endforeach
                </select>
                @error('receiver_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="mb-3">
                <label class="form-label">Subject</label>
                <input type="text" name="subject" value="{{ old('subject') }}" class="form-control @error('subject') is-invalid @enderror" placeholder="Message subject..." required>
                @error('subject')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="mb-4">
                <label class="form-label">Message</label>
                <textarea name="body" class="form-control @error('body') is-invalid @enderror" rows="6" placeholder="Write your message here..." required>{{ old('body') }}</textarea>
                @error('body')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary d-flex align-items-center gap-2"><x-icon name="send" :size="15" /> Send Message</button>
                <a href="{{ route('student.messages.index') }}" class="btn btn-outline-secondary">Cancel</a>
            </div>
        </form>
        @endif
    </div>
</div>
</div>
</div>
@endsection