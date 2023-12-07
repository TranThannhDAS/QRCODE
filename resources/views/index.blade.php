@extends('layout')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-6">
                        <h3>Quản lý sinh viên</h3>
                    </div>
                    <div class="col-md-6">
                        <a href="{{route('sinhvien.create')}}" class="btn btn-primary float-end">Thêm mới</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                @if (Session::has('thongbao'))
                <?php echo 'saduijasduiasdsakioshjsuiadghsyaugdsayudgsaytudyuyguasuyhduhihu8is' ?>
                    <div class="alert alert-success">
                        {{ Session::get('thongbao') }}
                    </div>
                @endif
                <table  class="table table-bordered">
                    <thead>
                        <tr>
                            <th>MÃ SINH VIÊN</th>
                            <th>Họ tên</th>
                            <th>Ngày sinh</th>
                            <th>Gioi tính</th>
                            <th>Địa chỉ</th>
                            <th>Số điện thoại</th>
                            <th>Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($sinhvien as $item)
                        <tr>
                            <td>{{ $item->MaSV }}</td>
                            <td>{{ $item->HoTen }}</td>
                            <td>{{ $item->NgaySinh }}</td>
                            <td>{{ $item->GioiTinh }}</td>
                            <td>{{ $item->DiaChi }}</td>
                            <td>{{ $item->SoDT }}</td>
                            <td>
                                <form action="{{ route('sinhvien.destroy', $item->id) }}" method="POST">
                                       <a href="{{ route('sinhvien.edit',$item->id) }}" class="btn btn-info">Sửa</a>
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