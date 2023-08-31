<table class="table table-bordered" id="stakeHoldersTable1" border="1">
    <tr>
        <td colspan=36 align="center" style="backgroung-color:#000; border:2px"><b> Master Sheet for all Grid Connected
                Solar Capacity (Tendering to
                Commissioning) details of Solar Projects till 30-04-2023</b></td>
    </tr>
    <tr>
        <td colspan=3 align="center"><b>Name of State/Agency</b></td>
        <td colspan=24 align="center"><b>{{$userdata->agency_name}}</b></td>
        <td colspan=13 rowspan=5 align="center"><b>
                <font size=4>For any assistance pls contact<br>Ministry of New &amp; Renewable Energy
                    <br>National Solar Mission (NSM) Division, Block-14, CGO Complex, New Delhi<br>Email:
                    nsm.mnre@gmail.com | Tele/Fax: 011 24360764 | Ext. 1901/1923, 9929205059
            </b></td>
    </tr>
    <tr>
        <td colspan=3 align="center"><b> Contact Person</b></td>
        <td colspan=24 align="center"><b>{{$userdata->contact_person}} <br></b></td>
    </tr>
    <tr>
        <td colspan=3 align="center"><b> Office Address</b></td>
        <td colspan=24 align="center"><b>{{$userdata->office_addess}}</b></td>
    </tr>
    <tr>
        <td colspan=3 align="center"><b>Email </b></td>
        <td colspan=24 align="center"><b>{{$userdata->email}}</b></td>
    </tr>
    <tr>
        <td colspan=27 align="center" bgcolor="#92D050"><b> <br> </b></td>
    </tr>
    <tr>
        <td rowspan=3 height="159" align="center"><b> S. No. </b></td>
        <td colspan=8 align="center" bgcolor="#D9D9D9"><b> Information </b></td>
        <td colspan=5 align="center" bgcolor="#C6D9F1"><b> Details of Tender/NIT/RFS <br>Issued/Published</b></td>
        <td colspan=2 align="center" bgcolor="#558ED5"><b> Reverse Auction <br>(if applicable) </b></td>
        <td colspan=3 align="center" bgcolor="#E6B9B8"><b> Tender Cancelled, if any </b></td>
        <td colspan=3 align="center" bgcolor="#D7E4BD"><b> Details of Selected Bidders </b></td>
        <td colspan=3 align="center" bgcolor="#77933C"><b> Details of Tariffs Discovered<br>(Rs/kWh) </b>
        </td>
        <td colspan=6 align="center" bgcolor="#B3A2C7"><b> Signing of PSA </b></td>
        <td colspan=4 align="center" bgcolor="#B3A2C7"><b> Signing of PPA </b></td>
        <td colspan=4 align="center"><b> Status of Commissioning </b></td>
        <td rowspan=3 align="center"><b> Remark, if any </b></td>
    </tr>
    <tr>
        <td rowspan=2 align="center"><b> Name of the State </b></td>
        <td rowspan=2 align="center"><b> Name of Scheme (Central/State Scheme) </b></td>
        <td rowspan=2 align="center"><b> Bidding Agency </b></td>
        <td colspan=5 align="center"><b> Project Location </b></td>
        <td rowspan=2 align="center"><b> Tendered Capacity (MW) </b></td>
        <td rowspan=2 align="center"><b> Date of NIT </b></td>
        <td rowspan=2 align="center"><b> Date of RFS </b></td>
        <td rowspan=2 align="center"><b> Date of Pre Bid Meeting, (if any) </b></td>
        <td rowspan=2 align="center"><b> Last Date <br>of Bids Submission </b></td>
        <td rowspan=2 align="center"><b> Date of RA/e-RA </b></td>
        <td rowspan=2 align="center"><b> Capacity (MW) </b></td>
        <td rowspan=2 align="center"><b> Date </b></td>
        <td rowspan=2 align="center"><b> Capacity (MW) </b></td>
        <td rowspan=2 align="center"><b> Remarks </b></td>
        <td rowspan=2 align="center"><b> Name of Company </b></td>
        <td rowspan=2 align="center"><b> Capacity (MW) </b></td>
        <td rowspan=2 align="center"><b> Date of LoI/LoA </b></td>
        <td rowspan=2 align="center"><b> Highest Tariff </b></td>
        <td rowspan=2 align="center"><b> Lowest Tariff </b></td>
        <td rowspan=2 align="center"><b> Weighted Average </b></td>
        <td rowspan=2 align="center"><b> Date of PSA </b></td>
        <td rowspan=2 align="center"><b> Capacity (MW) </b></td>
        <td rowspan=2 align="center"><b> Name of State in PPA/PSA Signed </b></td>
        <td rowspan=2 align="center"><b> Name of Discoms who have signed PPA/PSA </b></td>
        <td rowspan=2 align="center"><b> per unit cost of electricity as per the said PPA </b></td>
        <td rowspan=2 align="center"><b> Duration of PPA </b></td>

        <td rowspan=2 align="center"><b> Date of PPA </b></td>
        <td rowspan=2 align="center"><b> Capacity (MW) </b></td>
        <td rowspan=2 align="center"><b> Per Unit cost of electricity as per said PPA </b></td>
        <td rowspan=2 align="center"><b> Duration of PPA(In Years) </b></td>




        <td rowspan=2 align="center"><b> Scheduled <br>Date of Commissioning as per PPA </b></td>
        <td rowspan=2 align="center"><b> Extended/Actual Date of Commissioning </b></td>
        <td rowspan=2 align="center"><b> Capacity Commissioned as per Scheduled <br>Date of Commissioning(MW) </b></td>
        <td rowspan=2 align="center"><b> Capacity Commissioned after Scheduled <br>Date of Commissioning(MW) </b></td>
    </tr>
    <tr>
        <td align="center"><b> Village </b></td>
        <td align="center"><b> Tehsil/Taluka </b></td>
        <td align="center"><b> Dist. </b></td>
        <td align="center"><b> Longitude </b></td>
        <td align="center"><b> Latitude </b></td>
    </tr>


    @foreach($tenderArray as $tdata)


    <tr>
        <td rowspan="{{$tdata['projectCount']}}" align="center" valign=middle>{{$loop->iteration}}</td>
        <td rowspan="{{$tdata['projectCount']}}" align="center" valign=middle>{{$tdata['state']}}</td>
        <td rowspan="{{$tdata['projectCount']}}" align="center" valign=middle>{{$tdata['scheme_type']}}</td>
        <td rowspan="{{$tdata['projectCount']}}" align="center" valign=middle>{{$tdata['agency_name']}}</td>
        <td align="center" valign=middle>{{$tdata['village_id']}}</td>
        <td align="center" valign=middle>{{$tdata['sub_district_id']}} </td>
        <td align="center" valign=middle>{{$tdata['district_id']}} </td>
        <td align="center" valign=middle>{{$tdata['lat']}} E </td>
        <td align="center" valign=middle>{{$tdata['lng']}} N</td>
        <td rowspan="{{$tdata['projectCount']}}" align="center" valign=middle>{{$tdata['capacity']}} </td>
        <td rowspan="{{$tdata['projectCount']}}" align="center" valign=middle>{{$tdata['nit_date']}} </td>
        <td rowspan="{{$tdata['projectCount']}}" align="center" valign=middle>{{$tdata['rfs_date']}} </td>
        <td rowspan="{{$tdata['projectCount']}}" align="center" valign=middle>{{$tdata['pre_bid_meeting_date']}}</td>
        <td rowspan="{{$tdata['projectCount']}}" align="center" valign=middle>{{$tdata['bid_submission_date']}}</td>
        <td rowspan="{{$tdata['projectCount']}}" align="center" valign=middle>{{$tdata['ra_date'] ?? 'NA'}}</td>
        <td rowspan="{{$tdata['projectCount']}}" align="center" valign=middle>{{$tdata['ra_capacity'] ?? 'NA'}}</td>
        <td rowspan="{{$tdata['projectCount']}}" align="center" valign=middle>{{$tdata['cancel_date'] ?? 'NA'}}</td>
        <td rowspan="{{$tdata['projectCount']}}" align="center" valign=middle>{{$tdata['c_capacity'] ?? 'NA'}}</td>
        <td rowspan="{{$tdata['projectCount']}}" align="center" valign=middle>Cancel Remark</td>
        <td align="center" rowspan="{{$tdata['project_count']}}" valign=middle>{{$tdata['bidder_name']}}</td>
        <td align="center" rowspan="{{$tdata['project_count']}}" valign=middle>{{$tdata['bidder_capacity']}}</td>
        <td align="center" rowspan="{{$tdata['project_count']}}" valign=middle>{{$tdata['loa_date']}}</td>
        <td rowspan="{{$tdata['projectCount']}}" align="center" valign=middle> {{$tdata['costMaxPSA']}}-----aaaaaa </td>
        <td rowspan="{{$tdata['projectCount']}}" align="center" valign=middle> {{$tdata['costMinPSA']}} </td>
        <td rowspan="{{$tdata['projectCount']}}" align="center" valign=middle> {{$tdata['avgCostPSA']}}</td>

        <td align="center" valign=middle>{{$tdata['ppa_psa_date']}}</td>
        <td align="center" valign=middle>{{$tdata['ppa_psa_capacity']}} </td>
        <td align="center" valign=middle>{{$tdata['state']}} </td>
        <td align="center" valign=middle>{{$tdata['discom_name']}} </td>
        <td align="center" valign=middle>{{$tdata['electricity_per_unit_cost']}} </td>
        <td align="center" valign=middle>{{$tdata['duration_ppa']}} </td>

        <td align="center" valign=middle>{{$tdata['ppa_date']}}</td>
        <td align="center" valign=middle>{{$tdata['ppa_capacity']}} </td>
        <td align="center" valign=middle>{{$tdata['ppa_electricity_per_unit_cost']}} </td>
        <td align="center" valign=middle>{{$tdata['duration_ppa']}} </td>






        <td align="center" valign=middle>{{$tdata['schedule_commissiong_date']}} </td>
        <td align="center" valign=middle>{{$tdata['commissioned_capacity']}} </td>
        <td align="center" valign=middle>{{$tdata['actual_commissiong_date']}}</td>
        <td align="center" valign=middle>{{$tdata['actual_commissioned_capacity']}} </td>
        <td align="center" valign=middle> <br> </td>
    </tr>
    @if($tdata['project_count']>1)
    <?php $x=0;?>
    @foreach($tdata['project_count_data'] as $pdata)
    @if($x>0)
    <tr>
        <td align="center" valign=middle>{{$pdata['village_id']}}</td>
        <td align="center" valign=middle>{{$pdata['sub_district_id']}}</td>
        <td align="center" valign=middle>{{$pdata['district_id']}}</td>
        <td align="center" valign=middle>{{$pdata['lat']}} E</td>
        <td align="center" valign=middle>{{$pdata['lng']}} N</td>
        <td align="center" valign=middle>{{$pdata['ppa_psa_date']}}</td>
        <td align="center" valign=middle>{{$pdata['ppa_psa_capacity']}} </td>
        <td align="center" valign=middle>{{$pdata['state']}} </td>
        <td align="center" valign=middle>{{$pdata['discom_name']}} </td>
        <td align="center" valign=middle>{{$pdata['electricity_per_unit_cost']}} </td>
        <td align="center" valign=middle>{{$pdata['duration_ppa']}} </td>

        <td align="center" valign=middle>{{$tdata['ppa_date']}}</td>
        <td align="center" valign=middle>{{$tdata['ppa_capacity']}} </td>
        <td align="center" valign=middle>{{$tdata['ppa_electricity_per_unit_cost']}} </td>
        <td align="center" valign=middle>{{$tdata['duration_ppa']}} </td>



        <td align="center" valign=middle>{{$pdata['schedule_commissiong_date']}} </td>
        <td align="center" valign=middle>{{$pdata['commissioned_capacity']}} </td>
        <td align="center" valign=middle>{{$pdata['actual_commissiong_date']}}</td>
        <td align="center" valign=middle>{{$pdata['actual_commissioned_capacity']}} </td>
        <td align="center" valign=middle> <br> </td>
    </tr>
    @endif
    <?php $x++; ?>
    @endforeach
    @endif
    @if(count($tdata['bidders'])>0)
    <?php $i=0; $j=0;?>
    @foreach($tdata['bidders'] as $bidData)
    @if($i>0)
    <tr>
        <td align="center" valign=middle>{{$bidData['village_id']}}</td>
        <td align="center" valign=middle>{{$bidData['sub_district_id']}}</td>
        <td align="center" valign=middle>{{$bidData['district_id']}}</td>
        <td align="center" valign=middle>{{$bidData['lat']}} E</td>
        <td align="center" valign=middle>{{$bidData['lng']}} N</td>
        <!-- Total no of bidder projects -->
        <td rowspan="{{$bidData['bidderCount']}}" align="center" valign=middle>{{$bidData['bidder_name']}}</td>
        <td rowspan="{{$bidData['bidderCount']}}" align="center" valign=middle>{{$bidData['capacity']}}</td>
        <td rowspan="{{$bidData['bidderCount']}}" align="center" valign=middle>{{$bidData['loa_date']}}</td>
        <td align="center" valign=middle>{{$bidData['ppa_psa_date']}} </td>
        <td align="center" valign=middle>{{$bidData['ppa_psa_capacity']}} </td>
        <td align="center" valign=middle>{{$bidData['state']}} </td>
        <td align="center" valign=middle>{{$bidData['discom_name']}} </td>
        <td align="center" valign=middle>{{$bidData['electricity_per_unit_cost']}} </td>
        <td align="center" valign=middle>{{$bidData['duration_ppa']}} </td>


        <td align="center" valign=middle>{{$tdata['ppa_date']}}</td>
        <td align="center" valign=middle>{{$tdata['ppa_capacity']}} </td>
        <td align="center" valign=middle>{{$tdata['ppa_electricity_per_unit_cost']}} </td>
        <td align="center" valign=middle>{{$tdata['duration_ppa']}} </td>



        <td align="center" valign=middle>{{$bidData['schedule_commissiong_date']}} </td>
        <td align="center" valign=middle>{{$bidData['commissioned_capacity']}} </td>
        <td align="center" valign=middle>{{$bidData['actual_commissiong_date']}} </td>
        <td align="center" valign=middle>{{$bidData['actual_commissioned_capacity']}} </td>
        <td align="center" valign=middle> <br> </td>
    </tr>
    @endif
    <?php $i++; ?>
    @endforeach
    @if(count($tdata['bidders'][$j]['projects'])>0)


    @foreach($tdata['bidders'][$j]['projects'] as $projectData)
    @if($j>1)
    <tr>
        <td align="center" valign=middle>{{$projectData['village_id']}} </td>
        <td align="center" valign=middle>{{$projectData['sub_district_id']}}</td>
        <td align="center" valign=middle>{{$projectData['district_id']}}</td>
        <td align="center" valign=middle>{{$projectData['lat']}} E </td>
        <td align="center" valign=middle>{{$projectData['lng']}} N</td>
        <td align="center" valign=middle>{{$projectData['ppa_psa_date']}} </td>
        <td align="center" valign=middle>{{$projectData['ppa_psa_capacity']}} </td>
        <td align="center" valign=middle>{{$projectData['state']}}</td>
        <td align="center" valign=middle>{{$projectData['discom_name']}} </td>
        <td align="center" valign=middle>{{$projectData['electricity_per_unit_cost']}} </td>
        <td align="center" valign=middle>{{$projectData['duration_ppa']}} </td>


        <td align="center" valign=middle>{{$tdata['ppa_date']}}</td>
        <td align="center" valign=middle>{{$tdata['ppa_capacity']}} </td>
        <td align="center" valign=middle>{{$tdata['ppa_electricity_per_unit_cost']}} </td>
        <td align="center" valign=middle>{{$tdata['duration_ppa']}} </td>




        <td align="center" valign=middle>{{$projectData['schedule_commissiong_date']}} </td>
        <td align="center" valign=middle>{{$projectData['commissioned_capacity']}} </td>
        <td align="center" valign=middle>{{$projectData['actual_commissiong_date']}} </td>
        <td align="center" valign=middle>{{$projectData['actual_commissioned_capacity']}} </td>
        <td align="center" valign=middle> <br> </td>
    </tr>
    @endif
    <?php $j++; ?>
    @endforeach

    @endif




    @endif




    <!-- End of Main loop -->
    @endforeach







</table>