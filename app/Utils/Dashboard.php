<?php

namespace App\Utils;

use App\Traits\General;
use App\Models\Consumer;
use App\Models\Inspector;
use App\Models\Installer;
use App\Models\Installation;
use App\Models\Inspection;
use App\Models\ProgressReport;
use App\Models\MaintenanceRegistry;
use App\Models\mediumBiogasPlantBelow10KW;
use App\Models\mediumBiogasPlantAbove10KW;
use App\Models\Tenders;
use App\Models\ReverseAuction;
use App\Models\Bidder;
use App\Models\SelectedBidderProject;
use App\Models\Agency;
use Auth;

class Dashboard
{
    use General;
    public function __construct(){}

    public function getSNADashboardData()
    {
        $response = [
            'total_tenders' => Tenders::count(),
            'tender_cancelled' => Tenders::where('tender_status',4)->count(),
            'reverse_auction' => ReverseAuction::count(),
            'bidders' => Bidder::count(),
            'ppapsa'=>SelectedBidderProject::whereNotNull('ppa_psa_date')->count(),
            'loaloi'=>SelectedBidderProject::whereNotNull('loi_loa_date')->count(),
            'tender_commissioned'=>Tenders::where('tender_status',4)->count(),
            'total_agency'=>Agency::count(),
            'total_underimplementation'=>Tenders::where('tender_status',2)->count(),
            'total_implemented'=>Tenders::where('tender_status',3)->count()
        ];

        return $response;
    }
    public function getMNREDashboardData()
    {
        $response = [
            'consumer_interests' => ProgressReport::count(),
            'systems_installed' => 0,
            'inspections_completed' => 0,
            'systems_approved' => 0
        ];

        return $response;
    }
    public function getSIADashboardData()
    {
        $response = [
            'consumer_interests' => ProgressReport::count(),
            'systems_installed' => 0,
            // Installation::whereIn('installations.installation_status', [4,5,6,7,8,9])
            //                                     ->where('consumers.state_id', Auth::user()->state_id)
            //                                     ->join('consumers','consumers.id','installations.consumer_id')
            //                                     ->count(),
            'inspections_completed' => 0,
            // Installation::whereIn('installation_status', [8,9])
            //                                         ->where('consumers.state_id', Auth::user()->state_id)
            //                                         ->join('consumers','consumers.id','installations.consumer_id')
            //                                         ->count(),
            'systems_approved' => 0,
            // Installation::where('installation_status', 10)
            //                                     ->where('consumers.state_id', Auth::user()->state_id)
            //                                     ->join('consumers','consumers.id','installations.consumer_id')
            //                                     ->count()
        ];

        return $response;
    }
    public function getLocalBodyDashboardData()
    {
        $response = [
            'consumer_interests' => Consumer::where('state_id', Auth::user()->state_id)->count(),
            'systems_installed' => Installation::whereIn('installations.installation_status', [4,5,6,7,8,9])
                                                ->where('consumers.state_id', Auth::user()->state_id)
                                                ->join('consumers','consumers.id','installations.consumer_id')
                                                ->count(),
            'inspections_completed' => Installation::whereIn('installation_status', [8,9])
                                                    ->where('consumers.state_id', Auth::user()->state_id)
                                                    ->join('consumers','consumers.id','installations.consumer_id')
                                                    ->count(),
            'systems_approved' => Installation::where('installation_status', 10)
                                                ->where('consumers.state_id', Auth::user()->state_id)
                                                ->join('consumers','consumers.id','installations.consumer_id')
                                                ->count()
        ];

        return $response;
    }
    public function getInspectorDashboardData()
    {
        $response = [
            'inspections_assigned' => Inspection::where('inspector_id', Auth::id())->count(),
            'inspections_complete' => Installation::whereIn('installation_status', [8,9,10])->where('inspector_id', Auth::id())->count(),
            'systems_approved' => Installation::where([['inspector_id', Auth::id()],['installation_status', 10]])->count()
        ];

        return $response;
    }
    public function getInstallerDashboardData()
    {
        $response = [
            'installations_assigned' => Installation::where('installer_id', Auth::id())->count(),
            'installations_complete' => Installation::where('installer_id', Auth::id())->whereIn('installation_status', [4,5,7,8,10])->count(),
            'maintenances_requests' => MaintenanceRegistry::where('installer_id', Auth::id())->count(),
            'maintenances_completed' => MaintenanceRegistry::where([['installer_id', Auth::id()],['status', 1]])->count()
        ];

        return $response;
    }
     public function getBeneficiaryDashboardData()
    {
        $response = [
            'SBP_interests_received'=>Consumer::where('beneficiary_id',Auth::id())->count(),
            'MBP_upto10kw_intrests_received'=>mediumBiogasPlantBelow10KW::where('beneficiary_id',Auth::id())->count(),
            //'MBP_above10kw_intrests_received'=>mediumBiogasPlantAbove10KW::where('beneficiary_id',Auth::id())->count(),
            'MBP_above10kw_intrests_received'=>mediumBiogasPlantAbove10KW::where('beneficiary_id',Auth::id())->count(),
        ];

        return $response;
    }
}