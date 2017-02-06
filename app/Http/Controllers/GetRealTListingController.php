<?php

namespace Timitek\GetRealT\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GetRealTListingController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->respondData("asdf");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }
}
