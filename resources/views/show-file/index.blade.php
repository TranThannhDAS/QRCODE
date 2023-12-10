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
                        <div class="float-end">
                            <a href="{{route('show-form-uploadFile')}}" class="btn btn-primary">Thêm mới</a>
                        </div>
                        <div class="col-md-6">
                            <form action="" method="GET" class="form-inline">
                                <div class="form-group mx-sm-3 mb-2">
                                    <label for="search" class="sr-only">Tìm kiếm</label>
                                    <input type="text" class="form-control" id="search" name="search" placeholder="Tìm kiếm">
                                </div>
                                <button type="submit" class="btn btn-primary mb-2">Tìm kiếm</button>
                            </form>
                        </div>
                    </div>
            <div class="card-body">
                <table  class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Mã QR</th>
                            <th>Tên dự án</th>                      
                            <th>Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($file as $item)
                        <tr>
                            <td> <div class="card-body">
                                {!! QrCode::size(100)->generate($item->qrcode) !!}
                            </div></td>
                            <td>{{ $item->name }}</td>
                            <td>
                                <a href="{{ route('show_edit', ['id' => $item->id]) }}" class="btn btn-info">Xem và Sửa</a>
                                <form action="{{ route('deleteall', ['id' => $item->id]) }}" method="POST">
                                       @csrf
                                       @method('DELETE')
                                       <button type="submit" class="btn btn-danger">xóa</button>
                                </form>
                                   
                            </td>
                        </tr>
                            @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection