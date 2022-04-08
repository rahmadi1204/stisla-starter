<?php

namespace App\Http\Controllers\Data;

use App\Http\Controllers\Controller;
use App\Http\Controllers\FormatterController;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Carbon\Carbon;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Models\Role;
use Yajra\Datatables\Datatables;

class UserController extends Controller
{

    public function index(Request $request)
    {
        if ($request->ajax()) {
            return $this->get($request);
        }
        $title = 'Data User';
        $role = Role::pluck('name', 'id');
        return view('user.user_index', compact(['title', 'role']));
    }
    public function query(Request $request)
    {
        // $expDate = Carbon::now()->subMinutes(2);
        if ($request->status == 0) {
            $data = User::whereBetween('created_at', [$request->from, Carbon::parse($request->to)->addDay(1)])
                ->where(function ($query) use ($request) {
                    if (auth()->user()->code != 'developer') {
                        $query->where('code', '!=', 'developer');
                    }
                })
            // ->where(function ($query) use ($expDate) {
            //     $query->where('last_seen', '<', $expDate)
            //         ->orWhere('last_seen', null);
            // })
                ->get();
        } elseif ($request->status == 1) {
            $data = User::whereBetween('created_at', [$request->from, Carbon::parse($request->to)->addDay(1)])
                ->where(function ($query) use ($request) {
                    if (auth()->user()->code != 'developer') {
                        $query->where('code', '!=', 'developer');
                    }
                })
            // ->where(function ($query) use ($expDate) {
            //     $query->where('last_seen', '>=', $expDate)
            //         ->orWhere('last_seen', '!=', null);
            // })
                ->get();
        } elseif ($request->status == 'null') {
            $data = User::whereBetween('date', [$request->from, Carbon::parse($request->to)->addDay(1)])
                ->where(function ($query) use ($request) {
                    if (auth()->user()->code != 'developer') {
                        $query->where('code', '!=', 'developer');
                    }
                })
                ->get();
        }
        return $data;
    }
    public function get(Request $request)
    {
        $data = $this->query($request);
        return Datatables::of($data)
            ->editColumn('checkbox', function ($item) {
                return ' <input type="checkbox" name="checkbox[]" class="pr-1 input-checkbox" value="' . $item->id . '">';
            })
            ->addIndexColumn()
            ->editColumn('img', function ($item) {
                if ($item->img != 'no-image.png') {
                    $path = asset('storage/images/' . $item->img);
                } else {
                    $path = asset('storage/images/no-image.png');
                }
                return '
                <img alt="image" src="' . $path . '"
                class="img-thumbnail profile-widget-picture" style="max-height: 100px"
                onclick="showImage(' . $item->id . ',\'' . $item->img . '\',\'' . $item->name . '\')" data-toggle="modal" data-target="modal-img">
                ';
            })
            ->addColumn('role', function ($item) {
                return $item->getRoleNames()->first() ?? 'Tidak Ada Role';
            })
            ->editColumn('status', function ($item) {
                $expDate = Carbon::now()->subMinutes(2);
                if (Cache::has('user-is-online-' . $item->id)) {
                    $status = '<span class="badge badge-success">online</span>';
                } else {
                    $status = '<span class="badge badge-danger">Offline</span>';
                }
                return $status;
            })
            ->editColumn('action', function ($item) {
                $a = '<div class="d-flex justify-content-center">';
                $edit = '<div class="btn btn-success mx-1" title="Edit Data"
                data-toggle="modal" data-target="#modal-edit"
                onclick="edit(' . $item->id . ')"
                ><i class="fa fa-edit"></i></div>';
                $delete = '<div class="btn btn-danger mx-1"
                onclick="deleteConfirm(' . $item->id . ',' . "'" . $item->name . "'" . ')" title="Delete Data"
                ><i class="fa fa-trash-alt"></i></div>';
                $b = '</div>';
                $action = $a . $edit . $delete . $b;
                return $action;
            })
            ->rawColumns(['checkbox', 'img', 'status', 'action'])
            ->make();
    }

