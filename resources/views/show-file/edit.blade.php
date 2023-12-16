@extends('layout')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
<style>
    .container {
        max-width: 500px;
    }

    *,
    p {
        margin: 0;
    }

    dl,
    ol,
    ul {
        margin: 0;
        padding: 0;
        list-style: none;
    }

    .buttonReplaceName:hover {
        color: crimson;

    }

    .barOption:hover {
        color: #90c7f7
    }

    .closeFile:hover {
        color: #d74d70 !important;
    }

    .eye:hover {
        color:
            #0561CE !important;
    }
</style>
<div class="width: 100%;margin-top: 50px;   height: 100%;">
    <div class="card" style='width: 100%;
    height: 100%;'>
        <div style='position: fixed;display: flex; z-index:999; background: white; align-items: center; width: 100%; height: 50px; top: 0; left: 0; display: flex; align-items: center; justify-content: space-between '>
            <div style="color: #0561CE;display: flex; align-items: center; width: 100px; padding: 0 13px; margin-left: 50px; justify-content: space-between">
                <div><i class="fa-solid fa-expand"></i></div>
                <p style='font-weight:600; margin: 0'>QRHOP</p>
            </div>
            <div style='display: flex; align-items: center; padding: 0 50px;'>
                <div style='display: flex; margin-right: 10px; align-items: center; color: #0561CE;'>
                    <a style='margin: 0 8px; cursor: pointer; font-weight:600;'>TRANG CHỦ</a>
                    <a style='margin: 0 8px; cursor: pointer; font-weight:600;'>GIỚI THIỆU</a>
                    <a style='margin: 0 8px; cursor: pointer; font-weight:600;'>ĐÁNH GIÁ</a>
                    <a style='margin: 0 8px; cursor: pointer; font-weight:600;'>LỘ TRÌNH</a>
                    <a style='margin: 0 8px; cursor: pointer; font-weight:600;'>LIÊN HỆ</a>
                </div>
                <div style='width: 1px; height: 30px; background: #CECECE'></div>
                <div style='display: flex;padding: 0 18px; align-items: center; '><a style=' color: black; cursor: pointer;'>Đăng
                        ký</a><a style='padding: 4px 20px; margin-left: 10px;border-radius: 5px; cursor: pointer; color: white;background: #0561CE;'>Đăng
                        nhập</a></div>
            </div>
        </div>
        <div style='  margin-top: 40px;        width: 100%; background-color: #e6e6e6;'>
            <div style="display: flex; align-items: center; justify-content: center;">
                <form action="{{ route('fileUpload') }}" method="post" enctype="multipart/form-data" style="margin: 0 10px" id="theForm">
                    <div style='margin: auto; margin-top: 50px; margin-bottom: 50px; '>
                        <div style='width: 500px; margin: auto; background: white; border-radius: 10px; padding: 20px;'>
                            <div style=' width: 100%;  margin-bottom: 16px'>
                                <h3 style='margin-bottom: 6px; color: #0561CE; font-weight: 700;'>Cập nhật QRCODE</h3>
                            </div>
                            <div style='width:100%;     height: 1px; border: 1px dashed #E3E3E3; margin-bottom: 21px;'>
                            </div>
                            <div style='width: 100%;'>
                                <input type="text" class="form-control " placeholder="Tên dự án" style=' width: 100%;padding: 10px 20px; border: 2px solid #0561CE;     margin-bottom: 20px; height: 47px;' name="name" required>
                                <input type="text" class="" placeholder="Giới thiệu, mô tả cuộc họp" style='outline: none; border: 0;  border-radius: 5px; width: 100%; padding: 10px 20px; background-color: #E3E3E3;' name="name" required>
                                <input type="file" name="files[]" class='onInput' data-index='0' id="chooseFile0" hidden onchange="handleGetFiles(this)" multiple>
                                <div class="custom-files" style="width: 100%;     margin-top: 21px;"><label data-index="0" class="removeFile0" style=' position:relative; width: 100%; text-align: center; border-radius: 5px; padding: 15px 52px; box-shadow: 0px 1px 5px #00000040;'>
                                        <div data-index="0" onclick="handleRemoveFile(this)" class="closeFile" style="  cursor: pointer;  position: absolute; top: 14px; right: 12px; font-size: 19px; width: 25px; height: 25px; display: flex; align-items: center; justify-content: center; border-radius: 50%; color: #6a6a6a;">
                                            <i class="fa-solid fa-xmark"></i>
                                        </div>
                                        <div class="eye" style="  cursor: pointer;  position: absolute; top: 15px; right: 48px; font-size: 20px; width: 25px; height: 25px; display: flex; align-items: center; justify-content: center; border-radius: 50%; color: #CECECE; ">
                                            <i class="fa-solid fa-eye"></i>
                                        </div>
                                        <a href="#" style=' text-decoration: none;      width:100%; font-size: 14px; border: 0; outline: none;'>value
                                            here</a>
                                        <img src='https://gaixinhbikini.com/wp-content/uploads/2023/02/anh-gai-dep-2k-005.jpg' style="    width: 25px; height: 31px; position: absolute; left: 25px; top: 11px; object-fit: cover;" />
                                    </label>
                                    <div style="    width: 100%; display: flex; justify-content: end;"><a href='#' style="text-decoration: none;font-size: 16px; padding: 6px; display: flex; width: fit-content; align-items: center; background-color: #0561ce; color: white; border-radius: 5px;">
                                            <p style="    text-decoration: none; font-size: 13px; padding: 0 10px; width: fit-content; margin: 0; /* display: flex; */ color: white;">
                                                Download</p><i class="fa-solid fa-file-arrow-down"></i>
                                        </a>
                                    </div>
                                </div>
                                <label class="aaaaa" data-index='0' style='width: 100%;text-align: center; border-radius: 5px; border: 2px dashed #E3E3E3;  padding: 25px 19px; margin-top: 20px;' for="chooseFile0">Tải lên tài liệu</label>
                            </div>
                            <div style=' margin: 5px 0;'>


                            </div>
                            <div style=' margin: 5px 0;  flex-wrap: wrap;   display: flex; justify-content: center;'>
                                <img src='https://qrcode-gen.com/images/qrcode-default.png' style="width: 70%;" />
                                <div style="    width: 100%; display: flex; justify-content: center;"><a href='#' style="text-decoration: none;font-size: 16px; padding: 6px; display: flex; width: fit-content; align-items: center; background-color: #0561ce; color: white; border-radius: 5px;">
                                        <p style="    text-decoration: none; font-size: 13px; padding: 0 10px; width: fit-content; margin: 0; /* display: flex; */ color: white;">
                                            Download</p><i class="fa-solid fa-file-arrow-down"></i>
                                    </a>
                                </div>
                            </div>
                            <button onclick="formSubmit(this)" type="button" class="" style="width: 100%; border-radius: 7px; border: 0; outline: none; color: #fff; padding: 10px 30px; background: 
    #0561CE; margin: 12px 0;">Câp nhật tài liệu</button>
                        </div>
                        <div></div>
                    </div>
                </form>
            </div>

            <script>
                let text = ''

                let fileData = []
                const formSubmit = (e) => {
                    const form = document.getElementById('theForm')

                    const dataTransfer = new DataTransfer();

                    // Add files to the DataTransfer object
                    fileData.forEach((file) => {
                        dataTransfer.items.add(file.file);
                    });

                    //  Remove the old file inputs (assuming you have existing file inputs with class "custom-file")

                    // Append the FormData to the form
                    const input = document.createElement('input');
                    input.type = 'file';
                    input.name = 'files[]';
                    input.setAttribute('style', 'display: hidden')
                    input.multiple = true;
                    input.hidden = true;
                    input.files = dataTransfer.files;
                    form.appendChild(input);
                    console.log('why', fileData);
                    const downloadQR = document.getElementById('downloadQR')
                    // HTMLFormElement.prototype.submit.call(form)
                }

                function handleBg(e) {
                    const receiveBg = document.querySelector('.receiveBg')
                    receiveBg.style.backgroundColor = e.value
                    console.log(receiveBg, 'receiveBg', e.value);
                }
                const containFiles = document.querySelector('.custom-files')

                function handleRemoveFile(e) {
                    if (e.dataset.index) {
                        const file = document.querySelector(`.removeFile${e.dataset.index}`)
                        if (file) file.remove()
                        if (fileData.length === 1) {
                            const aaaaa = document.querySelector('.aaaaa')
                            aaaaa.style.borderColor = '#E3E3E3'
                        }
                        fileData = fileData.filter((f, index) => f.id !== Number(e.dataset.index))
                    }

                }
                const handleLoadText = (e) => { // change name and data here
                    const inputReplace = document.querySelectorAll('input.replaceName')
                    console.log(inputReplace, 'inputReplace', fileData, e.dataset.index);
                    Array.from(inputReplace).map(inp => {
                        if (inp.dataset.index === e.dataset.index) {
                            const fileName = fileData.filter(f => f.id === Number(e.dataset.index))[0].file
                                .name;
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
                                const fd = fileData.filter(f => f.id === Number(e.dataset
                                    .index))[0]
                                const myRenamedFile = new File([fd.file], e.value, {
                                    lastModifiedDate: fd.file.lastModifiedDate,
                                    type: fd.file.type,
                                    size: fd.file.size,
                                    webkitRelativePath: fd.file.webkitRelativePath

                                });
                                console.log(fd, 'fd.lastModifiedDate', fileData);
                                fileData = fileData.map(f => {
                                    if (f.id === Number(e.dataset
                                            .index)) f.file = myRenamedFile
                                    return f
                                })
                            } else {
                                e.value = text ? text : fileName
                                console.log('voo 3');
                            }

                            // inputReplace.value = ''
                            // inputReplace.setAttribute('data-index', '0');

                        }
                    })
                }

                function handleGetFiles(e) {
                    console.log(e.files, 'file');
                    if (e.files.length > 0) {
                        text = ''
                        const aaaaa = document.querySelector('.aaaaa')
                        aaaaa.style.borderColor = '#0561CE'
                        const files = e.files

                        for (let i = 0; i < files.length; i++) {
                            fileData.push({
                                id: i,
                                file: files[i]
                            });
                            containFiles.insertAdjacentHTML('beforeend',
                                ` <label data-index = "${i}"
                    class = "removeFile${i}"
                    style = 'margin-top: 10px; position:relative; width: 100%; text-align: center; border-radius: 5px; padding: 15px 52px; box-shadow: 0px 1px 5px #00000040;' >
                    <img src = 'https://gaixinhbikini.com/wp-content/uploads/2023/02/anh-gai-dep-2k-005.jpg'
                    style = "    width: 25px; height: 31px; position: absolute; left: 25px; top: 11px; object-fit: cover;" / >
                    <div data-index = "${i}"
                    onclick = "handleRemoveFile(this)"
                    class = "closeFile"
                    style = "  cursor: pointer;  position: absolute; top: 14px; right: 12px; font-size: 19px; width: 25px; height: 25px; display: flex; align-items: center; justify-content: center; border-radius: 50%; color: #6a6a6a;" >
                    <i class="fa-solid fa-xmark"></i> </div><div class="eye"
                                        style="  cursor: pointer;  position: absolute; top: 15px; right: 48px; font-size: 20px; width: 25px; height: 25px; display: flex; align-items: center; justify-content: center; border-radius: 50%; color: #CECECE; ">
                                        <i class="fa-solid fa-eye"></i>
                                       
                                    </div>   <input type="text" name="name" class=" replaceName" data-index='${i}' oninput='handleLoadText(this)' placeholder="Tên dự án" style='    padding-right: 28px; width:100%; width: 100%; font-size: 14px; border: 0; outline: none;' value='${files[i].name}'/>  </label>`
                            )
                        }

                    }
                }
            </script>

        </div>
        <!-- <div class="card-header">
            <div class="row">
                <div class="col-md-6">
                    <h3>Xem File</h3>
                </div>
                @if (session()->has('id'))
                <div class="col-md-6">
                    <a href="{{ route('storagefile') }}" class="btn btn-primary float-end">Danh sách QR</a>
                </div>
                @endif
            </div>
        </div> -->
        <!-- <div class="card-body" style>
            <form action="{{ route('doedit') }}" method="POST" enctype="multipart/form-data" id='theForm2'>
                @csrf
                @method('PUT')
                <div class="row" style='width: 500px; margin: auto; padding: 5px; margin-top: 5px;'>
                    <div class="col-md-6" style='padding: 0px;'>
                        <div class="form-group">
                            <div class="form-group">
                                <input type="hidden" class="nameOld" name="id" class="form-control" value="{{ $file->id }}">

                                </div>
                                <h3 style="font-size: 16px; margin: 0">Tên dự án</h3>
                                @if ($check === session('id')&& session()->has('id'))
                                    <input type="text" class="nameNew" name="nameNew"
                                        style='outline: none; border-radius: 5px; border: 2px solid #46b4f7; padding: 2px 4px;'
                                        class="form-control" value="{{ $file->name }}" placeholder="Nhập tên dự án">
                                @else
                                    <input type="text" class="nameNew" placeholder='Name' name="name123"
                                        style='outline: none; border-radius: 5px; border: 2px solid #46b4f7; padding: 2px 4px;'
                                        class="form-control" value="{{ $file->name }}" placeholder="Nhập họ tên" disabled>
                                @endif
                            </div>
                        </div>
                        <div class="form-group" style='padding: 0px; margin-top: 5px; margin-bottom: 0'>
                            <h3 style="font-size: 16px; margin: 0">File</h3>

                        @foreach ($files as $item)
                        <!-- Trong blade view -->
        <!-- Trong blade view -->
        <!-- <div style="display: flex; margin-bottom: 10px">
            <input type="text" name="nameFile[]" id="nameFile" style='border: 2px solid #46b4f7;'
                class="form-control check1" value="{{ $item->getFilename() }}"
                data-realpart="{{ $item->getRealPath() }}" placeholder="Nhập họ tên" disabled>
            <div style="display: flex;"> <a type="button" style='margin: 0 2px;'
                    href="{{ url('storagefile/download?path=' . $item->getFilename() . '&name=' . $file->name . '&id=' . $file->id . '&code=' . $info) }}"
                    class="btn btn-info">Xem</a>
                <a type="button" style='margin: 0 2px;'
                    href="{{ url('storagefile/delete?path=' . $item->getFilename() . '&name=' . $file->name . '&id=' . $file->id . '&code=' . $info) }}"
                    class="btn btn-danger">Xóa</a>
            </div>
        </div> -->
        @endforeach
    </div>
    <!-- <div class="d-flex" style='padding: 0px; margin-top: 5px;    margin-bottom: 0  '>
        {{-- <div class="custom-files" style="flex: 1">
                                @if (session()->has('id'))
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
                                @endif
                            </div> --}}
        @if (session()->has('id'))
        <div class="custom-files" style="flex: 1;position: relative;">
            <div class="custom-file custom-file0" style='position: relative;' data-index='0'>
                <input type="file" hidden name="files[]" onchange="displayFileName(this)" data-index='0'
                    class="onInput form-control " id="chooseFileQ" multiple>
                <input type="text" name="name" class="form-control replaceName" data-index='0'
                    oninput='handleLoadText2(this)' placeholder="Tên dự án"
                    style='z-index: -3; position: absolute; width: 73%; padding: 5px; border: 2px solid #46b4f7; border-radius: 5px;'>
                <label class="custom-file-label labelName" for="chooseFileQ" data-index='0'
                    style='width: 88%; padding: 5px; border: 2px solid #46b4f7; border-radius: 5px; z-index: 3;'>Select
                    file</label>
            </div>
            <button
                style="height: fit-content; position:absolute;  width: fit-content ; right: 2px; top: 0px; font-size: 25px; padding: 0px 18px; display: flex; align-items: center;"
                class="addtextbox btn-info border-0 rounded-1 rounded text-capitalize" type="button">+</button>

        </div>
        @endif
    </div> -->

    <!-- <div
        style=" width: 100%; text-align: center;border-radius: 5px;border: 2px solid #46b4f7;  padding: 2px 4px;  margin-top: 10px;">
        <div class="text-center" style="margin-top: 50px;">
            <div>
                <div class="card-body" style=' width: 100px; height: 157px; margin: auto; padding: 0;'>

                    <p>My Qr Code</p>
                </div>

            </div>
        </div>
    </div> -->
    <!-- <button type="button" name="submit" onclick="formSubmit(this)"
        class=" btn btn-primary btn-block mt-4 buttonSubmitUploadFile">
        Cập nhật
    </button> -->
    @if (session()->has('id'))
    @endif
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

