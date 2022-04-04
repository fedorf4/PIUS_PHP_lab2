<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CustomerController extends Controller
{
    public function showCustomersFiltered(Request $request)
    {
        $customers = DB::table('customers');
        $stringrequest = "&is_blocked=" . $request->get('is_blocked') . "&emailfilter=" . $request->get('emailfilter') .
            "&phonefilter=" . $request->get('phonefilter') . "&namefilter=" . $request->get('namefilter');

        if ($request->get('is_blocked'))
            $customers = $customers->where('is_blocked', $request->get('is_blocked'));
        if ($request->get('emailfilter'))
            $customers = $customers->where('email', 'LIKE', '%' . $request->get('emailfilter') . '%');
        if ($request->get('phonefilter'))
            $customers = $customers->where('phone', 'LIKE', '%' . $request->get('phonefilter') . '%');
        if ($request->get('namefilter'))
            $customers = $customers->where('name', 'LIKE', '%' . $request->get('namefilter') . '%')
                ->orWhere('surname', 'LIKE', '%' . $request->get('namefilter') . '%');

        $customers = $customers->paginate(20);
        $page = $customers->currentPage();
        return view('allCustomersAllFields', ['customers' => $customers, 'page' => $page, 'request' => $request, 'stringrequest' => $stringrequest]);
    }

    public function showCertainCustomerAndAdresses(int $id)
    {
        $customer = Customer::with(['addresses' => function ($query) {
            $query->orderBy('created_at', 'desc');
        }])->findOrFail($id);
        return view('certainCustomerAndAddresses', ['customer' => $customer]);
    }
}
