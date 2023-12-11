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
                    @if (session()->has('id'))
                        <div class="col-md-6">
                            <a href="{{ route('storagefile') }}" class="btn btn-primary float-end">Danh sách QR</a>
                        </div>
                    @endif
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
                                @if (session()->has('id'))
                                    <input type="text" class="nameNew" placeholder='Name' name="nameNew"
                                        style='outline: none; border-radius: 5px; border: 2px solid #46b4f7; padding: 2px 4px;'
                                        class="form-control" value="{{ $file->name }}" placeholder="Nhập họ tên">
                                @else
                                    <input type="text" class="nameNew" placeholder='Name' name="nameNew"
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
                                <div style="display: flex; margin-bottom: 10px">
                                    <input type="text" name="nameFile[]" id="nameFile"
                                        style='border: 2px solid #46b4f7;' class="form-control check1"
                                        value="{{ $item->getFilename() }}" data-realpart="{{ $item->getRealPath() }}"
                                        placeholder="Nhập họ tên" disabled>
                                    <div style="display: flex;"> <a type="button" style='margin: 0 2px;'
                                            href="{{ url('storagefile/download?path=' . $item->getFilename() . '&name=' . $file->name . '&id=' . $file->id . '&code=' . $info) }}"
                                            class="btn btn-info">Xem</a>
                                        <a type="button" style='margin: 0 2px;'
                                            href="{{ url('storagefile/delete?path=' . $item->getFilename() . '&name=' . $file->name . '&id=' . $file->id . '&code=' . $info) }}"
                                            class="btn btn-danger">Xóa</a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="d-flex" style='padding: 0px; margin-top: 5px;    margin-bottom: 0  '>
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
                                    <input type="file" hidden name="files[]" onchange="displayFileName(this)"
                                        data-index='0' class="onInput form-control " id="chooseFileQ" multiple>
                                    <input type="text" name="name" class="form-control replaceName" data-index='0'
                                        oninput='handleLoadText2(this)' placeholder="Tên dự án"
                                        style='z-index: -3; position: absolute; width: 73%; padding: 5px; border: 2px solid #46b4f7; border-radius: 5px;'>
                                    <label class="custom-file-label labelName" for="chooseFileQ" data-index='0'
                                        style='width: 88%; padding: 5px; border: 2px solid #46b4f7; border-radius: 5px; z-index: 3;'>Select
                                        file</label>
                                </div>
                                <button
                                    style="height: fit-content; position:absolute;  width: fit-content ; right: 2px; top: 0px; font-size: 25px; padding: 0px 18px; display: flex; align-items: center;"
                                    class="addtextbox btn-info border-0 rounded-1 rounded text-capitalize"
                                    type="button">+</button>

                            </div>
                            @endif
                        </div>

                        <div
                            style=" width: 100%; text-align: center;border-radius: 5px;border: 2px solid #46b4f7;  padding: 2px 4px;  margin-top: 10px;">
                            <div class="text-center" style="margin-top: 50px;">
                                <div>
                                    <div class="card-body" style=' width: 100px; height: 157px; margin: auto; padding: 0;'>
                                        @if ($qrCodeData)
                                            <div>
                                                <img style="width:100%"
                                                    src="data:image/png;base64,{{ base64_encode($qrCodeData) }}"
                                                    alt="">
                                            </div>
                                            <div>
                                                <a href="data:image/png;base64,{{ base64_encode($qrCodeData) }}"
                                                    download>Downloads</a>
                                            </div>
                                        @endif

                                        <p>My Qr Code</p>
                                    </div>

                                </div>
                            </div>
                        </div>
                        @if (session()->has('id'))
                            <button type="button" name="submit" onclick="formSubmit(this)"
                                class=" btn btn-primary btn-block mt-4 buttonSubmitUploadFile">
                                Cập nhật
                            </button>
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

    <script>
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

        function handleReadonly(e) {
            e.value = defaultValue
        }

        function displayFileName(input) {
            // Kiểm tra xem có file nào được chọn không
            if (input.files.length > 0) {
                const rr = document.querySelectorAll('.replaceName')

                if (fileData.some(f => f.id === input.dataset.index)) { // check data has exist?
                    fileData = fileData.map(f => {
                        if (f.id === input.dataset.index) f.file = input.files[0]
                        return f
                    })
                } else {
                    fileData.push({
                        id: input.dataset.index,
                        file: input.files[0]
                    });
                }
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

                    }
                    console.log(e.getAttribute('class'), 'e.getAttribute');
                })

            } else {
                // Nếu không có file nào được chọn, thì hiển thị lại nội dung ban đầu của label
                input.value = '';
                label.innerHTML = 'Select file';
            }
        }

        const formSubmit = (e) => {
            const form = document.getElementById('theForm2')

            const dataTransfer = new DataTransfer();
            // Add files to the DataTransfer object
            fileData.forEach((file) => {
                dataTransfer.items.add(file.file);
            });

            //  Remove the old file inputs (assuming you have existing file inputs with class "custom-file")
            const divCus = document.querySelectorAll('.custom-file');
            divCus.forEach((f) => {
                if (f) f.remove();
            });
            //  Remove the old file inputs (assuming you have existing file inputs with class "custom-file")
            HTMLFormElement.prototype.reset.call(form)
            // Append the FormData to the form
            const input = document.createElement('input');
            input.type = 'file';
            input.name = 'files[]';
            input.setAttribute('hidden', true)
            input.multiple = true;
            input.files = dataTransfer.files;
            form.appendChild(input);
            console.log('why', fileData);
            HTMLFormElement.prototype.submit.call(form)

        }
        let text = ''

        const handleLoadText2 = (e) => { // change name and data here
            const inputReplace = document.querySelector('input.replaceName')
            const inputs = document.querySelectorAll('.onInput')
            Array.from(inputs).map(inp => {
                if (inp.dataset.index === e.dataset.index) {
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
                    if (isPdf || isDocX || isXlxs || isDoc) { // kiểm tra đuôi file
                        console.log('voo 2');
                        text = e.value
                        const fd = fileData.filter(f => f.id === e.dataset
                            .index)[0]
                        const myRenamedFile = new File([fd.file], e.value, {
                            lastModifiedDate: fd.file.lastModifiedDate,
                            type: fd.file.type,
                            size: fd.file.size,
                            webkitRelativePath: fd.file.webkitRelativePath

                        });
                        console.log(fd, 'fd.lastModifiedDate', fileData);
                        fileData = fileData.map(f => {
                            if (f.id === e.dataset.index) f.file = myRenamedFile
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
    </script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