<!-- <script>
    const vl = document.getElementById('nameFile')
    const defaultValue = vl.value
    let fileData = [];
    let index = 0
    const btnAddText = document.querySelector(".addtextbox")
    btnAddText.addEventListener("click", function(e) {
        index += 1
        inputReplaceDDD = document.querySelectorAll('.replaceName')
        var customFile = document.querySelector(".custom-files")
        const div = `<div class="custom-file custom-file${index} mt-3" data-index='${index}'>
                                        <input type="file" name="file" class="custom-file-input onInput" data-index='${index}' id="chooseFile${index}"
                                        onchange="displayFileName(this)">
                                        <input type="text" name="name" class="form-control replaceName" data-index='${index}'
                                placeholder="Tên dự án" style='position: absolute; top: 0px; left: 0px; width: 73%;' oninput='handleLoadText2(this)'>
                                        <label class="custom-file-label" data-index='${index}' for="chooseFile${index}" style='width: 88%;'>Select file</label>
                                </div>`

        console.log(customFile);
        customFile.insertAdjacentHTML('beforeend', div)
    })

        // function handleReadonly(e) {
        //     e.value = defaultValue
        // }
                console.log(fileData,'fileData');

        function displayFileName(input) {
            // Kiểm tra xem có file nào được chọn không
            if (input.files.length > 0) {
                const rr = document.querySelectorAll('.replaceName')
                console.log(fileData,'fileData');

                if (fileData.some(f => f.id === input.dataset.index)) { // check data has exist?

                    fileData = fileData.map(f => {
                        if (f.id === e.dataset.index) f.file = myRenamedFile
                        return f
                    })
                } else {
                    e.value = text ? text : fileName
                    console.log('voo 3');
                }
                console.log(fileData);

                Array.from(rr).map(r => { //set value by name of file
                    if (r.dataset.index === input.dataset.index) {
                        r.setAttribute('style',
                            'position: absolute; width:73%; padding: 5px; border: 2px solid #46b4f7; border-radius: 5px; z-index: 5; top: 0px'
                        )
                        r.value = input.files[0].name
                    }
                })
                const divCus = document.querySelectorAll('.custom-file')
                Array.from(divCus).map(e => { // add delete button in .custom-file
                    console.log(input.closest(
                        `.custom-file${input.dataset.index}`), input.dataset.index);
                    if (e.getAttribute('class') === input.closest(
                            `.custom-file${input.dataset.index}`).getAttribute('class')) {
                        const fileName = input.files[0].name;
                        const divBut =
                            `<div  onclick="handleDelete(this)" class='buttonReplaceName' data-index='${input.dataset.index}' style="position: absolute;right: 140px;top: 6px;padding: 2px 7px; border-radius: 5px; border: 1px solid #2acb95; font-size: 14px; cursor: pointer; z-index: 5; background-color: #c67878;  border: 0;color: white;">Xóa</div>`
                        e.insertAdjacentHTML('beforeend', divBut)

                // inputReplace.value = ''
                // inputReplace.setAttribute('data-index', '0');

            }
        })
    }
    const handleDelete = (e) => {
        const butReplaceName = document.querySelectorAll('.buttonReplaceName')
        const divCus = document.querySelectorAll('.custom-file')
        const form = document.getElementById('theForm2')
        const rr = document.querySelectorAll('.replaceName')

        Array.from(divCus).map((f, index, arr) => {
            console.log('delete', f, arr, rr);

            if (arr.length === 1) {
                HTMLFormElement.prototype.reset.call(form)
                Array.from(rr).map(r => {
                    r.setAttribute('style', 'z-index: 0;position: absolute; width: 84%; top: 0')
                    r.value = ''
                })
                Array.from(butReplaceName).map(b => b.remove())
            } else {
                if (e.dataset.index === f.dataset.index) {
                    fileData = fileData.filter(f => f.id !== e.dataset.index)
                    f.remove()
                }
            }


        })
    }
</script> -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">