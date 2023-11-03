<?php

namespace App\Http\Controllers;

use App\Models\Donor;
use App\Models\Employee;
use App\Models\Hospital;
use App\Models\Order;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function showAdminLogin(): View {
        return view('staff.admin.login');
    }
    public function postAdminLogin(Request $request)
    {
        $input = $request->all();
        $this->validate($request, [
            'username' => 'required',
            'password' => 'required'
        ]);
        Auth::guard('admin')->logout();
        Auth::guard('employee')->logout();
        Auth::guard('hospital')->logout();
        if (Auth::guard('admin')->attempt(['username' => $input['username'], 'password' => $input['password']])) {
            return redirect('/admin/dashboard');
        } else {
            return redirect()->back()->with('error', 'Invalid credentials');
        }
    }
    public function showAdminDashboard(Request $request): View {
        $page_employee = $request->query('page_employee')??1;
        $page_hospital = $request->query('page_hospital')??1;
        $employees = Employee::paginate(10, ['name', 'username', 'created_at', 'id'], 'page', $page_employee);
        $hospitals = Hospital::paginate(10, ['name', 'username', 'created_at', 'id'], 'page', $page_hospital);
        return view('staff.admin.dashboard', ['employees'=>$employees, 'hospitals'=>$hospitals]);
    }
    // Hospital
    public function showHospitalLogin(): View {
        return view('staff.hospital.login');
    }
    public function postHospitalLogin(Request $request)
    {
        $input = $request->all();
        $this->validate($request, [
            'username' => 'required',
            'password' => 'required'
        ]);
        Auth::guard('hospital')->logout();
        Auth::guard('admin')->logout();
        Auth::guard('employee')->logout();
        if (Auth::guard('hospital')->attempt(['username' => $input['username'], 'password' => $input['password']])) {
            return redirect('/hospital/dashboard');
        } else {
            return redirect()->back()->with('error', 'Invalid credentials');
        }
    }
    public function showHospitalDashboard(Request $request): View {
        $blood_type = $request->query('blood_type');
        $page = $request->query('page')??1;
        $blood_types = ['A+', 'A-', 'B+', 'B-', 'O+', 'O-', 'AB+', 'AB-'];
        $donors = Donor::paginate(10, ['name', 'sex', 'blood_type', 'birth_date', 'id'], 'page', $page);
        if ($blood_type) {
            $donors = Donor::where('blood_type', '=', ''.$blood_type.'')
            ->paginate(10, ['name', 'sex', 'blood_type', 'birth_date', 'id'], 'page', $page);
        }
        return view('staff.hospital.dashboard', ['donors'=>$donors, 'blood_type'=>$blood_type, 'blood_types'=>$blood_types]);
    }
    public function showRegisterHospital(): View {
        return view('staff.hospital.register');
    }
    public function postRegisterHospital(Request $request) {
        $this->validate($request, [
            'name'=>['bail', 'required'],
            'username'=>['bail', 'required', Rule::unique('hospitals', 'username')],
            'password'=>['bail', 'required', 'min:6']
        ]);
        $hospital = new Hospital();
        $hospital->name = $request->name;
        $hospital->username = $request->username;
        $hospital->password = bcrypt($request->password);
        $hospital->save();
        return redirect('/hospital/detail/'.$hospital->id);
    }
    public function showHospitalDetail($id) : View {
        $hospital = Hospital::find($id);
        if(!$hospital) abort(404);
        return view('staff.hospital.detail', ['hospital'=>$hospital]);
    }
    public function showHospitalOrders(Request $request) : View {
        $page = $request->query('page')??1;
        $orders = Order::where('hospital_id', '=', auth('hospital')->user()->id)->paginate(10, ['id', 'updated_at', 'donation_id', 'completed'], 'page', $page);
        return view('staff.hospital.orders', ['orders'=>$orders]);
    }
    // Employee
    public function showEmployeeLogin(): View {
        return view('staff.employee.login');
    }
    public function postEmployeeLogin(Request $request)
    {
        $input = $request->all();
        $this->validate($request, [
            'username' => 'required',
            'password' => 'required'
        ]);
        Auth::guard('employee')->logout();
        Auth::guard('admin')->logout();
        Auth::guard('hospital')->logout();
        if (Auth::guard('employee')->attempt(['username' => $input['username'], 'password' => $input['password']])) {
            return redirect('/employee/dashboard');
        } else {
            return redirect()->back()->with('error', 'Invalid credentials');
        }
    }
    public function showEmployeeDashboard(Request $request): View {
        $term = $request->query('term');
        $page = $request->query('page')??1;
        $donors = Donor::paginate(10, ['name', 'sex', 'blood_type', 'birth_date', 'id'], 'page', $page);
        if ($term) {
            $donors = Donor::where('name', 'like', '%'.$term.'%')->with('donations')->paginate(10, ['name', 'sex', 'blood_type', 'birth_date', 'id'], 'page', $page);
        }
        return view('staff.employee.dashboard', ['donors'=>$donors, 'term'=>$term]);
    }
    public function showRegisterEmployee(): View {
        return view('staff.employee.register');
    }
    public function postRegisterEmployee(Request $request) {
        $this->validate($request, [
            'name'=>['bail', 'required'],
            'username'=>['bail', 'required', Rule::unique('employees', 'username')],
            'password'=>['bail', 'required', 'min:6']
        ]);
        $employee = new Employee();
        $employee->name = $request->name;
        $employee->username = $request->username;
        $employee->password = bcrypt($request->password);
        $employee->save();
        return redirect('/employee/detail/'.$employee->id);
    }
    public function showEmployeeDetail($id) : View {
        $employee = Employee::find($id);
        if(!$employee) abort(404);
        return view('staff.employee.detail', ['employee'=>$employee]);
    }
    //
    public function showLanding(): View {
        return view('landing');
    }
    public function logout() {
        Auth::guard('admin')->logout();
        Auth::guard('employee')->logout();
        Auth::guard('hospital')->logout();
        return redirect('/');
    }
    //
}
