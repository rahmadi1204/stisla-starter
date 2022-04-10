<?php

namespace App\Http\Controllers\Utilities;

use App\Http\Controllers\Controller;
use App\Http\Controllers\FormatterController;
use App\Models\Data\Whatsapp;
use App\Models\Data\WhatsappGroup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class WhatsappController extends Controller
{
    public function index()
    {
        $title = "Data Whatsapp";

        $data = Whatsapp::first();
        $id = $data->phone;
        $formatter = new FormatterController;
        $data->phone = $formatter->phoneDeformat($data->phone);

        $wg = WhatsappGroup::all();
        return view('page.utilities.whatsapp_index', compact([
            'title',
            'data',
            'wg',
        ]));
    }
    public function update(Request $request)
    {
        $data = Whatsapp::first();
        try {
            $data->server = strtolower($request->url);

            $formatter = new FormatterController;
            $data->phone = $formatter->phoneFormat($request->whatsapp);
            $data->save();
            return response()->json([
                'success' => true,
                'data' => $request->url,
            ]);
        } catch (\Throwable $th) {
            Log::error("message: " . $th->getMessage() . " line: " . $th->getLine());
            return response()->json([
                'success' => false,
                'data' => $th->getMessage(),
            ]);
        }

    }
    public function qrcode()
    {
        $data = Whatsapp::first();
        $id = $data->phone;
        $formatter = new FormatterController;
        try {
            $find = Http::get($data->server . '/session/find/' . $id);
            $cek = json_decode($find->getBody());
            if ($cek->success == true) {
                $image = 'whatsapp.png';
                $image = $formatter->imageFormat($image);
                $connected = "connected";

            } elseif ($cek->success == false) {

                $response = Http::post($data->server . '/session/add', [
                    'id' => $id,
                    'isLegacy' => false,
                ]);
                $res = json_decode($response->getBody());
                // dd($res);
                $image = $res->data->qr;
                $connected = "disconnected";
            }
            return response()->json([
                'success' => true,
                'data' => $image,
                'connected' => $connected,
            ]);
        } catch (\Throwable $th) {
            $image = 'no-image.png';
            $image = $formatter->imageFormat($image);
            $connected = "failed";
            Log::error("message: " . $th->getMessage() . " line: " . $th->getLine());
            return response()->json([
                'success' => false,
                'data' => $image,
                'connected' => $connected,
            ]);
        }
    }
    public function status()
    {
        $data = Whatsapp::first();
        $id = $data->phone;
        $find = Http::get($data->server . '/session/find/' . $id);
        $cek = json_decode($find->getBody());

        // dd($cek);
        if ($cek->success == true) {
            $status = 'on';
        } elseif ($cek->success == false) {

            $status = 'off';
        }
        return response()->json($status);
    }
    public function groupSend(Request $request)
    {
        $formatter = new FormatterController;
        $receiver = $formatter->phoneFormat($request->phone);
        $data = Whatsapp::first();
        $id = $data->phone;
        try {
            $response = Http::post($data->server . '/group/send?id=' . $id, [
                'receiver' => $receiver,
                'message' => $request->message,
            ]);
            return response()->json([
                'success' => true,
                'data' => $response->getBody(),
                'receiver' => $receiver,
            ]);
        } catch (\Throwable $th) {
            Log::error("message: " . $th->getMessage() . " line: " . $th->getLine());
            return response()->json([
                'success' => false,
                'data' => $th->getMessage(),
            ]);
        }
    }
    public function group()
    {
        $data = Whatsapp::first();
        $id = $data->phone;
        $find = Http::get($data->server . '/group/get?id=' . $id);
        $cek = json_decode($find->getBody());
        return response()->json(
            $cek->data);
    }
    public function send(Request $request)
    {
        $formatter = new FormatterController;
        $receiver = $formatter->phoneFormat($request->phone);
        $data = Whatsapp::first();
        $id = $data->phone;
        try {
            $response = Http::post($data->server . '/chat/send?id=' . $id, [
                'receiver' => $receiver,
                'message' => $request->message,
            ]);
            return response()->json([
                'success' => true,
                'data' => $response->getBody(),
                'receiver' => $receiver,
            ]);
        } catch (\Throwable $th) {
            Log::error("message: " . $th->getMessage() . " line: " . $th->getLine());
            return response()->json([
                'success' => false,
                'data' => $th->getMessage(),
            ]);
        }
    }
}
