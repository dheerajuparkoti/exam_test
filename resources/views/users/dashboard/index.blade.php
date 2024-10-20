@extends('layouts.master')

<link rel='stylesheet' type='text/css' media='screen' href="{{ asset('assets/css/users') }}/dashboard.css">

@section('content')
<section id="dashboard">
    <div class="container">
        <!-- Moving Text Section -->
        <div class="welcome-banner">
            <p class="moving-text">Welcome back, {{ Auth::user()->name }}! Ready to ace your next exam? 🚀</p>
        </div>

        <header class="dashboard-header">
            <h1>Your Dashboard</h1>
            <p>Your personal hub for exam updates, statistics, and performance insights.</p>
        </header>

        <!-- Performance Section -->
        <section id="section1" class="dashboard-section">
            <div class="section-header">
                <h3>Performance Overview</h3>
            </div>
            <div class="section-content performance-stats">
                <div class="stats-card">
                    <h4>Total Tests Taken</h4>
                    <p>{{ $totalTests }}</p>
                </div>
                <div class="stats-card">
                    <h4>Average Score</h4>
                    <p>{{ number_format($averageScore, 2) }}%</p>
                </div>
                <div class="stats-card">
                    <h4>Highest Score</h4>
                    <p>{{ number_format($highestScore, 2) }}%</p>
                </div>
                <div class="stats-card">
                    <h4>Tests Passed</h4>
                    <p>{{ $testsPassed }}</p>
                </div>
            </div>
        </section>

        <section id="section2" class="dashboard-section">
            <div class="section-header">
                <h3>Upcoming Tests</h3>
            </div>
            <div class="section-content">
                <div class="test-card">
                    <h4>License Prepartion for B.E in Computer Engineering - Mock Test</h4>
                    <p><strong>Date:</strong> September 25, 2024</p>
                    <p><strong>Time:</strong> 7:00 PM</p>
                </div>
                <div class="test-card">
                    <h4>License Preparation for B.E in Civil Engineering - Final Assessment</h4>
                    <p><strong>Date:</strong> October 5, 2024</p>
                    <p><strong>Time:</strong> 2:00 PM</p>
                </div>
            </div>
        </section>

        <section id="section3" class="dashboard-section">
            <div class="section-header">
                <h3>Leaderboard</h3>
            </div>
            <div class="section-content leaderboard">
                @foreach($leaderboard as $index => $entry)
                <div class="leaderboard-card">
                    <h4>Rank #{{ $index + 1 }}</h4>
                    <p><strong>Name:</strong> {{ $entry['name'] }}</p>
                    <p><strong>Score:</strong> {{ $entry['score'] }}</p>
                </div>
                @endforeach
            </div>
        </section>

        <section id="section4" class="dashboard-section">
            <div class="section-header">
                <h3>Test History</h3>
            </div>
            <div class="section-content test-history">
                <table class="history-table">
                    <thead>
                        <tr>
                            <th>Test Name</th>
                            <th>Date Taken</th>
                            <th>Score</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($testHistory as $history)
                        <tr>
                            <td>{{ $history['test_name'] }}</td>
                            <td>{{ $history['date_taken'] }}</td>
                            <td>{{ $history['score'] }}</td>
                            <td class="{{ $history['status'] === 'Passed' ? 'status-passed' : 'status-failed' }}">
                                {{ $history['status'] }}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </section>
    </div>
</section>
@endsection
