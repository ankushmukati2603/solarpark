<tr class="bg-primary text-light">
    <th>S.No</th>
    <th>Report Type</th>
    <th>Agency</th>
    <th>State</th>
    <th>District</th>
    <th>Contact Person Name</th>
    <th>Email ID</th>
    <th>Mobile Number</th>
    <!-- <th>Approved Capacity (in MW)</th> -->
    <th>Submitted On</th>
    <th>Status</th>
    <th>Remarks by MNRE</th>
    <th>Action</th>
</tr>

@php $generalData='' @endphp
@foreach($tenderDetails as $progressData)
@php $generalData=json_decode($progressData['general']); @endphp
<tr>
    <td>{{$loop->iteration}}</td>
    <td>
        @if($progressData['report_type']==1)
        Tender
        @elseif($progressData['report_type']==2)
        Under Implementation
        @else
        @if($progressData['report_sub_type']=='new_report')
        Commissioning (New Report)
        @else
        Commissioning (Rooftop Report)
        @endif
        @endif
    </td>
    <td> @if($progressData['report_type']==1)

        {{ $progressData['agency_name']}}
        @else
        --
        @endif</td>
    <td>{{ $progressData['state_name'] ?? 'NA' }}</td>
    <td>{{ $progressData['district_name'] ?? 'NA' }}</td>
    <td>{{ $generalData->contact_person_name ?? '--' }}</td>
    <td>{{ $generalData->email ?? ''}}</td>
    <td>{{ $generalData->mobile_number ?? '' }}</td>
    <td>{{ $progressData['final_submission'] ==1 ? $progressData['submitted_on'] : 'Not Submitted' }}</td>
    <td> @if($progressData['final_submission'] == '1')
        <span>Submitted</span>
        @else
        <span>Draft</span>
        @endif
    </td>
    <td></td>
    <td>
        @if($progressData['final_submission']==0)

        <a href="{{URL::to(Auth::getDefaultDriver().'/'.$progressData['redirect_url'].'/'.$progressData['id'])}}"
            class="btn btn-primary"><i class="fa fa-pencil"></i></a>

        @else
        <a href="{{URL::to(Auth::getDefaultDriver().'/preview-progress-report/'.$progressData['id'])}}"
            class="btn btn-primary"><i class="fa fa-eye"></i></a>

        @endif
    </td>
</tr>
@endforeach