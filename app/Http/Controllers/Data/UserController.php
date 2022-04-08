<?php

namespace App\Http\Controllers\Data;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
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
        $data = User::get();
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
                if ($item->img != null) {
                    $path = asset('storage/images/' . $item->img);
                } else {
                    $path = asset('storage/images/no-image.png');
                }
                return '
                <img alt="image" src="' . $path . '"
                class="img-thumbnail profile-widget-picture" style="max-height: 100px"
                onclick="showImage(' . $item->id . ',\'' . $item->img . '\',\'' . $item->name . '\')" data-toggle="modal" data-target="modal-img"
                id="img">
                ';
            })
            ->addColumn('role', function ($item) {
                return $item->getRoleNames()->first() ?? 'Tidak Ada Role';
            })
            ->editColumn('action', function ($item) {
                $a = '<div class="d-flex justify-content-center">';
                $edit = '<div class="btn btn-sm btn-success rounded py-1 px-2 mx-1" title="Edit Data"
                data-toggle="modal" data-target="#modal-edit"
                onclick="edit(' . $item->id . ')"
                ><i class="fa fa-edit"></i></div>';
                $delete = '<div class="btn btn-sm btn-danger rounded py-1 px-2 mx-1"
                onclick="deleteConfirm(' . $item->id . ')"
                ><i class="fa fa-trash"></i></div>';
                $b = '</div>';
                $action = $a . $edit . $delete . $b;
                return $action;
            })
            ->rawColumns(['checkbox', 'img', 'action'])
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
            $data = User::create([
                'code' => 'user',
                'name' => strtolower($request->name),
                'username' => strtolower($request->username),
                'email' => strtolower($request->email),
                'password' => bcrypt($request->password),
            ]);
            $message = "Data " . ucwords($data->name) . " Berhasil Ditambahkan";

            DB::commit();
            // return response('success');
            return redirect()->back()->with('success', $message);
        } catch (\Throwable $th) {
            DB::rollBack();
            Log::error($th->getMessage());
            $message = "Data " . ucwords($data->name) . " Gagal Ditambahkan";
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

        DB::beginTransaction();
        try {

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
