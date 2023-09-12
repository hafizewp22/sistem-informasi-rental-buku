@extends('layouts.mainlayout')

@section('title', 'User')

@section('content')
    <h1>User List</h1>

    <div class="mt-5 d-flex justify-content-end">
        <a href="user-ben" class="btn btn-secondary me-3">View Banned User</a>
        <a href="user-view" class="btn btn-primary">View Registered User</a>
    </div>

    <div class="mt-5">
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif
    </div>

    <div class="my-5">
        <table class="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Username</th>
                    <th>Phone</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->username }}</td>
                        <td>
                            @if ($item->phone == null && $item->phone == '')
                                -
                            @else
                                {{ $item->phone }}
                            @endif
                        </td>
                        <td>
                            <a href="/user-detail/{{$item->username}}">Detail</a>
                            <a href="/user-ban/{{$item->username}}">Ban User</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection