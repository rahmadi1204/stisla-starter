<?php

namespace App\Http\Controllers\Page;

use App\Http\Controllers\ActivityLogController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\FormatterController;
use App\Http\Requests\AppRequest;
use App\Models\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class AppController extends Controller
{

    public function index()
    {
        $title = "Data Aplikasi";
        $data = App::first();
        $formatter = new FormatterController;
        $data->phone = $formatter->phoneDeformat($data->phone);
        $data = App::first();
        $formatter = new FormatterController;
        $data->phone = $formatter->phoneDeformat($data->phone);
        // dd($data);
        return view('page.app.app_index', compact('title', 'data'));

    }
    public function show()
    {
        $data = App::first();
        $formatter = new FormatterController;
        $data->phone = $formatter->phoneDeformat($data->phone);
        $data->img = $formatter->imageFormat($data->img);
        // dd($data);
        return response()->json($data);
    }
    public function update(AppRequest $request, $id)
    {
        $data = App::find($id);
        $activity = new ActivityLogController;
        DB::beginTransaction();
        try {
            if ($request->img != null) {
                if ($data->img != 'no-image.png') {
                    Storage::disk('local')->delete('public/images/' . $data->img);
                }
                $file = $request->img;
                $extension = $file->extension();
                $img_name = 'app/' . strtolower(str_replace(' ', '_', $request->name)) . '.' . $extension;
                $formatter = new FormatterController;
                $img = $formatter->uploadImage($file);
                Storage::disk('local')->put(('public/images/') . $img_name, $img, 'public');
                $data->img = $img_name;
                $data->logo = $img_name;
            }
            $formatter = new FormatterController;
            $phone = $formatter->phoneFormat($request->phone);
            $data->name = strtolower($request->name);
            $data->phone = strtolower($phone);
            $data->email = strtolower($request->email);
            $data->desc = strtolower($request->desc);
            $data->address = strtolower($request->address);
            $data->save();
            $env_update = $formatter->changeEnv([
                'APP_NAME' => str_replace(' ', '_', $data->name),
            ]);
            // dd($data);
            $log = [
                'log_type' => 'Update',
                'log_category' => 'App',
                'log_desc' => 'Update data aplikasi',
                'status' => 'Success',
            ];
            $activity->store($log);
            DB::commit();
            return redirect()->route('app.index')->with('success', 'Data berhasil diubah');
        } catch (\Throwable $th) {
            Log::error("message: " . $th->getMessage() . " line: " . $th->getLine());
            DB::rollback();
            $log = [
                'log_type' => 'Update',
                'log_category' => 'App',
                'log_desc' => 'Update data aplikasi',
                'status' => 'failed',
            ];
            $activity->store($log);
            return redirect()->route('app.index')->with('error', 'Data gagal diubah');
        }
    }
}
