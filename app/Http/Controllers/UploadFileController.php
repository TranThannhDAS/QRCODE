<?php

namespace App\Http\Controllers;

use App\Models\Files;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use App\Http\Controllers\Response;
use App\Models\Anonymous_file;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Barryvdh\DomPDF\Facade as PDF;

class UploadFileController extends Controller
{
    public function createForm()
    {
        return view('upload');
    }
    public function fileUpload(Request $request)
    {
        if ($request->session()->has('id')) {
            $randomString = Str::random(15);
        }else{
            $randomString = Str::random(12);
        }

        $validatedData = $request->validate([
            'files' => 'required'
        ]);   
    
            $path = 'public/'  . $randomString;
      

        if (!File::exists(public_path($path))) {

            File::makeDirectory($path,0777,true,true);
        }
        $fileBag = $request->file('files');
        if ($fileBag) {
            // Lấy danh sách các file
            $allFilePaths = '';
            // Lặp qua từng file
            foreach ($fileBag as $key => $file) {
                // Lấy tên file
                $fileName = $file->getClientOriginalName();

                $path_pdf = $file->move($path, $fileName);
                $allFilePaths .= $path_pdf . '|';
                print_r($fileName);
            }
            if ($request->session()->has('id')) {
                $file_db = new Files();
                $file_db->name = $request->name1;
                $file_db->filepath = $allFilePaths;
                $file_db->userid = $request->session()->get('id');
                $file_db->hashcode = $randomString;
                $file_db->description = $request->des;
                $file_db->qrcode =  url($randomString);
                $file_db->save();
                $qrCodeData = QrCode::format('png')->size(500)->generate($file_db->qrcode);
                $url = $randomString;
            } else {
                $anonymous = new Anonymous_file();
                $anonymous->hashcode = $randomString;
                $anonymous->name = $request->name1;
                $anonymous->qrcode = url($randomString);
                $anonymous->description = $request->des;
                $anonymous->save();
                $url = $randomString;
                $qrCodeData = QrCode::format('png')->size(500)->generate($anonymous->qrcode);
            }
          

            // Chuyển đối tượng SplFileInfo thành mảng thông tin
           
            
            return redirect()
                ->route('anonymous',['hash' => $url]);
        }
    }
    public function allfile()
    {
        if (!session('id')) {
            return redirect()->route('show-form-login');
        }
        $files = DB::table('files')->where('userid', session('id'))->paginate(10);
        return view('show-file.index', compact('files'));
    }

    public function show_edit($id)
    {
        $files = Files::find($id);
        if ($files->userid !== session('id')) {
            abort(404);
        }
        $file = DB::table('files')
            ->where('id', $id)
            ->where('userid', session('id'))
            ->first();
        $files = File::files(public_path('public/'. $file->hashcode));
        $qrCodeData = QrCode::format('png')->size(1000)->generate($file->qrcode);
        $info = $file->hashcode;
        $userid = $file->userid ?? null;
        return view('show-file.edit', compact('file', 'files', 'qrCodeData', 'info','userid'));
    }

    public function ondownload(Request $request)
    {
        $path2 = public_path('public/' . $request->code . '/' . $request->path);
    
        if (File::exists($path2)) {
            return response()->download($path2);
        } else {
            return "File not found";
        }
    }

    public function ondelete(Request $request)
    {
         $file = DB::table('files')
         ->where('id', $request->id)
         ->first();
        if($file->userid !== session('id')){
            abort(500);
        }
        $path2 = public_path('public/' . $request->code . '/' . $request->path);
     
        if (File::exists($path2)) {
            File::delete($path2);
            return redirect()->route('show_edit', ['id' => $request->id])->with('fileuserid', $file->userid);
        } else {
            return "File not found";
        }
    }
    public function deleteall(Request $request, $id)
    {
        if (!session('id')) {
            return redirect()->route('show-form-login');
        }
        $exsitsFile = DB::table('files')->where('id', $id)->first();
        if (!$exsitsFile) {
            return null;
        }
        $path = public_path('public/' . $exsitsFile->hashcode);
        if (File::exists($path)) {
            File::deleteDirectory($path);
        }
        DB::table('files')->where('id', $id)->delete();
        return redirect()->route('storagefile');
    }
    public function doedit(Request $request)
    {
        if (!session('id')) {
            return redirect()->route('show-form-login');
        }

        $files = Files::find($request->id);
        $path = 'public/' . '/' . $files->hashcode;

        if ($files->userid !== session('id')) {
            abort(404);
        }
        $fileBag = $request->file('files');
        if ($fileBag) {
            // Lấy danh sách các file
            $allFilePaths = '';
            // Lặp qua từng file
            foreach ($fileBag as $key => $file) {
                // Lấy tên file
                $fileName = $file->getClientOriginalName();
                $path_pdf = $file->move($path, $fileName);
            }
        }
        if (session('id')) {
            DB::table('files')
                ->where('id', $request->id)
                ->update([
                    'name' => $request->name1,
                    'description' => $request->name2
                ]);
        }
        
        return redirect()->route('storagefile');
    }
    public function show_edit_anonymous(Request $request)
    {
        $parts = explode('/', $request->getPathInfo());
        $info = $parts[1];
        if (File::exists(public_path('public/' . $info))) {
            $files = File::files(public_path('public/' . $info));
        } else {
            abort(404);
        }
        $length = strlen($info);
        if ($length === 15) {
            $file = DB::table('files')
            ->where('hashcode', $info)
            ->first();
        } else {
            $file = DB::table('anonymous_files')
            ->where('hashcode', $info)
            ->first();
        }      
        $url = url($file->qrcode);    
        $qrCodeData = QrCode::format('png')->size(1000)->generate($file->qrcode);
        return view('show-detail', compact('file', 'files', 'qrCodeData', 'info','url'));
    }
    public function find(Request $request)
    {
        if (!session('id')) {
            return redirect()->route('show-form-login');
        }
        $request->validate([
            'query' => 'required|min:2'
        ]);
        $search_text = $request->input('query');
        $files = DB::table('files')
            ->where('name', 'LIKE', '%' . $search_text . '%')
            ->paginate(5);
        return view('show-file.index', ['files' => $files]);
    }
    public function show(Request $request){
        $filePath = ('/'.'public/'.$request->code .'/'.$request->path);
        return view('viewFile',compact('filePath'));
    }
}
