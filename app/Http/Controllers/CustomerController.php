<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function showCustomersFiltered(Request $request)
    {
        $customers = Customer::where('email', 'LIKE', '%' . $request->get('emailfilter') . '%');
        if ($request->get('is_blocked'))
            $customers = $customers->where('is_blocked', $request->get('is_blocked'));
        if ($request->get('phonefilter'))
            $customers = $customers->where('phone', 'LIKE', '%' . $request->get('phonefilter') . '%');
        if ($request->get('namefilter'))
            $customers = $customers->where(function ($query) use ($request) {
                $query->where('name', 'LIKE', '%' . $request->get('namefilter') . '%')
                    ->orWhere('surname', 'LIKE', '%' . $request->get('namefilter') . '%');
            });
        $customers = $customers->paginate(20)->withQueryString();
        return view('allCustomersAllFields', ['customers' => $customers, 'request' => $request]);
    }

    public function showCertainCustomerAndAdresses(int $id)
    {
        $customer = Customer::with(['addresses' => function ($query) {
            $query->orderBy('created_at', 'desc');
        }])->findOrFail($id);
        return view('certainCustomerAndAddresses', ['customer' => $customer]);
    }
}
