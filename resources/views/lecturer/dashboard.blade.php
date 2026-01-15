@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Lecturer Dashboard') }}</div>

                <div class="card-body">
                    <h3>Welcome, Lecturer!</h3>
                    <p>Manage your classes and open attendance sessions.</p>

                    <a href="{{ route('lecturer.session.create') }}" class="btn btn-primary mb-3">Open New Session</a>

                    <table class="table">
                        <thead>
                            <tr>
                                <th>Course</th>
                                <th>Date</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Loop through schedules/sessions -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
