<?php

namespace App\Http\Controllers;

use App\Cause;
use App\Postback;
use App\Report;
use App\User;
use Illuminate\Http\Request;

use Jenssegers\Agent\Agent;
use Torann\GeoIP\GeoIP;


class TrackController extends Controller
{
    public function postback(Request $request, $hash, $status = 2)
    {
        $report = Report::where('credit_hash', $hash)->first();
        if( is_null($report) || (int) $report->status === 2 )
            return "Invalid Credit Var(".$hash .")";

        $report->status = 2;
        $report->save();

        return $report->credit_hash;
    }


    public function track(Request $request, $cause_id, $offer_id)
    {
        $user = User::where('id', auth()->id())->first();
        $cause = Cause::where('id', $cause_id)->first();
        $report = new Report();
        // Check if campaign exist or inactive
        if(is_null($cause))
            return 'The cause you want to donate not exist.';

        if(!is_null($user))
            $report->user_id     = $user->id;
        $report->cause_id    = $cause->id;
        $report->status      = 1;

        $report->save();

        $url = urlencode(env('APP_URL').'/credit_hash/'.$report->id);
        return redirect(env('API_URL').'/track/'.$offer_id.'/1/?callback='.$url);
    }

    public function creditHash(Request $request, $report_id)
    {
        $report = Report::findOrFail($report_id);
        $report->credit_hash = $request->input('credit_hash', null);
        $report->rate = $request->input('rate', null);
        $report->network_rate = $request->input('network_rate', null);
        $report->save();
    }

}
