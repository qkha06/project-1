<?php

namespace App\Http\Controllers\member;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\UserAddress;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();

        $user_address = $user->address;

        return view('backend.member.profile.index', compact('user_address'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $request->validate([
            'fullname' => 'required|max:200',
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique(User::class)->ignore(auth()->user()->id)],
            'phonenumber' => 'required|numeric',
            'address_1' => 'required|max:200',
            'address_2' => 'max:200',
            'country' => 'required|max:200',
            'city' => 'max:200',
            'region' =>  'max:200',
            'zipcode' => 'max:10',
        ], ['email.unique' => 'Email này đã được người khác sử dụng.']);

        $data = [
            'user_id' => $request->user()->id,
            'fullname' => $request->fullname,
            'number_phone' => $request->phonenumber,
            'address_1' => $request->address_1,
            'address_2' => $request->address_2,
            'country' => $request->country,
            'city' => $request->city,
            'region' =>  $request->region,
            'zipcode' => $request->zipcode,
        ];

        $dataAddress = UserAddress::where('user_id', $request->user()->id)->first();
        User::where('id', $request->user()->id)->update([
            'email' => $request->email
        ]);

        if ($dataAddress) {
            UserAddress::where('user_id', $request->user()->id)->update($data);
        } else {
            UserAddress::create($data);
        }

        return redirect()->back()->with('success', 'Cập nhật thông tin thành công');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
