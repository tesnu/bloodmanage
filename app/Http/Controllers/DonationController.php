<?php

namespace App\Http\Controllers;

use App\Models\Donation;
use App\Models\Donor;
use App\Models\Order;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class DonationController extends Controller
{
    //
    public function showRegisterDonor() : View {
        $blood_types = ['A+', 'A-', 'B+', 'B-', 'O+', 'O-', 'AB+', 'AB-'];
        return view('donor.register', ["blood_types"=>$blood_types]);
    }
    public function postRegisterDonor(Request $request){
        $this->validate($request, [
            'name'=>['required'],
            'blood_type'=>['bail', 'required', Rule::in(['A+', 'A-', 'B+', 'B-', 'O+', 'O-', 'AB+', 'AB-'])],
            'birth_date'=>['bail', 'required', 'date_format:Y-m-d'],
            'sex'=>['bail', 'required', Rule::in(['male', 'female'])]
        ]);
        $donor = new Donor();
        $donor->name = $request->name;
        $donor->blood_type = $request->blood_type;
        $donor->birth_date = $request->birth_date;
        $donor->sex = $request->sex;
        $donor->save();
        return redirect('/donor/detail/'. $donor->id);
    }
    public function showDonorDetail($id) : View {
        $donor = Donor::find($id);
        if(!$donor) abort(404);
        return view('donor.detail', ['donor'=>$donor]);
    }
    public function postRegisterDonation($id){
        $donor = Donor::find($id);
        if(!$donor) abort(404);
        $donation = new Donation();
        $donation->donor_id = $id;
        $donation->employee_id = auth('employee')->user()->id;
        $donation->save();
        return redirect()->back();
    }
    public function postOrderDonation($id) {
        $donor = Donation::find($id);
        if(!$donor) abort(404);
        $order = new Order();
        $order->donation_id = $id;
        $order->hospital_id = auth('hospital')->user()->id;
        $order->save();
        return redirect()->back();
    }
    public function postOrderCompletion($id){
        $order = Order::where('id', $id)->update(['completed' => true]);

        return redirect()->back();
    }
}
