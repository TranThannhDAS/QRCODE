@extends('layout')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-md-6">
                    <h3>Quản lý file</h3>
                </div>
                <div class="col-md-6">
                    <a class="btn btn-primary float-end">Thêm mới</a>
                    <!-- href="{{route('show-form-uploadFile')}}" -->
                </div>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Mã QR</th>
                        <th>Tên dự án</th>
                        <th>Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <div class="card-body">
                            </div>
                        </td>
                        <td></td>
                        <td>
                            <a class="btn btn-info">Xem và Sửa</a>
                            <form method="POST">
                                <button type="submit" class="btn btn-danger">xóa</button>
                            </form>

                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection