@extends('layout')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-md-6">
                    <h3>Sửa File</h3>
                </div>
                <div class="col-md-6">
                    <a class="btn btn-primary float-end">Danh sách sinh viên</a>
                    <!-- href="{{ route('storagefile') }}" -->
                </div>
            </div>
        </div>
        <div class="card-body">
            <form method="POST" enctype="multipart/form-data">
                <!-- action="{{ route('doedit') }}" -->
                <!-- @csrf -->
                <!-- @method('PUT') -->
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <div class="form-group">
                                <input type="hidden" class="nameOld" name="id" class="form-control">
                                <!-- value="{{ $file->id }}" -->
                            </div>
                            <strong>Tên</strong>
                            <input type="text" class="nameNew" name="nameNew" class="form-control" placeholder="Nhập họ tên">
                            <!-- value="{{ $file->name }}" -->
                            <input type="hidden" class="nameOld" name="nameOld" class="form-control">
                            <!-- value="{{ $file->name }}" -->
                        </div>
                    </div>
                    <div class="form-group">
                        <strong>File</strong>
                        <!-- @foreach ($files as $item) -->
                        <!-- Trong blade view -->
                        <!-- Trong blade view -->
                        <input type="text" name="nameFile[]" id="nameFile" class="form-control check1" placeholder="Nhập họ tên">
                        <!-- data-realpart="{{ $item->getRealPath() }}" -->
                        <!-- value="{{ $item->getFilename() }}" -->
                        <a type="button" class="btn btn-info">Xem</a>
                        <!-- href="http://127.0.0.1:8000/storagefile/download?path={{ $item->getFilename() }}&&name={{ $file->name }}" -->
                        <!-- onclick="download({{ $loop->index }})" -->
                        <a type="button" class="btn btn-danger">Xóa</a>
                        <!-- href="http://127.0.0.1:8000/storagefile/delete?path={{ $item->getFilename() }}&&name={{ $file->name }}&&id={{ $file->id }}" -->
                        <!-- onclick="download({{ $loop->index }})" -->
                        <!-- @endforeach                                 -->
                    </div>
                    <div class="d-flex">
                        <div class="custom-files" style="flex: 1">
                            <div class="custom-file">
                                <input type="file" name="files[]" class="custom-file-input" id="chooseFile" multiple>
                            </div>
                        </div>
                    </div>
                    <strong>Mã QR</strong>
                    <div class="card-body">
                        <!-- {!! QrCode::size(100)->generate($file->qrcode) !!} -->
                    </div>

                </div>
        </div>
        <button type="submit" class="btn btn-success mt-2">Cập nhật</button>
        </form>
    </div>
    <script>
        // function download(index) {
        //     // Sử dụng route và filePath ở đây để thực hiện tải xuống
        //     console.log(index);
        //     var input_path = document.querySelectorAll('.check1')[index].dataset.realpart
        //     var arr = input_path.split("\\");
        //     var result = "\\"+arr[8] + "\\" + arr[9] + "\\" + arr[10];
        //     var input_name = document.querySelector('.name')

        //     if (input_path) {
        //         $.ajax({
        //             method: "POST",
        //             url: "{{ route('download') }}",
        //             data: {
        //                 _token: "{{ csrf_token() }}", // Bao gồm token CSRF trong dữ liệu
        //                 path: result,
        //             },                          
        //         })
        //     }


        //     // Thực hiện xử lý tải xuống tại đây
        // }
    </script>
</div>
</div>
<!-- {{-- {{ route('download', ['files' => $item->getRealPath()]) }} --}} -->

<button id="send">Send data</button>
<script>
    // Get the button element
    var button = document.getElementById("send");
    // Add a click event listener
    button.addEventListener("click", function() {
        // Create a FormData object
        var formData = new FormData();
        // Append the data you want to send
        formData.append("id", 1);
        formData.append("name", "John");
        // Create an XMLHttpRequest object
        var xhr = new XMLHttpRequest();
        // Open a connection to the controller
        xhr.open("POST", "{{ url('test/post-method') }}");
        // Send the FormData object
        xhr.send(formData);
    });
</script>