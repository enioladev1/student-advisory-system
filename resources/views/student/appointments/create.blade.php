@extends('layouts.app')
@section('title', 'Book Appointment')
@section('page-title', 'Book Appointment')
@section('content')
<div class="page-header">
    <h1>Book an Appointment</h1>
    <p>Request a session with your academic advisor</p>
</div>
<div class="row justify-content-center">
<div class="col-lg-7">
<div class="card">
    <div class="card-body">
        @if($advisors->isEmpty())
            <div class="alert alert-warning d-flex gap-2"><x-icon name="alert" :size="16" /> No advisor has been assigned to you yet. Please contact the admin office.</div>
        @else
        <form method="POST" action="{{ route('student.appointments.store') }}">
            @csrf
            <div class="mb-3">
                <label class="form-label">Select Advisor</label>
                <select name="advisor_id" class="form-select @error('advisor_id') is-invalid @enderror" required>
                    <option value="">Choose advisor...</option>
                    @foreach($advisors as $advisor)
                        <option value="{{ $advisor->id }}" {{ old('advisor_id')==$advisor->id ? 'selected' : '' }}>
                            {{ $advisor->name }}{{ $advisor->advisorProfile ? ' - '.$advisor->advisorProfile->department : '' }}
                        </option>
                    @endforeach
                </select>
                @error('advisor_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="row g-3 mb-3">
                <div class="col-md-6">
                    <label class="form-label">Date</label>
                    <input type="date" name="appointment_date" value="{{ old('appointment_date') }}" class="form-control @error('appointment_date') is-invalid @enderror" min="{{ date('Y-m-d', strtotime('+1 day')) }}" required>
                    @error('appointment_date')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label">Preferred Time</label>
                    <input type="time" name="appointment_time" value="{{ old('appointment_time') }}" class="form-control @error('appointment_time') is-invalid @enderror" required>
                    @error('appointment_time')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label">Purpose of Meeting</label>
                <input type="text" name="purpose" value="{{ old('purpose') }}" class="form-control @error('purpose') is-invalid @enderror" placeholder="e.g. Course registration, Result query, Academic progress review" required>
                @error('purpose')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="mb-4">
                <label class="form-label">Additional Notes <span class="text-muted fw-normal">(optional)</span></label>
                <textarea name="notes" class="form-control @error('notes') is-invalid @enderror" rows="3" placeholder="Any specific topics or concerns you want to discuss...">{{ old('notes') }}</textarea>
                @error('notes')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary d-flex align-items-center gap-2">
                    <x-icon name="send" :size="15" /> Submit Request
                </button>
                <a href="{{ route('student.appointments.index') }}" class="btn btn-outline-secondary">Cancel</a>
            </div>
        </form>
        @endif
    </div>
</div>
</div>
</div>
@endsection