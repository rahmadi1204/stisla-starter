<?php

namespace App\Http\Controllers\Page;

use App\Http\Controllers\Controller;
use App\Models\Data\Whatsapp;
use App\Models\Data\WhatsappGroup;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;

class DatabaseController extends Controller
{
    public function index()
    {
        $title = "Database";
        $disk = Storage::disk('local');
        $files = $disk->files(str_replace('_', '-', env('APP_NAME', 'db-backup')));
        // dd($files);
        $backups = [];
        foreach ($files as $key => $f) {
            if (substr($f, -4) == '.zip' && $disk->exists($f)) {
                $backups[] = [
                    'file_path' => $f,
                    'file_name' => str_replace(config('database.backup.name') . str_replace('_', '-', env('APP_NAME', 'db-backup')) . '/', '', $f),
                    'file_size' => $disk->size($f),
                    'last_modified' => $disk->lastModified($f),
                ];
            }
        }
        $databases = array_reverse($backups);
        $title = "Database";
        return view('page.database.database_index', compact(['title', 'databases']));
    }
    public static function humanFileSize($size, $unit = "")
    {
        if ((!$unit && $size >= 1 << 30) || $unit == "GB") {
            return number_format($size / (1 << 30), 2) . "GB";
        }

        if ((!$unit && $size >= 1 << 20) || $unit == "MB") {
            return number_format($size / (1 << 20), 2) . "MB";
        }

        if ((!$unit && $size >= 1 << 10) || $unit == "KB") {
            return number_format($size / (1 << 10), 2) . "KB";
        }

        return number_format($size) . " bytes";
    }
    public function download($file_name)
    {
        $file = config('database.backup.name') . str_replace('_', '-', env('APP_NAME', 'db-backup')) . '/' . $file_name;
        try {
            $fs = Storage::disk(config('database.backup.destination.disks'))->getDriver();
            $stream = $fs->readStream($file);
            return Response::stream(function () use ($stream) {
                fpassthru($stream);
            }, 200, [
                "Content-Type" => $fs->getMimetype($file),
                "Content-Length" => $fs->getSize($file),
                "Content-disposition" => "attachment; filename=\"" . basename($file) . "\"",
            ]);
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            return redirect()->back()->with('error', 'Download Gagal');
        }
    }
    public function backup()
    {

        $whatsapp = Whatsapp::first();
        $group = WhatsappGroup::first();
        $message = "Whatsapp notification \r\n" . date('Y-m-d H:i:s') . "\r\nBackup Database Success";
        try {
            Artisan::call('backup:run --only-db');
            try {
                Http::post($whatsapp->server . '/group/send?id=' . $whatsapp->phone, [
                    'receiver' => $group->code,
                    'message' => $message,
                ]);
                $wa = 'success';
            } catch (\Throwable $th) {
                Log::error($th->getMessage());
                $wa = 'failed';
            }

            // $this->sendfile();
            return redirect()->back()->with('success', 'Backup Database Success' . $wa);
            return response()->json(['success' => true, 'message' => 'Backup Database Success !' . $wa]);

        } catch (\Throwable $th) {
            Log::error($th->getMessage());

            return redirect()->back()->with('error', 'Backup Gagal');
            return response()->json(['success' => false, 'message' => 'Backup Database Failed']);
        }
    }
}
