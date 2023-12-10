@extends('layout')

@section('content')
<div class="container">
    <div class="card" style='box-shadow: 0 0 5px #31c5d1;
    margin-top: 15px;'>
        <div class="card-header">
            <div class="row">
                <div class="col-md-6">
                    <h3>Sửa File</h3>
                </div>
                <div class="col-md-6">
                    <a href="{{ route('storagefile') }}" class="btn btn-primary float-end">Danh sách QR</a>
                </div>
            </div>
        </div>
        <div class="card-body" style>
            <form action="{{ route('doedit') }}" method="POST" enctype="multipart/form-data" id='theForm2'>
                @csrf
                @method('PUT')
                <div class="row" style='width: 500px; margin: auto; padding: 5px; margin-top: 5px;'>
                    <div class="col-md-6" style='padding: 0px;'>
                        <div class="form-group">
                            <div class="form-group">
                                <input type="hidden" class="nameOld" name="id" class="form-control"
                                    value="{{ $file->id }}">
                            </div>
                            <h3 style="font-size: 16px; margin: 0">Name</h3>
                            <input type="text" class="nameNew" placeholder='Name' name="nameNew"
                                style='outline: none; border-radius: 5px; border: 2px solid #46b4f7; padding: 2px 4px;'
                                class="form-control" value="{{ $file->name }}" placeholder="Nhập họ tên">
                        </div>
                    </div>
                    <div class="form-group" style='padding: 0px; margin-top: 5px; margin-bottom: 0'>
                        <h3 style="font-size: 16px; margin: 0">File</h3>

                        @foreach ($files as $item)
                        <!-- Trong blade view -->
                        <!-- Trong blade view -->
                        <div style="display: flex; margin-bottom: 10px">
                            <input type="text" name="nameFile[]" id="nameFile" oninput="handleReadonly(this)"
                                style='border: 2px solid #46b4f7;' class="form-control check1"
                                value="{{ $item->getFilename() }}" data-realpart="{{ $item->getRealPath() }}"
                                placeholder="Nhập họ tên">
                            <div style="display: flex;"> <a type="button" style='margin: 0 2px; '
                                    href="http://127.0.0.1:8000/storagefile/download?path={{ $item->getFilename() }}&&name={{ $file->name }}&&id={{ $file->id }}"
                                    class="btn btn-info">Xem</a>
                                <a type="button" style='margin: 0 2px;'
                                    href="http://127.0.0.1:8000/storagefile/delete?path={{ $item->getFilename() }}&&name={{ $file->name }}&&id={{ $file->id }}"
                                    class="btn btn-danger">Xóa</a>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <div class="d-flex" style='padding: 0px; margin-top: 5px;    margin-bottom: 0  '>
                        <div class="custom-files" style="flex: 1">
                            <div class="custom-file" style='position: relative;'>
                                <input type="file" hidden name="files[]" onchange="displayFileName(this)"
                                    class="onInput form-control " id="chooseFileQ" multiple>
                                <input type="text" name="name" class="form-control replaceName" data-index='0'
                                    oninput='handleLoadText(this)' placeholder="Tên dự án"
                                    style=' z-index: -3; position: absolute; width:79%; width: 100%; padding: 5px; border: 2px solid #46b4f7; border-radius: 5px;'>
                                <label class="custom-file-label labelName" for="chooseFileQ"
                                    style='width: 100%; padding: 5px; border: 2px solid #46b4f7; border-radius: 5px; z-index: 3;'>Select
                                    file</label>
                            </div>
                        </div>
                    </div>

                    <div
                        style=" width: 100%; text-align: center;border-radius: 5px;border: 2px solid #46b4f7;  padding: 2px 4px;  margin-top: 10px;">
                        <div class="text-center" style="margin-top: 50px;">
                            <div>
                                <div class="card-body"
                                    style='    width: 100px; height: 100px; margin: auto; padding: 0;'>
                                    {!! QrCode::size(100)->generate($file->qrcode) !!}
                                </div>
                            </div>
                            <div> <a href="#" download>Downloads</a></div>
                            <p>My Qr Code</p>
                        </div>

                    </div>
                </div>
        </div>
        <button type="button" onclick="formSubmit(this)" name="submit"
            class=" btn btn-primary btn-block mt-4 buttonSubmitUploadFile">
            Cập nhật
        </button>
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
{{-- {{ route('download', ['files' => $item->getRealPath()]) }} --}}

