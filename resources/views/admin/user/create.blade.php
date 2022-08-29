@extends('layout.admin')
@section('title', 'Tambah User')
@section('content')
    <div class="container-fluid">
        <div class="d-sm-flex justify-content-between mb-4 text-center">
            <h1 class="h3 mb-0 text-gray-800">Tambah User</h1>
        </div>
        <form>
            <div class="form-group col-xl-6 col-md-4">
                <label for="name">Nama</label>
                <input type="text" class="form-control" id="name" aria-describedby="name">
                <small id="nameProduk" class="form-text text-muted">We'll never share your email with anyone
                    else.</small>
            </div>
            <div class="form-group col-xl-6 col-md-4">
                <label for="emaipassword">email</label>
                <input type="email" class="form-control" id="email">
            </div>
            <div class="form-group col-xl-6 col-md-4">
                <label for="password">password</label>
                <input type="password" class="form-control" id="password">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection
