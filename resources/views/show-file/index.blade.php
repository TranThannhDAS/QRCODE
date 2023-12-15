@extends('layout')

@section('content')
<div class="container mt-2">
    sss
    <div class="card" style="">
        <div class="card-header " style="box-shadow: 0 0 5px #1eabda;">
            <div class="row" style='padding-top: 20px;'>
                <div class="col-md-6">
                    <h3>Quản lý file</h3>
                </div>
                <div class="col-md-6">
                    <div class="float-end">
                        <a href="{{ route('show-form-uploadFile') }}" class="btn btn-primary">Thêm mới</a>
                    </div>
                    <div class="col-md-6">
                        <form action="{{ route('find') }}" method="GET" style="display: flex;">

                            <div class="form-group">
                                <input type="text" class="form-control" style="
    width: 300px;
border: 2px solid #46b4f7;" name="query" placeholder="Search here....." value="{{ request()->input('query') }}">
                                <span class="text-danger">
                                    @error(' query') {{ $message }} @enderror </span>
                            </div>
                            <div class="form-group" style="margin-left: 5px;">
                                <button type="submit" class="btn btn-primary">Search</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Mã QRss</th>
                                <th>Tên dự án</th>
                                <th>Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($files as $item)
                            <tr>
                                <td>
                                    <div class="card-body">
                                        {!! QrCode::size(100)->generate($item->qrcode) !!}
                                    </div>
                                </td>
                                <td>{{ $item->name }}</td>
                                <td style='width: 300px'>
                                    <div style="display: flex;"> <a href="{{ route('show_edit', ['id' => $item->id]) }}" class="btn btn-info">Xem
                                            và Sửa</a>
                                        <form action="{{ route('deleteall', ['id' => $item->id]) }}" method="POST" style='margin-left: 5px;'>
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">xóa</button>
                                        </form>
                                    </div>

                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="pagination-block" style="justify-content: center; display: flex;">
                        {{ $files->appends(request()->input())->links('show-file.paginationlinks') }}
                    </div>
                </div>
            </div>
        </div>
        @endsection