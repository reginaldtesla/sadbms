@extends('layouts.admin')

@section('title', 'Admin Dashboard - Remove Profile')

@section('vite')
    @vite(['resources/css/remove-profile.css'])
@endsection

@section('content')
    <div class="content">
        <h2>Remove Profile</h2>
        <p>Search for a profile to permanently delete it from the system. This action is irreversible.</p>

        <div class="card">
            <div class="form-group">
                <label for="search-profile">Search Profile by Name or ID</label>
                <form method="GET" action="{{ url('/removeprofile') }}">
                    @csrf
                    <div class="search-input">
                        <span class="material-symbols-outlined">search</span>
                        <input type="text" id="search-profile" name="query" placeholder="e.g., John Doe or 12345" value="{{ $query ?? '' }}" />
                        <button type="submit">Search</button>
                    </div>
                </form>
            </div>

            @if(session('status'))
                <div class="notice success">{{ session('status') }}</div>
            @endif
            @if(session('error'))
                <div class="notice error">{{ session('error') }}</div>
            @endif

            @if(isset($results))
                <form id="delete-form" method="POST" action="{{ url('/removeprofile') }}">
                    @csrf
                    <h3>Matching Profiles</h3>
                    @if(count($results) > 0)
                        <div class="results-list">
                            @foreach($results as $profile)
                                <label class="result-item">
                                    <input type="radio" name="delete_id" value="{{ $profile->id }}" data-name="{{ $profile->name }}" data-email="{{ $profile->email }}" data-type="{{ $profile->personnel_type }}" />
                                    <div class="result-info">
                                        <strong>{{ $profile->name }}</strong> (ID: {{ $profile->id }})
                                        <div class="small">{{ $profile->email }} — {{ $profile->personnel_type }}</div>
                                    </div>
                                </label>
                            @endforeach
                        </div>

                        <div id="delete-warning" class="warning-box" style="display:none;">
                            <h4>Delete Preview</h4>
                            <p id="warning-text"></p>
                        </div>

                        <div style="margin-top:12px;">
                            <button id="confirm-delete" type="button" class="delete-btn" disabled>Delete Selected Profile</button>
                        </div>
                    @else
                        <p>No matching profiles found.</p>
                    @endif
                </form>
            @endif
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const radioItems = document.querySelectorAll('input[name="delete_id"]');
            const deleteBtn = document.getElementById('confirm-delete');
            const warningBox = document.getElementById('delete-warning');
            const warningText = document.getElementById('warning-text');
            const deleteForm = document.getElementById('delete-form');

            if (!radioItems || radioItems.length === 0) return;

            radioItems.forEach(r => {
                r.addEventListener('change', function () {
                    if (deleteBtn) deleteBtn.disabled = false;
                    const name = this.dataset.name || '';
                    const email = this.dataset.email || '';
                    const type = this.dataset.type || '';
                    if (warningText) warningText.innerHTML = `You are about to permanently delete <strong>${name}</strong> (Email: ${email}, Type: ${type}). This action cannot be undone.`;
                    if (warningBox) warningBox.style.display = 'block';
                });
            });

            deleteBtn && deleteBtn.addEventListener('click', function () {
                if (!confirm('This will permanently delete the selected profile. Are you sure?')) return;
                deleteForm && deleteForm.submit();
            });
        });
    </script>
@endpush
