<?php

namespace App\Http\Controllers;

use App\Models\Lead;
use App\Services\SmsService;
use App\Services\VapiService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MarketingController extends Controller
{
    protected $smsService;
    protected $vapiService;

    public function __construct(SmsService $smsService, VapiService $vapiService)
    {
        $this->smsService = $smsService;
        $this->vapiService = $vapiService;
    }

    /**
     * Display the marketing landing page.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('marketing');
    }

    /**
     * Handle the lead capture form submission.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function subscribe(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'phone_number' => 'required|string|max:20|unique:leads,phone_number',
            'email' => 'nullable|email|max:255',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $lead = Lead::create($request->all());

        // Send a welcome SMS notification
        $this->smsService->send(
            $lead->phone_number,
            "Hi {$lead->name}, welcome to the WolfPaq! You'll receive our latest SMS marketing updates right here."
        );

        // Optional: kick off an outbound AI call to greet/qualify the lead.
        // Safe to leave enabled; it no-ops unless VAPI_API_KEY + VAPI_ASSISTANT_ID are configured.
        $this->vapiService->createOutboundCall(
            $lead->phone_number,
            config('services.vapi.assistant_id'),
            [
                'leadId' => $lead->id,
                'leadName' => $lead->name,
                'leadPhone' => $lead->phone_number,
                'leadEmail' => $lead->email,
                'context' => 'WolfPaq Marketing Lead',
            ]
        );

        return back()->with('success', 'Thank you for subscribing to our SMS marketing updates!');
    }
}
