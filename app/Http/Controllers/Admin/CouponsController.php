<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;
use App\Coupons;
class CouponsController extends Controller
{
    public function addCoupon(Request $request){
        if($request->isMethod('post')){
            $data = $request->all();
            $coupon->coupon_code = $data['coupon_code'];
            $coupon->amount = $data['coupon_amount'];
            $coupon->amount_type = $data['amount_type'];
            $coupon->expiry_date = $data['expiry_date'];
            $coupon->save();
            return redirect('/admin/view_coupons')->with('flash_message_success', 'Kupon telah berhasil ditambahkan');
        }
        return view('admin.coupons.add_coupon', $this->data);
    }

    public function viewCoupons(){
        $coupons = Coupons::get();
        return view('admin.coupons.view_coupons', $this->data)->with(compact('coupons'));
        return view('admin.coupons.view_coupons')->with(compact('coupons'));
        }

        public function updateStatus(Request $request,$id=null){
            $data = $request->all();
            Coupons::where('id', $data['id'])->update(['status'=>$data['status']]);
        } 
        public function editCoupon(Request $request,$id=null){
            if($request->isMethod('post')){
                $data = $request->all();
                $coupon = new Coupons;
                $coupon->coupon_code = $data['coupon_code'];
                $coupon->amount = $data['coupon_amount'];
                $coupon->amount_type = $data['amount_type'];
                $coupon->expiry_date = $data['expiry_date'];
                $coupon->save();
                return redirect('/admin/view_coupons')->with('flash_message_success', 'Kupon telah Berhasil Diperbarui');
            }
            $couponDetails = Coupons::find($id);
            return view('admin/coupons/edit_coupon', $this->data)->with(compact('couponDetails'));
        }      
        public function deleteCoupon($id=null){
            Coupons::where(['id'=>$id])->delete();
            Alert::success('Deleted', 'Success Message');
            return redirect('/admin/view_coupons')->with('flash_message_success', 'Kupon telah berhasil dihapus');
        }
}
