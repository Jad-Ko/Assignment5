<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Add new student</h1>
    <form action="{{route('students.store')}}" method="POST">
        @csrf
        <input type="text" name="name" placeholder="Name" required>
        <input type="number" name="age" placeholder="Age" required>
        <button type="submit">Add new Student</button>
    </form>
</body>
</html>

@extends('layout')

@section('title', 'Add New Student')
@section('content')
<h1 class="mb-4">Add New Student</h1>

<form action="{{ route('students.store') }}" method="POST" class="mb-4">
    @csrf
    <div class="mb-3">
        <label for="name" class="form-label">Name</label>
        <input type="text" id="name" name="name" class="form-control" required>
    </div>
    <div class="mb-3">
        <label for="age" class="form-label">Age</label>
        <input type="number" id="age" name="age" class="form-control" required>
    </div>
    <button type="submit" class="btn btn-primary">Add Student</button>
</form>
@endsection