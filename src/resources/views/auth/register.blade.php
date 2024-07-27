@extends('layouts.common')

@section('title', 'Register')

@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<link rel="stylesheet" href="{{ asset('css/register.css') }}" />
<link rel="stylesheet" href="{{ asset('css/register.css') }}?v={{ time() }}" />
@endsection

@section('content')
@php
    $hideSearch = true;
@endphp
<div class="register-container">
    <div class="register-box">
        <h2>Registration</h2>

        <form action="{{ route('register.post') }}" method="POST">
            @csrf

            <div class="input-group">
                <label for="name"><i class="fas fa-user"></i></label>
                <input type="text" id="name" name="name" placeholder="Username" value="{{ old('name') }}" required>
                @error('name')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>

            <div class="input-group">
                <label for="email"><i class="fas fa-envelope"></i></label>
                <input type="email" id="email" name="email" placeholder="Email" value="{{ old('email') }}" required>
                @error('email')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>

            <div class="input-group">
                <label for="password"><i class="fas fa-lock"></i></label>
                <input type="password" id="password" name="password" placeholder="Password" required>
                @error('password')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>

            <div class="input-group checkbox-group">
                <input type="checkbox" id="admin_role" name="admin_role" value="1">
                <label for="admin_role">管理者として登録する</label>
            </div>

            <button type="submit" class="register-button">登録</button>
        </form>

        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
    </div>
</div>
@endsection
