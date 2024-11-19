@extends('backend.layout.admin')



@section('content')
<div class="container">
    <h1>لوحة تحكم المستخدم</h1>
    <p>مرحبًا، {{ auth()->user()->name }}!</p>
</div>
@endsection