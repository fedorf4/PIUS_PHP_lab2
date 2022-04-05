<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CustomerController extends Controller
{
    private static $is_blocked;
    private static $email;
    private static $phone;
    private static $name;
    public function showCustomersFiltered1(Request $request)
    {
        if (!self::$is_blocked)
            echo 'is blocked null! ' . '<br>';
        $customers = DB::table('customers');
        if (!$request->get('page')) {
            echo 'I change properties';
            self::$is_blocked = $request->get('is_blocked');
            self::$email = $request->get('emailfilter');
            self::$phone = $request->get('phonefilter');
            self::$name = $request->get('namefilter');
        }
        echo self::$is_blocked . self::$email . self::$phone . self::$name;
        $stringrequest = "&is_blocked=" . $request->get('is_blocked') . "&emailfilter=" . $request->get('emailfilter') .
            "&phonefilter=" . $request->get('phonefilter') . "&namefilter=" . $request->get('namefilter');

        if (self::$is_blocked)
            $customers = $customers->where('is_blocked', self::$is_blocked);
        if (self::$email)
            $customers = $customers->where('email', 'LIKE', '%' . self::$email . '%');
        if (self::$phone)
            $customers = $customers->where('phone', 'LIKE', '%' . self::$phone . '%');
        if (self::$name)
            $customers = $customers->where('name', 'LIKE', '%' . self::$name . '%')
                ->orWhere('surname', 'LIKE', '%' . self::$name . '%');

        $customers = $customers->simplePaginate(20);
        $page = $customers->currentPage();
        return view('allCustomersAllFields', ['customers' => $customers, 'page' => $page, 'request' => $request, 'stringrequest' => $stringrequest]);
    }

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
            $customers = $customers->where(function ($query) use ($request) {
                $query->where('name', 'LIKE', '%' . $request->get('namefilter') . '%')
                    ->orWhere('surname', 'LIKE', '%' . $request->get('namefilter') . '%');
            });

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
