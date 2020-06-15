<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Customer;

class CustomerController extends Controller
{    
    public function index(Request $request)
    {
    	$keyword = $request->keyword;
    	
    	$query = Customer::query();

    	if ($keyword) {
    		$query->where('full_name', 'like', "%{$keyword}%")->paginate(10);
    	}

    	$customers = $query->orderByDesc('id')->paginate(10);

    	return view('customer.index', compact('customers'));
    }

    public function destroy(Request $request, $id)
    {
        $customer = Customer::find($id);

        $customer->delete();

        $request->session()->flash('success', 'Delete Success !');

        return redirect()->route('customers');
    }
}
