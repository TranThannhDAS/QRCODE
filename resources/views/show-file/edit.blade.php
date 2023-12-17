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
@extends('layout')

<div style='  margin-top: 40px;        width: 100%; background-color: #e6e6e6;'>
                <div style="display: flex; align-items: center; justify-content: center;">
                    <form action="{{ route('doedit') }}" style="margin: 0 10px" id="theForm" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="id" id="" value="{{ $file->id }}">
                        <div style='margin: auto; margin-top: 50px; margin-bottom: 50px; '>
                            <div style='width: 500px; margin: auto; background: white; border-radius: 10px; padding: 20px;'>
                                <div style=' width: 100%;  margin-bottom: 16px'>
                                    <h3 style='margin-bottom: 6px; color: #0561CE; font-weight: 700;'>Cập nhật QRCODE</h3>
                                </div>
                                <div style='width:100%;     height: 1px; border: 1px dashed #E3E3E3; margin-bottom: 21px;'>
                                </div>
                                <div style='width: 100%;'>
                                    <input type="text" class="form-control " placeholder="Tên dự án"
                                        style=' width: 100%;padding: 10px 20px; border: 2px solid #0561CE;     margin-bottom: 20px; height: 47px;'
                                        name="name1" value="{{ $file->name }}" required>
                                    <input type="text" class="" placeholder="Giới thiệu, mô tả cuộc họp"
                                        style='outline: none; border: 0;  border-radius: 5px; width: 100%; padding: 10px 20px; background-color: #E3E3E3;'
                                        name="name2" value="{{ $file->description }}" required>
                                    <input type="file" name="files[]" class='onInput' data-index='0' id="chooseFile0"
                                        hidden onchange="handleGetFiles(this)" multiple>
                                    <div class="custom-files" style="width: 100%;     margin-top: 21px;">
                                        @foreach ($files as $item)
                                        <label
                                            data-index="0" class="removeFile0"
                                            style=' position:relative; width: 100%; text-align: center; border-radius: 5px; padding: 15px 52px; box-shadow: 0px 1px 5px #00000040;'>
                                            <div data-index="0"  class="closeFile"
                                                style="  cursor: pointer;  position: absolute; top: 14px; right: 12px; font-size: 19px; width: 25px; height: 25px; display: flex; align-items: center; justify-content: center; border-radius: 50%; color: #6a6a6a;">
                                                <a href="{{ url('storagefile/delete?path=' . $item->getFilename()  . '&id=' . $file->id . '&code=' . $info) }}"><i class="fa-solid fa-xmark"></i></a> 
                                            </div>
                                            <div class="eye"
                                                style="  cursor: pointer;  position: absolute; top: 15px; right: 48px; font-size: 20px; width: 25px; height: 25px; display: flex; align-items: center; justify-content: center; border-radius: 50%; color: #CECECE; ">
                                                <i class="fa-solid fa-eye"></i>
                                            </div>

                                            <a href="{{ url('show?path=' . $item->getFilename() . '&id=' . $file->id . '&code=' . $info) }}"
                                                style=' text-decoration: none;      width:100%; font-size: 14px; border: 0; outline: none;'>{{ $item->getFilename() }}</a>
                                            <img src='https://gaixinhbikini.com/wp-content/uploads/2023/02/anh-gai-dep-2k-005.jpg'
                                                style="    width: 25px; height: 31px; position: absolute; left: 25px; top: 11px; object-fit: cover;" />
                                        </label>
                                        <div style="width: 100%; display: flex; justify-content: end;">
                                            <a href='{{ url('storagefile/download?path=' . $item->getFilename() . '&code=' . $info) }}'
                                                style="text-decoration: none;font-size: 16px; padding: 6px; display: flex; width: fit-content; align-items: center; background-color: #0561ce; color: white; border-radius: 5px;">
                                                <p
                                                    style="    text-decoration: none; font-size: 13px; padding: 0 10px; width: fit-content; margin: 0; /* display: flex; */ color: white;">
                                                    Download</p><i class="fa-solid fa-file-arrow-down"></i>
                                            </a>
                                        </div>
                                         @endforeach
                                       
                                    </div>
                                    <label class="aaaaa" data-index='0'
                                        style='width: 100%;text-align: center; border-radius: 5px; border: 2px dashed #E3E3E3;  padding: 25px 19px; margin-top: 20px;'
                                        for="chooseFile0">Tải lên tài liệu
                                    </label>
                                </div>
                                <div style=' margin: 5px 0;'>


                                </div>
                                <div style=' margin: 5px 0;  flex-wrap: wrap;   display: flex; justify-content: center;'>
                                    <img src='data:image/png;base64,{{ base64_encode($qrCodeData) }}' style="width: 70%;" />
                                    <div style="    width: 100%; display: flex; justify-content: center;">
                                        <a href='data:image/png;base64,{{ base64_encode($qrCodeData) }}'
                                            style="text-decoration: none;font-size: 16px; padding: 6px; display: flex; width: fit-content; align-items: center; background-color: #0561ce; color: white; border-radius: 5px; margin-top: 8px;" download>
                                            <p 
                                                style="    text-decoration: none; font-size: 13px; padding: 0 10px; width: fit-content; margin: 0; /* display: flex; */ color: white;">
                                                Download</p><i class="fa-solid fa-file-arrow-down"></i> 
                                        </a>
                                    </div>
                                </div>
                                <button onclick="formSubmit(this)" type="button" class=""
                                    style="width: 100%; border-radius: 7px; border: 0; outline: none; color: #fff; padding: 10px 30px; background: 
    #0561CE; margin: 12px 0;">Câp
                                    nhật tài liệu</button>
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
                        const inp = document.querySelector('.onInput')
                        if (inp) inp.remove()
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
                        HTMLFormElement.prototype.submit.call(form)
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
                    let index = 0
                    function handleGetFiles(e) {
                        console.log(e.files, 'file');
                        if (e.files.length > 0) {
                            text = ''
                            const aaaaa = document.querySelector('.aaaaa')
                            aaaaa.style.borderColor = '#0561CE'
                            const files = e.files

                            for (let i = 0; i < files.length; i++) {
                                fileData.push({
                                    id: index,
                                    file: files[i]
                                });
                                containFiles.insertAdjacentHTML('beforeend',
                                    ` <label data-index = "${index}"
                    class = "removeFile${index}"
                    style = 'margin-top: 10px; position:relative; width: 100%; text-align: center; border-radius: 5px; padding: 15px 52px; box-shadow: 0px 1px 5px #00000040;' >
                    <img src = 'https://gaixinhbikini.com/wp-content/uploads/2023/02/anh-gai-dep-2k-005.jpg'
                    style = "    width: 25px; height: 31px; position: absolute; left: 25px; top: 11px; object-fit: cover;" / >
                    <div data-index = "${index}"
                    onclick = "handleRemoveFile(this)"
                    class = "closeFile"
                    style = "  cursor: pointer;  position: absolute; top: 14px; right: 12px; font-size: 19px; width: 25px; height: 25px; display: flex; align-items: center; justify-content: center; border-radius: 50%; color: #6a6a6a;" >
                    <i class="fa-solid fa-xmark"></i> </div><div class="eye"
                                        style="  cursor: pointer;  position: absolute; top: 15px; right: 48px; font-size: 20px; width: 25px; height: 25px; display: flex; align-items: center; justify-content: center; border-radius: 50%; color: #CECECE; ">
                                        <i class="fa-solid fa-eye"></i>
                                       
                                    </div>   <input type="text" name="name" class=" replaceName" data-index='${index}' oninput='handleLoadText(this)' placeholder="Tên dự án" style='    padding-right: 28px; width:100%; width: 100%; font-size: 14px; border: 0; outline: none;' value='${files[i].name}'/>  </label>`
                                )
                                index +=1
                            }

                        }
                    }
                </script>

            </div>
          
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
