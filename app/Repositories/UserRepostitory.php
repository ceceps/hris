<?php

namespace App\Repositories;

use App\Http\Requests\UserRequest;
use App\Interfaces\UserInterface;
use App\Traits\ResponseAPI;
use App\User;
use DB;
use Carbon\Carbon;
use Auth;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class UserRepository implements UserInterface
{
    // Use ResponseAPI Trait in this repository
    use ResponseAPI;

    public function getAllUsers()
    {
        try {
            $users = User::paginate(10);

            if ($users->isEmpty()) return $this->success('Data User Kosong', 200);

            $users->transform(function ($user) {
                return [
                    'id' => $user->id,
                    'name' => $user->name,
                    'email_verified_at' => ($user->email_verified_at != null) ? $user->email_verified_at->format('d-m-Y h:i:s') : '',
                    'created_at' => ($user->created_at != null) ? $user->created_at->format('d-m-Y h:i:s') : '',
                    'updated_at' => ($user->updated_at != null) ? $user->updated_at->format('d-m-Y h:i:s') : '',
                ];
            });
            return $this->success("All Users", $users);
        } catch (\Exception $e) {
            return $this->error($e->getMessage(), $e->getCode());
        }
    }
    public function userJson()
    {
        $user = User::orderBy('id');
        return DataTables::of($user)
            ->addColumn('check', function ($row) {
                return '<input type="checkbox" name="cb_element[]" id="cb_element" class="cb_element" value="' . $row->id . '" />';
            })->editColumn('active', function ($row) {
                if ($row->active == false) {
                    return "<span class='label label-danger'>Non Active</span>";
                } else {
                    return "<span class='label label-success'>Active</span>";
                }
            })
            ->addColumn('link', function ($row) {
                return '<a class="btn editoffer" data-ids = "' . $row->id . '" data-name = "' . $row->name . '" data-active = "' . $row->active . '"
                     data-email = "' . $row->email . '"> <i class="feather icon-edit f-20 text-c-black"></i></a>';
            })
            ->rawColumns(['check', 'link', 'active'])
            ->addIndexColumn()
            ->make(true);
    }

    public function status(Request $request)
    {
        DB::beginTransaction();
        try {
            $user = User::find($request->ids);
            $user->active = $request->status;
            $user->save();
            DB::commit();
            return $this->success("Ubah Status", $user);
        } catch (\Exception $e) {
            DB::rollback();
            return $this->error($e->getMessage(), 422);
        }
    }

    public function getUserById($id)
    {
        try {
            $user = User::find($id);

            // Check the user
            if (!$user) return $this->error("No user with ID $id", 404);
            $user = [
                'id' => $user->id,
                'name' => $user->name,
                'email_verified_at' => ($user->email_verified_at != null) ? $user->email_verified_at->format('d-m-Y h:i:s') : '',
                'created_at' => ($user->email_verified_at != null) ? $user->email_verified_at->format('d-m-Y h:i:s') : '',
                'update_at' => ($user->email_verified_at != null) ? $user->email_verified_at->format('d-m-Y h:i:s') : '',
            ];
            return $this->success("User Detail", $user);
        } catch (\Exception $e) {
            return $this->error($e->getMessage(), $e->getCode());
        }
    }

    public function requestUser(UserRequest $request, $id = null)
    {
        DB::beginTransaction();
        try {
            // If user exists when we find it
            // Then update the user
            // Else create the new one.
            $user = $id ? User::find($id) : new User;

            // Check the user
            if ($id && !$user) return $this->error("No user with ID $id", 404);

            $user->name = $request->name;
            // Remove a whitespace and make to lowercase
            $user->email = preg_replace('/\s+/', '', strtolower($request->email));
            $user->active = $request->active;
            // I dont wanna to update the password,
            // Password must be fill only when creating a new user.
            if (!$id) $user->password = \Hash::make($request->password);

            // Save the user
            $user->save();

            DB::commit();
            return $this->success(
                $id ? "Data User berhasil diupdate"
                    : "Data User berhasil di tambahkan",
                $user,
                $id ? 200 : 201
            );
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->error($e->getMessage(), 500);
        }
    }

    public function deleteUser($id)
    {
        DB::beginTransaction();
        try {
            $user = User::find($id);

            // Check the user
            if (!$user) return $this->error("No user with ID $id", 404);

            // Delete the user
            $user->delete();

            DB::commit();
            return $this->success("User deleted", $user);
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->error($e->getMessage(), $e->getCode());
        }
    }

    public function loginUser(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
            'remember_me' => 'boolean'
        ]);
        $credentials = request(['email', 'password']);

        if (!Auth::attempt($credentials))
            return response()->json([
                'status' => 'false',
                'message' => 'Unauthorized'
            ], 401);
        $user = $request->user();
        $tokenResult = $user->createToken('Personal Access Token');
        $token = $tokenResult->token;
        if ($request->remember_me)
            $token->expires_at = Carbon::now()->addWeeks(1);
        $token->save();

        return response()->json([
            'status' => 'success',
            'access_token' => $tokenResult->accessToken,
            'token_type' => 'Bearer',
            'expires_at' => Carbon::parse(
                $tokenResult->token->expires_at
            )->toDateTimeString()
        ]);
    }

    public function logout(Request $request)
    {
        $request->user()->token()->revoke();
        return response()->json([
            'message' => 'Successfully logged out'
        ]);
    }
}
