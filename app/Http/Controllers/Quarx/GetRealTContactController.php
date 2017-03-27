<?php

namespace Timitek\GetRealT\Http\Controllers\Quarx;

use Quarx;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Timitek\GetRealT\Services\GetRealTSettingsService;
use Yab\Quarx\Services\ValidationService;
use Yab\Quarx\Repositories\WidgetRepository;



class GetRealTContactController extends Controller
{
    public function __construct(WidgetRepository $widgetsRepo)
    {
        $this->widgetsRepository = $widgetsRepo;
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
            
            $phone = empty($request->phone) ? '' :
'        <div class="contact-phone">
            <i class="fa fa-phone"></i> 
            ' . $request->phone . '
        </div>';
            
            $social = empty($request->facebook) && empty($request->twitter) ? '' : 
'    <div class="social-icons">
        ' . (empty($request->facebook) ? '' : '<a href="' . $request->facebook . '" target="_blank"><i class="fa fa-facebook"></i></a>') . '
        ' . (empty($request->twitter) ? '' : '<a href="' . $request->twitter . '" target="_blank"><i class="fa fa-twitter"></i></a>') . '
    </div>';
            
            $content = 
'<div class="contact">
    <address>
        <div class="contact-mailing">
            <i class="fa fa-map-marker"></i>
            ' . $request->address_line1 . '<br>
            ' . $request->address_line2 . '
        </div>' . $phone . '
        <div class="contact-email">
            <i class="fa fa-envelope-open"></i> 
            <a href="mailto:' . $request->email . '">' . $request->email . '</a>
        <div>
    </address>' . $social . '
</div>';
            
            
            $currentWidget = WidgetRepository::getWidgetBySLUG('contact');
            if (empty($currentWidget)) {
                $this->widgetsRepository->store([
                    'name' => 'Contact',
                    'slug' => 'contact',
                    'content' => $content
                ]);
            }
            else {
                $this->widgetsRepository->update($currentWidget, ['content' => $content]);
            }
            
            Quarx::notification('Contact saved successfully.', 'success');
        } else {
            return $validation['redirect'];
        }

        return redirect(route('quarx.getrealt.contact.index'));
    }

}