    public function show(Request $request)
    {
        $show = User::findOrFail($request->id);
        $show->name = ucwords($show->name);
        $show->role = ($show->getRoleNames()->first() ?? '');
        return response()->json($show);
    }
    public function store(UserRequest $request)
    {
        DB::beginTransaction();
        try {
            $id = IdGenerator::generate(['table' => 'users', 'field' => 'uid', 'length' => 6, 'prefix' => 'USR']);
            $data = User::create([
                'uid' => $id,
                'code' => 'user',
                'name' => strtolower($request->name),
                'username' => strtolower($request->username),
                'email' => strtolower($request->email),
                'password' => bcrypt($request->password),
            ]);
            $data->assignRole($request->role);
            if ($request->img != null) {
                $file = $request->img;
                $extension = $file->extension();
                $img_name = 'users/' . strtolower(str_replace(' ', '_', $request->name)) . '.' . $extension;
                $formatter = new FormatterController;
                $img = $formatter->uploadImage($file);
                Storage::disk('local')->put(('public/images/') . $img_name, $img, 'public');
                $data->img = $img_name;
                $data->save();
            }
            $message = "Data " . ucwords($data->name) . " Berhasil Ditambahkan";

            DB::commit();
            // return response('success');
            return redirect()->back()->with('success', $message);
        } catch (\Throwable $th) {
            DB::rollBack();
            Log::error($th->getMessage());
            $message = "Data Gagal Ditambahkan";
            // return response($th->getMessage());
            return redirect()->back()->with('error', $message);
        }
    }
    public function update(Request $request)
    {
        $data = User::findOrFail($request->id);
        DB::beginTransaction();
        try {
            $data->username = strtolower($request->username);
            $data->name = strtolower($request->name);
            $data->email = strtolower($request->email);
            $data->password = bcrypt($request->password);
            $data->save();
            $message = "Data " . ucwords($data->name) . " Berhasil Diubah";
            $data->revokePermissionTo($data->role);
            $data->assignRole($request->role);
            if ($request->img != null) {
                Storage::disk('local')->delete('public/images/' . $data->img);
                $file = $request->img;
                $extension = $file->extension();
                $img_name = 'users/' . strtolower(str_replace(' ', '_', $request->name)) . '.' . $extension;
                $formatter = new FormatterController;
                $img = $formatter->uploadImage($file);
                Storage::disk('local')->put(('public/images/') . $img_name, $img, 'public');
                $data->img = $img_name;
                $data->save();
            }
            DB::commit();
            // return response('success');
            return redirect()->back()->with('success', $message);
        } catch (\Throwable $th) {
            DB::rollBack();
            Log::error($th->getMessage());
            $message = "Data " . ucwords($data->name) . " Gagal Diubah";
            // return response($th->getMessage());
            return redirect()->back()->with('error', $message);
        }
    }
    public function destroy(Request $request)
    {
        $data = User::find($request->id);
        if (Cache::has('user-is-online-' . $data->id)) {
            return response()->json('User Sedang Login');
        }
        DB::beginTransaction();
        try {
            if ($data->img != 'no-image.png') {
                $path = 'public/images/' . $data->img;
                Storage::delete($path);
            }
            $data->delete();
            DB::commit();
            $message = "Data " . ucwords($data->name) . " Berhasil Dihapus";
            $status = 'success';
            return response()->json($status);
            // return redirect()->back()->with('success', 'Data Berhasil Dihapus');
        } catch (\Throwable $th) {
            DB::rollBack();
            $message = "Data " . ucwords($data->name) . " Gagal Dihapus";
            Log::error($th->getMessage());
            $status = 'error';
            return response()->json($th->getMessage());
            // return redirect()->back()->with('error', 'Data Gagal Dihapus');
        }
    }
    public function destroyMulti(Request $request)
    {
        // dd($request);
        if (!$request->id) {
            return response()->json('not checked');
        }

        DB::beginTransaction();
        try {
            $c = count($request->id);
            for ($i = 0; $i < $c; $i++) {
                $data = User::find($request->id[$i]);
                if (Cache::has('user-is-online-' . $data->id)) {
                    return response()->json('Ada User Yang Sedang Login');
                }
                if ($data->img != 'no-image.png') {
                    $path = 'public/images/' . $data->img;
                    Storage::delete($path);
                }
                $data->delete();
                $message = "Data " . ucwords($data->name) . " Berhasil Dihapus";
            }
            DB::commit();
            $status = 'success';
            return response()->json($status);
            // return redirect()->back()->with('success', 'Data Berhasil Dihapus');
        } catch (\Throwable $th) {
            DB::rollBack();
            $message = "Data User Gagal Dihapus";
            Log::error($th->getMessage());
            $status = 'error';
            return response()->json($th->getMessage());
            // return redirect()->back()->with('error', 'Data Gagal Dihapus');
        }
    }
    // function print(Request $request) {
    //     $data = $this->query($request);
    //     // dd($data);
    //     $title = "Data User";
    //     $company = Company::first();
    //     $image = $company->logo;
    //     $file = public_path('images/' . $image);
    //     $image = base64_encode(file_get_contents($file));
    //     $image = 'data:image/jpeg;charset=utf-8;base64,' . $image;
    //     $pdf = PDF::loadView('users.user_print', compact(['data', 'title', 'company', 'image']));

    //     return $pdf->stream();
    // }
}
