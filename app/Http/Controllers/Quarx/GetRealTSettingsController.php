<?php

namespace Timitek\GetRealT\Http\Controllers\Quarx;

use Quarx;
use GetRealTSettings;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Timitek\GetRealT\Services\GetRealTSettingsService;
use Yab\Quarx\Services\ValidationService;


class GetRealTSettingsController extends Controller
{
    private $settingsService = null;
    
    public function __construct(GetRealTSettingsService $settingsService)
    {
        $this->settingsService = $settingsService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return view('GetRealT::quarx.getrealt.settings');
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
            
            GetRealTSettings::setSiteName($request->site_name);
            GetRealTSettings::setCustomerKey($request->customer_key);
            /*GetRealTSettings::setEnableExample((isset($request->enable_example)) ? "on" === $request->enable_example : false);*/
            GetRealTSettings::setGetRealTTheme($request->theme);
            GetRealTSettings::setGetRealTMapsKey($request->maps_key);
            GetRealTSettings::setGetRealTLeadsEmail($request->leads_email);
            GetRealTSettings::setGetRealTHeaderImageTag($request->header_image_tag);
            GetRealTSettings::setGetRealTAdvancedEdit($request->advanced_edit);
            
            Quarx::notification('Settings saved successfully.', 'success');
        } else {
            return $validation['redirect'];
        }

        return redirect(route('quarx.getrealt.settings.index'));
    }

}