<button id="send">Send data</button>
<script>
const vl = document.getElementById('nameFile')
const defaultValue = vl.value
let fileData;

function handleReadonly(e) {
    e.value = defaultValue
}

function displayFileName(input) {
    const rr = document.querySelectorAll('.replaceName')
    if (input.files.length > 0) {

        // Kiểm tra xem có file nào được chọn không
        const label = document.querySelector('.labelName')
        fileData = input.files[0]
        // Lấy tên của file được chọn
        var fileName = input.files[0].name;

        // Hiển thị tên file trên label
        // label.innerHTML = fileName;
        Array.from(rr).map(r => {
            r.setAttribute('style',
                'position: absolute; width:85%; padding: 5px; border: 2px solid #46b4f7; border-radius: 5px; z-index: 5; top: 0px'
            )
            r.value = input.files[0].name
        })

    } else {
        // Nếu không có file nào được chọn, thì hiển thị lại nội dung ban đầu của label
        input.value = '';
        label.innerHTML = 'Select file';
    }
}
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
const formSubmit = (e) => {
    const form = document.getElementById('theForm2')

    const dataTransfer = new DataTransfer();

    // Add files to the DataTransfer object
    dataTransfer.items.add(fileData);

    //  Remove the old file inputs (assuming you have existing file inputs with class "custom-file")
    HTMLFormElement.prototype.reset.call(form)
    // Append the FormData to the form
    const input = document.createElement('input');
    input.type = 'file';
    input.name = 'files[]';
    input.setAttribute('style', 'display: hidden')
    input.setAttribute('hidden', true)
    input.multiple = true;
    input.files = dataTransfer.files;
    form.appendChild(input);
    console.log('why', fileData);
    HTMLFormElement.prototype.submit.call(form)

}
let text = ''

const handleLoadText = (e) => { // change name and data here
    const inputReplace = document.querySelector('input.replaceName')
    const inputs = document.querySelectorAll('.onInput')
    Array.from(inputs).map(inp => {
        console.log('voo 1', inp, 'fuck', inp.files[0].name);
        const fileName = inp.files[0].name;
        const pdfRegex = /\.pdf$/i; // Case-insensitive match for .pdf
        const docxRegex = /\.docx$/i; // Case-insensitive match for .docx
        const xlxsRegex = /\.xlxs$/i; // Case-insensitive match for .xlxs
        const docRegex = /\.doc$/i; // Case-insensitive match for .docx

        // Test the filename against each regex
        const isPdf = pdfRegex.test(e.value);
        const isDoc = docRegex.test(e.value);
        const isDocX = docxRegex.test(e.value);
        const isXlxs = xlxsRegex.test(e.value);
        console.log(isPdf, isDoc, isDocX);
        if (isPdf || isDocX || isXlxs) { // kiểm tra đuôi file
            console.log('voo 2');
            text = e.value
            const fd = fileData
            const myRenamedFile = new File([fd], e.value, {
                lastModifiedDate: fd.lastModifiedDate,
                type: fd.type,
                size: fd.size,
                webkitRelativePath: fd.webkitRelativePath

            });
            console.log(fd, 'fd.lastModifiedDate', fileData);
            fileData = myRenamedFile
        } else {
            e.value = text ? text : fileName
            console.log('voo 3');
        }

        // inputReplace.value = ''
        // inputReplace.setAttribute('data-index', '0');

    })
}
</script>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">