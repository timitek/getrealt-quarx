<?php

namespace Timitek\GetRealT\Http\Controllers;

use Quarx;
use GetRealT;
use CryptoService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Timitek\GetRealT\Services\GetRealTService;
use Yab\Quarx\Services\ValidationService;


class GetRealTController extends Controller
{
    public function __construct(GetRealTService $getrealtService)
    {
        $this->service = $getrealtService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return view('GetRealT::quarx.getrealt.index');
    }

    /**
     * Save Settings
     *
     * @param BlogRequest $request
     *
     * @return Response
     */
    public function store(Request $request) {
        $validation = ValidationService::check([
            'customer_key' => 'required|string',
            'theme' => 'required|string',
        ]);

        if (!$validation['errors']) {
            //(new \Timitek\GetRealT\Services\GetRealTService())->setCustomerKey($request->customer_key);
            
            GetRealT::setCustomerKey($request->customer_key);
            GetRealT::setEnableExample((isset($request->enable_example)) ? "on" === $request->enable_example : false);            
            GetRealT::setGetRealTTheme($request->theme);

            Quarx::notification('Settings saved successfully.', 'success');
        } else {
            return $validation['redirect'];
        }

        return redirect(route('quarx.getrealt.index'));
    }

}
