@extends('layouts.app')
@section('title', 'Add Course')
@section('page-title', 'Add Course')
@section('content')
<div class="page-header">
    <a href="{{ route('admin.courses.index') }}" class="btn btn-outline-secondary btn-sm d-inline-flex align-items-center gap-1 mb-3">
        <x-icon name="arrow-left" :size="14" /> Back
    </a>
    <h1>Add New Course</h1>
</div>
<div class="row justify-content-center">
<div class="col-lg-7">
<div class="card">
    <div class="card-body">
        <form method="POST" action="{{ route('admin.courses.store') }}">
            @csrf
            <div class="row g-3">
                <div class="col-md-4">
                    <label class="form-label">Course Code</label>
                    <input type="text" name="code" value="{{ old('code') }}" class="form-control @error('code') is-invalid @enderror" placeholder="CSC 101" required>
                    @error('code')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-8">
                    <label class="form-label">Course Title</label>
                    <input type="text" name="title" value="{{ old('title') }}" class="form-control @error('title') is-invalid @enderror" placeholder="Introduction to Programming" required>
                    @error('title')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-4">
                    <label class="form-label">Credit Units</label>
                    <input type="number" name="credit_units" value="{{ old('credit_units', 3) }}" class="form-control @error('credit_units') is-invalid @enderror" min="1" max="6" required>
                    @error('credit_units')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-4">
                    <label class="form-label">Semester</label>
                    <select name="semester" class="form-select @error('semester') is-invalid @enderror" required>
                        <option value="First" {{ old('semester')=='First'?'selected':'' }}>First Semester</option>
                        <option value="Second" {{ old('semester')=='Second'?'selected':'' }}>Second Semester</option>
                    </select>
                    @error('semester')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-4">
                    <label class="form-label">Level</label>
                    <select name="level" class="form-select @error('level') is-invalid @enderror" required>
                        @foreach(['100','200','300','400'] as $l)
                            <option value="{{ $l }}" {{ old('level')==$l?'selected':'' }}>{{ $l }}</option>
                        @endforeach
                    </select>
                    @error('level')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-8">
                    <label class="form-label">Department</label>
                    <input type="text" name="department" value="{{ old('department') }}" class="form-control @error('department') is-invalid @enderror" required>
                    @error('department')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-4">
                    <label class="form-label">Type</label>
                    <select name="is_compulsory" class="form-select">
                        <option value="1" {{ old('is_compulsory','1')=='1'?'selected':'' }}>Compulsory</option>
                        <option value="0" {{ old('is_compulsory')=='0'?'selected':'' }}>Elective</option>
                    </select>
                </div>
                <div class="col-12 mt-1">
                    <button type="submit" class="btn btn-primary d-inline-flex align-items-center gap-2">
                        <x-icon name="plus" :size="16" /> Add Course
                    </button>
                    <a href="{{ route('admin.courses.index') }}" class="btn btn-outline-secondary ms-2">Cancel</a>
                </div>
            </div>
        </form>
    </div>
</div>
</div>
</div>
@endsection