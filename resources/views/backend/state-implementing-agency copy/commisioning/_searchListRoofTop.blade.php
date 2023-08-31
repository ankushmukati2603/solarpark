<tr class="bg-primary text-light">
    <th>S.No</th>
    <th>Year</th>
    <th>Ground Mounted Capacity (MW)</th>
    <th>Consumer Capacity (MW)</th>
    <th>Finance Commission Capacity (MW)</th>
    <th>IPDS Capacity (MW)</th>
    <th>Surya Raltha Capacity (MW)</th>
    <th>Submitted On</th>
    <th>Status</th>
    <th>Remarks by MNRE</th>
    <th>Action</th>
</tr>
@foreach($tenderDetails as $progressData)
<tr>
    <td>{{$loop->iteration}}</td>
    <td>Commissioning (Rooftop Report)</td>
    <td>{{ $progressData['rooftopdata']->gm_capacity ?? 'NA' }}</td>
    <td>{{ $progressData['rooftopdata']->cunsumer_capacity ?? 'NA' }}</td>
    <td>{{ $progressData['rooftopdata']->fc_capacity ?? '--' }}</td>
    <td>{{ $progressData['rooftopdata']->ipds_capacity ?? ''}}</td>
    <td>{{ $progressData['rooftopdata']->sr_capacity ?? '' }}</td>
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