@extends('layouts.admin')

@section('title', 'Admin Dashboard')

@section('vite')
    @vite(['resources/css/dashboard.css', 'resources/css/personnel.css'])
@endsection

@section('content')
    <div class="welcome-box">
        <h2>Welcome, Admin</h2>
        <p>Use the navigation on the left to manage profiles. You can add new profiles, view existing ones, search for specific profiles, or remove profiles from the system.</p>
        <p>Manage personnel by service or attachment.</p>

        <div class="tabs">
            <button class="tab-button active" data-tab="service">Service</button>
            <button class="tab-button" data-tab="attachment">Attachment</button>
        </div>

        <div class="tab-content active" id="service-tab">
            <table class="personnel-table">
                <thead>
                    <tr>
                        <th>PERSONNEL NAME</th>
                        <th>DEPARTMENT</th>
                        <th>ID</th>
                        <th>START DATE</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($servicePersonnel as $person)
                        <tr>
                            <td>{{ $person->name }}</td>
                            <td>{{ $person->department }}</td>
                            <td>{{ $person->id }}</td>
                            <td>{{ $person->start_date }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="pagination-container">
                {{ $servicePersonnel->links() }}
            </div>
        </div>

        <div class="tab-content" id="attachment-tab">
            <table class="personnel-table">
                <thead>
                    <tr>
                        <th>PERSONNEL NAME</th>
                        <th>INSTITUTION NAME</th>
                        <th>ID</th>
                        <th>START DATE</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($attachmentPersonnel as $person)
                        <tr>
                            <td>{{ $person->name }}</td>
                            <td>{{ $person->institution_name }}</td>
                            <td>{{ $person->id }}</td>
                            <td>{{ $person->start_date }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="pagination-container">
                {{ $attachmentPersonnel->links() }}
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.querySelectorAll('.tab-button').forEach(button => {
            button.addEventListener('click', function() {
                const tabName = this.dataset.tab;

                document.querySelectorAll('.tab-button').forEach(btn => btn.classList.remove('active'));
                document.querySelectorAll('.tab-content').forEach(content => content.classList.remove('active'));

                this.classList.add('active');
                document.getElementById(tabName + '-tab').classList.add('active');
            });
        });
    </script>
@endpush
