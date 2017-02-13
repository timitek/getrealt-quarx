<?php

namespace Timitek\GetRealT\Http\Controllers\Quarx;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class GetRealTController extends Controller
{
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
