@extends('layouts.masters.backend')
@section('content')
<section class="section dashboard">

    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Add Tender</h1>
        </div>
        <section class="section dashboard">
            <form action="">
                @csrf
                <table class="table table-bordered">
                    <tr>
                        <th>NIT. No. <span class="text-danger">*</span></th>
                        <td><input type="text" name="nit_no" id="nit_no" class="form-control"
                                placeholder="Enter NIT No."> </td>
                        <th>Scheme Type <span class="text-danger">*</span></th>
                        <td>
                            <select name="scheme_type" id="scheme_type" class="form-control">
                                <option value="">~~~Select~~~</option>
                                <option value="State">State</option>
                                <option value="Center">Center</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th>Tender Title <span class="text-danger">*</span></th>
                        <td><input type="text" name="tender_title" id="tender_title" class="form-control"
                                placeholder="Enter Tender Title"> </td>
                        <th>Capacity(MW) <span class="text-danger">*</span></th>
                        <td><input type="number" step="any" name="capacity" id="capacity" class="form-control"
                                placeholder="Enter Capacity in MW"> </td>
                    </tr>
                    <tr>
                        <th>NIT. Date <span class="text-danger">*</span></th>
                        <td><input type="date" name="nit_date" id="nit_date" class="form-control"></td>
                        <th>RFS Date <span class="text-danger">*</span></th>
                        <td><input type="date" name="rfs_date" id="rfs_date" class="form-control"></td>
                    </tr>
                    <tr>
                        <th>Pre Bid Meeting Date <span class="text-danger">*</span></th>
                        <td><input type="date" name="pre_bid_meeting_date" id="pre_bid_meeting_date"
                                class="form-control"></td>
                        <th>Last Date of Bid Submission <span class="text-danger">*</span></th>
                        <td><input type="date" name="bid_submission_date" id="bid_submission_date" class="form-control">
                        </td>
                    </tr>
                    <tr>
                        <th>Additional Information(Optional)</th>
                        <td colspan="3">
                            <textarea name="additional_information" id="additional_information" class="form-control"
                                cols="30" rows="5"></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="4">
                            <input type="submit" name="submit" class="btn btn-success" value="Save" />
                            <input type="reset" class="btn btn-danger" value="Cancel" />
                        </td>
                    </tr>
                </table>
            </form>


        </section>
    </main>
</section>
<!-- </section> -->
@endsection