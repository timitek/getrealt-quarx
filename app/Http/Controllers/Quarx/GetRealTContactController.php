<?php

namespace Timitek\GetRealT\Http\Controllers\Quarx;

use Quarx;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yab\Quarx\Services\ValidationService;
use Timitek\GetRealT\Services\GetRealTContactService;



class GetRealTContactController extends Controller
{
    public function __construct()
    {
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return view('GetRealT::quarx.getrealt.contact');
    }

    /**
     * Save Contact
     *
     * @param BlogRequest $request
     *
     * @return Response
     */
    public function store(Request $request) {
        $validation = ValidationService::check([
            'address_line1' => 'required|string',
            'address_line2' => 'required|string',
            'email' => 'required|string',
        ]);

        if (!$validation['errors']) {
            $details = (object)[
                'address_line1' => $request->address_line1,
                'address_line2' => $request->address_line2,
                'phone' => $request->phone,
                'email' => $request->email,
                'facebook' => $request->facebook,
                'twitter' => $request->twitter,
                'youtube' => $request->youtube,
                'google_plus' => $request->google_plus,
                'linkedin' => $request->linkedin
            ];
            
            $contactService = new GetRealTContactService();
            $contactService->saveContact($details);
            
            Quarx::notification('Contact saved successfully.', 'success');
        } else {
            return $validation['redirect'];
        }

        return redirect(route('quarx.getrealt.contact.index'));
    }

}
