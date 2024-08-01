<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Admin\Interfaces\UserServiceInterface as UserService;
use App\Repositories\Interfaces\UserRepositoryInterface as UserRepository;
use App\Repositories\Interfaces\AddressRepositoryInterface as AddressRepository;

use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    protected $userService;

    protected $userRepository;

    protected $addressRepository;

    public function __construct(UserService $userService, UserRepository $userRepository, AddressRepository $addressRepository) {
        $this->userService = $userService;
        $this->userRepository = $userRepository;
        $this->addressRepository = $addressRepository;

    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $data['title'] = 'Admin: Người dùng';
        $data['content'] = 'user.index';
        $data['users'] = $this->userService->index($request);
        return view('backend.tabler.layout', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $data['title'] = 'Thêm mới người dùng';
        $data['content'] = 'user.create';

        $roles = Role::pluck('name', 'name')->all();

        $data['roles'] = $roles;

        return view('backend.tabler.layout', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|regex:/^[a-zA-Z][a-zA-Z0-9_.]*$/|min:5|max:32|unique:users',
            'email' => 'required|email|lowercase|max:250|unique:users',
            'password' => 'required|min:6|max:32',
        ]);
        try {
            $user = $this->userRepository->create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password)
            ]);
    
            $this->addressRepository->create([
                'user_id' => $user->id,
                'fullname' => $request->input('fullname'),
                'number_phone' => $request->input('phone_number'),
                'address_1' => $request->input('address_1'),
                'address_2' => $request->input('address_2'),
                'region' => $request->input('region'),
                'city' => $request->input('city'),
                'zipcode' => $request->input('zipcode'),
            ]);            
            $user->syncRoles($request->role);

            return redirect()->route('admin.users.index')->with('success', 'Người dùng <b>'.$user->name.'</b> đã được tạo thành công..!');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors('Thêm người dùng không thành công, hãy thử lại...');
        }
        
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, string $id)
    {
        $data['title'] = 'Chi tiết người dùng';
        $data['content'] = 'user.show';
        $data['rbc'] = '    <div class="row g-3 d-flex justify-content-end">
      <div class="col-12 col-md-4">
        <div class="input-icon">
          <span class="input-icon-addon">
            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
              <path stroke="none" d="M0 0h24v24H0z" fill="none" />
              <path d="M4 7a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12z" />
              <path d="M16 3v4" />
              <path d="M8 3v4" />
              <path d="M4 11h16" />
              <path d="M11 15h1" />
              <path d="M12 15v3" />
            </svg>
          </span>
          <input class="form-control pe-2" placeholder="Select a date" id="datepicker-stats-user" />
        </div>
      </div>
      <div class="col-6 col-md-3">
        <button class="btn btn-danger w-100">
          <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon "><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 7l16 0" /><path d="M10 11l0 6" /><path d="M14 11l0 6" /><path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" /><path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" /></svg>
          Xoá người dùng
        </button></div>
      <div class="col-6 col-md-3">
        <button class="btn btn-primary w-100">
          <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="currentColor"  class="icon"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M14.52 2c1.029 0 2.015 .409 2.742 1.136l3.602 3.602a3.877 3.877 0 0 1 0 5.483l-2.643 2.643a3.88 3.88 0 0 1 -4.941 .452l-.105 -.078l-5.882 5.883a3 3 0 0 1 -1.68 .843l-.22 .027l-.221 .009h-1.172c-1.014 0 -1.867 -.759 -1.991 -1.823l-.009 -.177v-1.172c0 -.704 .248 -1.386 .73 -1.96l.149 -.161l.414 -.414a1 1 0 0 1 .707 -.293h1v-1a1 1 0 0 1 .883 -.993l.117 -.007h1v-1a1 1 0 0 1 .206 -.608l.087 -.1l1.468 -1.469l-.076 -.103a3.9 3.9 0 0 1 -.678 -1.963l-.007 -.236c0 -1.029 .409 -2.015 1.136 -2.742l2.643 -2.643a3.88 3.88 0 0 1 2.741 -1.136m.495 5h-.02a2 2 0 1 0 0 4h.02a2 2 0 1 0 0 -4" /></svg>
          Đặt lại mật khẩu</button></div>
        </div>';
        $_data = $this->userService->show($request, $id);
        $data = $data + $_data;
        return view('backend.tabler.layout', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, string $id)
    {
        $data['title'] = 'Chỉnh sửa người dùng';
        $data['content'] = 'user.edit';
        $data['user'] = $this->userRepository->findById($id, ['*'], ['address']);
        $roles = Role::pluck('name', 'name')->all();
        $userRoles = $data['user']->roles->pluck('name', 'name')->all();

        $data['roles'] = $roles;
        $data['userRoles'] = $userRoles;

        return view('backend.tabler.layout', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = $this->userRepository->findById($id);
        
        $rules = [
            'name' => 'required|string|max:250',
            'email' => 'required|string|email',
            'created_at' => 'required|string',
        ];

        if ($user->name != $request->name) {
            $rules['name'] .= '|unique:users';
        }
        if ($user->email != $request->email) {
            $rules['email'] .= '|unique:users';
        }
    
        $request->validate($rules);
        
        $userData = [
            'name' => $request->name,
            'email' => $request->email,
            'created_at' => $request->created_at
        ];

        if (!empty($request->password)) {
            $userData['password'] = Hash::make($request->password);
        }
        
        $this->userRepository->update($id, $userData);
        
        $this->addressRepository->updateOrInsert(['user_id' => $id], [
            'fullname' => $request->input('fullname'),
            'number_phone' => $request->input('phone_number'),
            'address_1' => $request->input('address_1'),
            'address_2' => $request->input('address_2'),
            'region' => $request->input('region'),
            'city' => $request->input('city'),
            'zipcode' => $request->input('zipcode'),
        ]); 

        $user->syncRoles($request->role);

        return redirect()->back()->with('success', 'Người dùng <b>'.$user->name.'</b> đã cập nhật thành công..!');
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
