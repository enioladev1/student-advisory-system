@extends('layouts.app')
@section('title', 'Appointments')
@section('page-title', 'Appointments')
@section('content')
<div class="page-header"><h1>Appointments</h1><p>Review and manage student appointment requests</p></div>
<div class="card">
    @if($appointments->isEmpty())
        <div class="card-body"><div class="empty-state"><x-icon name="calendar" :size="48" /><p class="mt-3">No appointments yet</p></div></div>
    @else
        <div class="table-responsive">
            <table class="table mb-0">
                <thead><tr><th>Student</th><th>Date & Time</th><th>Purpose</th><th>Student Notes</th><th>Status</th><th>Action</th></tr></thead>
                <tbody>
                    @foreach($appointments as $appt)
                    <tr>
                        <td style="font-weight:600;">{{ $appt->student->name }}</td>
                        <td>
                            <div style="font-weight:500;">{{ $appt->appointment_date->format('d M Y') }}</div>
                            <div style="font-size:12px;color:#64748b;">{{ date('h:i A', strtotime($appt->appointment_time)) }}</div>
                        </td>
                        <td>{{ $appt->purpose }}</td>
                        <td style="font-size:12.5px;color:#64748b;">{{ $appt->notes ?? '-' }}</td>
                        <td>
                            <span class="status-badge status-{{ $appt->status }}">{{ ucfirst($appt->status) }}</span>
                            @if($appt->advisor_notes)
                                <div style="font-size:11.5px;color:#64748b;margin-top:4px;font-style:italic;">Note: {{ $appt->advisor_notes }}</div>
                            @endif
                        </td>
                        <td>
                            @if($appt->status === 'pending')
                                <div class="d-flex gap-1 flex-wrap">
                                    <button type="button" class="btn btn-sm btn-outline-success d-flex align-items-center gap-1"
                                        onclick="openModal({{ $appt->id }}, 'approved')">
                                        <x-icon name="check" :size="13" /> Approve
                                    </button>
                                    <button type="button" class="btn btn-sm btn-outline-danger d-flex align-items-center gap-1"
                                        onclick="openModal({{ $appt->id }}, 'rejected')">
                                        <x-icon name="x" :size="13" /> Reject
                                    </button>
                                </div>
                            @elseif($appt->status === 'approved')
                                <button type="button" class="btn btn-sm btn-primary d-flex align-items-center gap-1"
                                    onclick="openModal({{ $appt->id }}, 'completed')">
                                    <x-icon name="check" :size="13" /> Mark Done
                                </button>
                            @else
                                <span style="color:#94a3b8;font-size:12px;">-</span>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-body pt-2">{{ $appointments->links() }}</div>
    @endif
</div>

{{-- Action Modal --}}
<div class="modal fade" id="actionModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered" style="max-width:480px;">
        <div class="modal-content" style="border-radius:14px;border:1px solid #e2e8f0;">
            <div class="modal-header" style="border-bottom:1px solid #e2e8f0;padding:18px 24px;">
                <h5 class="modal-title" id="modalTitle" style="font-size:15px;font-weight:700;">Update Appointment</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="actionForm" method="POST">
                @csrf @method('PATCH')
                <input type="hidden" name="status" id="modalStatus">
                <div class="modal-body" style="padding:20px 24px;">
                    <p id="modalDesc" style="font-size:13.5px;color:#64748b;margin-bottom:16px;"></p>
                    <div>
                        <label class="form-label">Note for Student <span style="font-weight:400;color:#94a3b8;">(optional)</span></label>
                        <textarea name="advisor_notes" id="modalNotes" class="form-control" rows="4"
                            placeholder="e.g. Please bring your result slip. / Appointment rejected due to scheduling conflict."></textarea>
                        <div class="form-text mt-1">This note will be visible to the student under their appointment.</div>
                    </div>
                </div>
                <div class="modal-footer" style="border-top:1px solid #e2e8f0;padding:16px 24px;gap:8px;">
                    <button type="button" class="btn btn-outline-secondary btn-sm" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" id="modalSubmit" class="btn btn-primary btn-sm d-flex align-items-center gap-1">
                        <x-icon name="check" :size="14" /> Confirm
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
const routes = {
    @foreach($appointments as $appt)
    {{ $appt->id }}: "{{ route('advisor.appointments.update', $appt) }}",
    @endforeach
};
const labels = {
    approved:  { title: 'Approve Appointment',    desc: 'The student will be notified that their appointment has been approved.',   btn: 'Approve',   btnClass: 'btn-success' },
    rejected:  { title: 'Reject Appointment',     desc: 'The student will be notified that their appointment has been rejected.',   btn: 'Reject',    btnClass: 'btn-danger'  },
    completed: { title: 'Mark as Completed',      desc: 'Mark this appointment as completed. You can leave a summary note below.', btn: 'Mark Done', btnClass: 'btn-primary' },
};
function openModal(id, status) {
    const cfg = labels[status];
    document.getElementById('actionForm').action = routes[id];
    document.getElementById('modalStatus').value = status;
    document.getElementById('modalTitle').textContent = cfg.title;
    document.getElementById('modalDesc').textContent = cfg.desc;
    document.getElementById('modalNotes').value = '';
    const btn = document.getElementById('modalSubmit');
    btn.className = 'btn btn-sm d-flex align-items-center gap-1 ' + cfg.btnClass;
    btn.querySelector('span') ? null : null;
    btn.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg> ' + cfg.btn;
    new bootstrap.Modal(document.getElementById('actionModal')).show();
}
</script>
@endpush
@endsection