<div id="home" class=" tab-pane active">
    <h5> <label class="headLebels">Status of Release of CFA</label></h5><br>
    <div style="float: right;"><input type="checkbox" class="checkoption" value="general"
            onchange="getLastMonthReportData('status_of_release_of_cfa','<?php echo e($generalData["month"]); ?>','<?php echo e($generalData["year"]); ?>','<?php echo e($generalData["id"]); ?>')">
        Same
        as Previous Month
        <br>
    </div>
    <!-- 
    <div id="home" class=" tab-pane active">
        <div>
            <div class="clearfix"></div><br>
            <div class="col-md-12 col-sm-12">
                <div class="input-group date"> -->
    <table class="table table-bordered">

        <tr>
            <th>S.NO.</th>
            <th>Milestone</th>
            <th>% of Subsidy Disbursed</th>
            <th>Amount</th>
            <th>Due Date</th>
            <th>Release Date</th>
        </tr>
        <tr>
            <td></td>
            <td>Total Eligible CFA</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td>1</td>
            <td>Land Acquisition (Not less than 50% land acquired)</td>
            <td>20%</td>
            <td class="row-index text-center"> <input type="number" min="0" name="land_acquisition_amount"
                    class="form-control"
                    value="<?php echo e($generalData['status_of_release_of_cfa']['land_acquisition_amount'] ?? ''); ?>">
            </td>
            <td><input type="date" name="land_acquisition_due_date" class="form-control"
                    value="<?php echo e($generalData['status_of_release_of_cfa']['land_acquisition_due_date'] ?? ''); ?>"></td>
            <td><input type="date" name="land_acquisition_release_date" class="form-control"
                    value="<?php echo e($generalData['status_of_release_of_cfa']['land_acquisition_release_date'] ?? ''); ?>"></td>
        </tr>
        <tr>
            <td>2</td>
            <td>Financial Closure</td>
            <td>20%</td>
            <td> <input type="number" min="0" name="financial_closure_amount" class="form-control"
                    value="<?php echo e($generalData['status_of_release_of_cfa']['financial_closure_amount'] ?? ''); ?>"></td>
            <td><input type="date" name="financial_closure_due_date" class="form-control"
                    value="<?php echo e($generalData['status_of_release_of_cfa']['financial_closure_due_date'] ?? ''); ?>"></td>
            <td><input type="date" name="financial_closure_release_date" class="form-control"
                    value="<?php echo e($generalData['status_of_release_of_cfa']['financial_closure_release_date'] ?? ''); ?>"></td>
        </tr>
        <tr>
            <td>3</td>
            <td>Award of Work for Pooling Stations</td>
            <td>20%</td>
            <td><input type="number" min="0" name="aw_pooling_station_amount" class="form-control"
                    value="<?php echo e($generalData['status_of_release_of_cfa']['aw_pooling_station_amount'] ?? ''); ?>"></td>
            <td><input type="date" name="aw_pooling_station_due_date" class="form-control"
                    value="<?php echo e($generalData['status_of_release_of_cfa']['aw_pooling_station_due_date'] ?? ''); ?>"></td>
            <td><input type="date" name="aw_pooling_station_release_date" class="form-control"
                    value="<?php echo e($generalData['status_of_release_of_cfa']['aw_pooling_station_release_date'] ?? ''); ?>"></td>
        </tr>
        <tr>
            <td>4</td>
            <td>Receipt of Material on Site for Pooling Stations</td>
            <td>25%</td>
            <td><input type="number" min="0" name="receipt_material_site_amount" class="form-control"
                    value="<?php echo e($generalData['status_of_release_of_cfa']['receipt_material_site_amount'] ?? ''); ?>"></td>
            <td><input type="date" name="receipt_material_site_due_date" class="form-control"
                    value="<?php echo e($generalData['status_of_release_of_cfa']['receipt_material_site_due_date'] ?? ''); ?>"></td>
            <td><input type="date" name="receipt_material_site_release_date" class="form-control"
                    value="<?php echo e($generalData['status_of_release_of_cfa']['receipt_material_site_release_date'] ?? ''); ?>">
            </td>

        </tr>
        <tr>
            <td>5</td>
            <td>Completion of Construction of Pooling Stations & Land Development</td>
            <td>15%</td>
            <td><input type="number" min="0" name="completion_construction_amount" class="form-control"
                    value="<?php echo e($generalData['status_of_release_of_cfa']['completion_construction_amount'] ?? ''); ?>"></td>
            <td><input type="date" name="completion_construction_due_date" class="form-control"
                    value="<?php echo e($generalData['status_of_release_of_cfa']['completion_construction_due_date'] ?? ''); ?>"></td>
            <td><input type="date" name="completion_construction_release_date" class="form-control"
                    value="<?php echo e($generalData['status_of_release_of_cfa']['completion_construction_release_date'] ?? ''); ?>">
            </td>
        </tr>
        <tr>
            <td colspan="2">Total</td>
            <td>100%</td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
    </table>
    <!-- </div>
                <span class="text-danger"><?php echo e($errors->first('loi_loa_date')); ?></span>
            </div>
        </div>

    </div> -->
</div><?php /**PATH D:\xampp\htdocs\solar_park\resources\views/backend/beneficiary/progress_report/status_of_release_of_cfa.blade.php ENDPATH**/ ?>