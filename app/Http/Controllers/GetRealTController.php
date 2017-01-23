<?php

namespace Timitek\GetRealT\Http\Controllers;

use Quarx;
use CryptoService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Timitek\GetRealT\Services\GetRealTService;

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
}
