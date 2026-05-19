@extends('layouts.personnel')

@section('title', 'Personnel Dashboard')

@section('vite')
    @vite(['resources/css/personneldashboard.css'])
@endsection

@section('content')
    @if (session('status'))
        <div class="personnel-flash success">{{ session('status') }}</div>
    @endif

    @if ($profile)
        <div class="welcome-box personnel-dashboard-card">
            <div class="personnel-dashboard-header">
                @if ($profile->photo)
                    <img src="{{ asset('storage/' . $profile->photo) }}" alt="{{ $profile->name }}" class="personnel-dashboard-avatar" />
                @else
                    <div class="personnel-dashboard-avatar personnel-dashboard-avatar--placeholder" aria-hidden="true">
                        {{ strtoupper(substr($profile->name, 0, 1)) }}
                    </div>
                @endif
                <div class="personnel-dashboard-intro">
                    <h2>Welcome back, {{ $profile->name }}</h2>
                    <p class="personnel-dashboard-subtitle">Your personnel profile overview</p>
                    <div class="personnel-dashboard-badges">
                        @if ($profile->personnel_type)
                            <span class="personnel-badge personnel-badge--type">{{ $profile->personnel_type }}</span>
                        @endif
                        @if ($profile->assigned_role)
                            <span class="personnel-badge personnel-badge--role">{{ $profile->assigned_role }}</span>
                        @endif
                    </div>
                </div>
            </div>

            <dl class="personnel-details-grid">
                <div class="personnel-detail">
                    <dt>Email</dt>
                    <dd>{{ $profile->email }}</dd>
                </div>
                <div class="personnel-detail">
                    <dt>Phone</dt>
                    <dd>{{ $profile->phone }}</dd>
                </div>
                <div class="personnel-detail">
                    <dt>Age</dt>
                    <dd>{{ $profile->age }}</dd>
                </div>
                <div class="personnel-detail">
                    <dt>Gender</dt>
                    <dd>{{ ucfirst($profile->gender) }}</dd>
                </div>
                <div class="personnel-detail">
                    <dt>Department</dt>
                    <dd>{{ $profile->department }}</dd>
                </div>
                <div class="personnel-detail">
                    <dt>Supervisor</dt>
                    <dd>{{ $profile->supervision_name }}</dd>
                </div>
                <div class="personnel-detail">
                    <dt>Institution</dt>
                    <dd>{{ $profile->institution_name }}</dd>
                </div>
                <div class="personnel-detail">
                    <dt>Company location</dt>
                    <dd>{{ $profile->company_location ?: '—' }}</dd>
                </div>
                <div class="personnel-detail">
                    <dt>Program</dt>
                    <dd>{{ $profile->program ?: '—' }}</dd>
                </div>
                <div class="personnel-detail">
                    <dt>Duration</dt>
                    <dd>{{ $profile->duration }}</dd>
                </div>
                <div class="personnel-detail">
                    <dt>Start date</dt>
                    <dd>{{ $profile->start_date }}</dd>
                </div>
                <div class="personnel-detail">
                    <dt>End date</dt>
                    <dd>{{ $profile->end_date }}</dd>
                </div>
                <div class="personnel-detail personnel-detail--full">
                    <dt>Address</dt>
                    <dd>{{ $profile->address }}</dd>
                </div>
                @if ($profile->bio)
                    <div class="personnel-detail personnel-detail--full">
                        <dt>Bio</dt>
                        <dd>{{ $profile->bio }}</dd>
                    </div>
                @endif
                @if ($profile->remarks)
                    <div class="personnel-detail personnel-detail--full">
                        <dt>Remarks</dt>
                        <dd>{{ $profile->remarks }}</dd>
                    </div>
                @endif
            </dl>
        </div>
    @else
        <div class="welcome-box personnel-dashboard-empty">
            <h2>Welcome, {{ auth()->user()->name }}</h2>
            <p>You do not have a personnel profile on file yet. Create one to see your details here.</p>
            <a href="{{ url('/personnel/add-profile') }}" class="personnel-dashboard-cta">Add your profile</a>
        </div>
    @endif
@endsection
