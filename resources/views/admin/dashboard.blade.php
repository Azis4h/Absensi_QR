@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Admin Dashboard') }}</div>

                <div class="card-body">
                    <h3>Welcome, Admin!</h3>
                    <p>Manage users, courses, and schedules here.</p>
                    
                    <div class="row">
                        <div class="col-md-3">
                            <div class="card text-white bg-primary mb-3">
                                <div class="card-body">
                                    <h5 class="card-title">Students</h5>
                                    <p class="card-text">Manage Student Data</p>
                                    <a href="#" class="btn btn-light">Go</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card text-white bg-success mb-3">
                                <div class="card-body">
                                    <h5 class="card-title">Lecturers</h5>
                                    <p class="card-text">Manage Lecturer Data</p>
                                    <a href="#" class="btn btn-light">Go</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card text-white bg-warning mb-3">
                                <div class="card-body">
                                    <h5 class="card-title">Courses</h5>
                                    <p class="card-text">Manage Courses</p>
                                    <a href="#" class="btn btn-light">Go</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
