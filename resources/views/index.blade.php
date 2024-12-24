@extends('layout')
@section('title', 'Student List')
@section('content')

<h1 class="mb-4">Student List</h1>
<div class="row mb-4">
    <div class="col-md-6">
        <input type="text" id="searchName" class="form-control" placeholder="Search by Name">
    </div>
    <div class="col-md-6">
        <input type="number" id="filterAge" class="form-control" placeholder="Filter by Age">
    </div>
</div>
<table class="table table-striped">
    <thead>
        <tr>
            <th>Name</th>
            <th>Age</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody id="studentTable">
    @include('student_rows', ['students' => $students])
    </tbody>
</table>
<script>
    $(document).ready(function () {
    function fetchStudents() {
        $.ajax({
            url: "{{ route('students.index') }}",
            type: "GET",
            data: {
                name: $('#searchName').val() || undefined,
                age: $('#filterAge').val() || undefined
            },
            success: function (data) {
                $('#studentTable').html(data);
            }
        });
    }
    $('#searchName, #filterAge').on('input', fetchStudents);
});
</script>
@endsection