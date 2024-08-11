<?php

namespace App\Http\Controllers\User;

use App\Enums\docTypes;
use App\Http\Controllers\Controller;
use App\Models\documents;
use Auth;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use App\Services\File\FileManager;

class UserInformationController extends Controller
{
    public function index(Request $request): View|\Illuminate\Foundation\Application|Factory|Application
    {
        if (isset($request->type) && $request->type != 'all')
            $image = documents::where(['user_id' => Auth::id(), 'type' => $request->type])->get();
        else
            $image = documents::where(['user_id' => Auth::id()])->get();

        return view('dashboard.user.informations')->with([
            'title' => 'مدارک کاربر', 'types' => docTypes::types, 'type' => $request->type, 'image' => $image]);
    }

    public static function is_arabic($string)
    {
        return (preg_match('/[\p{Arabic}\p{Hebrew}]/u', $string) > 0);
    }

    public function upload(Request $request, FileManager $fm)
    {
        if (key_exists($request->type, docTypes::types)) {
            $files = $request->file('file');
            $file_name = str_replace(' ', '-', $files->getClientOriginalName());
            list($name, $ext) = explode('.', $file_name);
            if (self::is_arabic($file_name)) {
                // $ext = $request->file($files)->extension();
                $file_name = docTypes::types[$request->type] . '.' . $ext;
                $file_name = str_replace(' ', '-', $file_name);
            }
            $loc = storage_path("uploads/docs/" . auth()->id() . '/');

            if (file_exists($loc . $file_name)) {
                $increment = 0;
                list($name, $ext) = explode('.', $file_name);
                while (file_exists($loc . $file_name)) {
                    $increment++;
                    $file_name = $name . $increment . '.' . $ext;
                }
            }

            // $file = $request->file('file');
            // $file_uploaded = $fm->upload([$file],$request->input('directory'));

            if ($files->move($loc, $file_name)) {
                documents::insert([
                    'user_id' => auth()->id(),
                    'type' => $request->type,
                    'url' => $file_name,
                    'time' => time()
                ]);
                return 1;
            } else
                return 0;
        }
        return 'no';
    }

    public function delImag($id)
    {
        $img = documents::findOrFail($id);
        $url = $img->url;
        if (!empty($url))
            if (\Storage::disk('st')->delete('uploads/docs/' . auth()->id() . '/' . $url)) {
                $img->delete();
                //unlink(\Storage::delete('uploads/docs/' . auth()->id() . '/' . $url));
            }
        return redirect()->back();
    }

    public function adShow(Request $request)
    {
        $fil['filter'] = $request->filter;
        $fil['lname'] = $request->lname;
        ////dd($filters);

        $uid = documents::groupBy('user_id')->pluck('user_id');
        $accounts = auth()->user()->with('getDocs')->whereIn('id',$uid)
            ->where('code', 'like', '%' . $fil['filter'] . '%')
            ->where('lname', 'like', '%' . $fil['lname'] . '%')
            ->paginate(10);

        //$accounts = documents::paginate(10);
        return view('dashboard.admin.usersDocs')->with(['title' => 'مدارک کاربران',
            'userActs' => $accounts]);
    }
}
