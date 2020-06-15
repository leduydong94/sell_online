<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Bill;
use App\BillDetail;

class BillController extends Controller
{
    public function index(Request $request)
    {
    	$keyword = $request->keyword;

    	$query = Bill::query();

    	if ($keyword) {
    		$query->where('name', 'like', "%{$keyword}%")->paginate(10);
    	}

    	$bills = $query->orderByDesc('id')->paginate(10);

    	return view('bill.index', compact('bills'));
    }

    public function editBill(Request $request, $id)
    {
        $bill = Bill::find($id);

        return view('bill.edit', compact('bill'));
    }

    public function updateBill(Request $request, $id)
    {
        $bill = Bill::find($id);

        $bill->status = $request->status;

        $bill->save();

        $request->session()->flash('success', 'Updated !');

        return redirect()->route('bills');
    }

    public function show(Request $request)
    {
    	$keyword = $request->keyword;

    	$query = BillDetail::query();

    	if ($keyword) {
    		$query->where('name', 'like', "%{$keyword}%")->paginate(10);
    	}

    	$billDetails = $query->orderByDesc('id')->paginate(10);

    	return view('bill.detail', compact('billDetails'));
    }

    public function editDetail(Request $request, $id)
    {
        $billDetail = BillDetail::find($id);

        return view('bill.editDetail', compact('billDetail'));
    }

    public function updateDetail(Request $request, $id)
    {
        $billDetail = BillDetail::find($id);

        $billDetail->status = $request->status;

        $billDetail->save();

        $request->session()->flash('success', 'Updated !');

        return redirect()->route('bill-details');
    }

    public function destroyBill(Request $request, $id)
    {
        $bill = Bill::find($id);

        $bill->delete();

        $request->session()->flash('success', 'Delete Success !');

        return redirect()->route('bills');
    }

    public function destroyDetail(Request $request, $id)
    {
        $billDetails = BillDetail::where('bill_id', '=', $id)->get();

        foreach($billDetails as $billDetail) 
		{
		    $billDetail->delete();
		}

        $request->session()->flash('success', 'Delete Success !');

        return redirect()->route('bill-details');
    }
}
