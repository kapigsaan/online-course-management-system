<?=form_open('')?>
<div class='row'>
  <div class = "col-md-12">
    <div class='panel panel-default dialog-panel'>
      <div class='panel-heading'>
        <div class="row">
          <div class="col-md-2"></div>
          <div class="col-md-3">
            <?php if ($prof): ?>
                  <?php if (!$prof->website == ""):?>
                    <img src="<?php echo site_url($prof->website); ?>" style = "height:150px" alt="Jnz@yui.rin"/>
                  <?else:?>
                     <img src="<?=site_url('logo.jpg')?>" style = "height:150px">
                  <?php endif ?>
              <?php else:?>
                   <img src="<?=site_url('logo.jpg')?>" style = "height:150px">
              <?php endif ?>  
          </div>
          <div class="col-md-5"><center><h1>STUDENT REGISTRATION</h1></center></div>
        </div>
        <p></p>
        <?php echo validation_errors('<div class = "alert alert-danger">')?>
      </div>
      <div class='panel-body'>
        <?php if($system_message): ?>
          <div class="row">
            <div class="alert"><?=$system_message;?></div>
          </div>
        <?php endif; ?> 
        <form class='form-horizontal' role='form'>

          <fieldset class="scheduler-border">
            <legend class="scheduler-border"></legend>   
            <p></p>
            <div class="row">
              <div class="col-md-12">
                <p>*Note Username will be used as password and can be change later</p>
              </div>
              <div class="col-md-2 mylabel">Username *</div>
              <div class="col-md-5 mylabel">
                <input type = "text" class = "form-control" name = "username" placeholder = "Username & Password" required/>
              </div>
            </div>
            <p></p>
            <div class="row">
              <div class="col-md-2 mylabel">Full Name *</div>
              <div class="col-md-3 mylabel"><input placeHolder="Last Name" label="Last Name" class="not_blank form-control" id="lastname" name="lname" maxlength="100" title="Last Name" type="text"  value='' required/></div>
              <div class="col-md-3 mylabel"> <input placeHolder="First Name" label="First Name" class="not_blank form-control" id="fname" name="fname" maxlength="100" title="First Name" type="text" value='' required/></div>
              <div class="col-md-3 mylabel"> <input placeHolder="Middle Name" label="Middle Name" class="not_blank form-control" id="middlename" name="mname" maxlength="100" title="Middle Name" type="text" value='' required/></div>
              <!-- <div class="col-md-1 mylabel"> <input placeHolder="Ext. (Jr)" id="name_ext" class = "form-control" name="name_ext" maxlength="15" title="Name Extention (Jr)" type="text" value='' /></div> -->
            </div>
            <p></p>

           <!--  <div class="row">
              <div class="col-md-2 mylabel">Residential Address *</div>
              <div class="col-md-2 mylabel"><input placeHolder="Street No. / House No." id="user_enrollment_attributes_street_no" name="res_street_no" label="Street No. / House No." class='not_blank form-control' size="10" type="text" value='' /></div>
              <div class="col-md-2 mylabel"><input placeHolder="Barangay" id="user_enrollment_attributes_street_no" name="res_barangay" label="Barangay" class='not_blank form-control' size="10" type="text" value='' /></div>
              <div class="col-md-2 mylabel"><input placeHolder="City/Municipality" label="City/Municipality" class="not_blank form-control" name="res_municipal" value='' size="30" type="text" /></div>
              <div class="col-md-2 mylabel"><input placeHolder="Province" label="Province" class="not_blank form-control" name="res_province" value='' size="30" type="text" /></div>
              <div class="col-md-2 mylabel"><input placeHolder="Zip" label="Zip" class="not_blank form-control" name="res_zip" value='' type="text" /></div>
            </div>
            <p></p> -->

            <!-- <div class="row">
              <div class="col-md-2 mylabel">Permanent Address *</div>
              <div class="col-md-2 mylabel"><input placeHolder="Street No. / House No." id="user_enrollment_attributes_street_no" name="street_no" label="Street No. / House No." class='not_blank form-control' size="10" type="text" value='' /></div>
              <div class="col-md-2 mylabel"><input placeHolder="Barangay" id="user_enrollment_attributes_street_no" name="barangay" label="Barangay" class='not_blank form-control' size="10" type="text" value='' /></div>
              <div class="col-md-2 mylabel"><input placeHolder="City/Municipality" label="City/Municipality" class="not_blank form-control" name="municipal" value='' size="30" type="text" /></div>
              <div class="col-md-2 mylabel"><input placeHolder="Province" label="Province" class="not_blank form-control" name="province" value='' size="30" type="text" /></div>
              <div class="col-md-2 mylabel"><input placeHolder="Zip" label="Zip" class="not_blank form-control" name="zip" value='' type="text" /></div>
            </div>
            <p></p> -->
            
            <!-- <div class="row">
              <div class="col-md-2 mylabel">Date of Birth *</div>
                <div class="col-md-3 mylabel">
                  <input placeHolder="MM/DD/YYYY" label="Birth Date" class='datepicker not_blank form-control' id="birthdate" name="date_of_birth" size="10" type="text" value='' autocomplete="Off" required/>
                </div>
              <div class="col-md-2 mylabel">Place of Birth *</div>
              <div class="col-md-3 mylabel"> <input placeHolder="Place of Birth" label="Place of Birth" class="not_blank form-control" id="birthplace" name="place_of_birth" size="20" type="text" value='' /></div>
              <div class="col-md-1 mylabel">Sex *</div>
              <div class="col-md-3">
                <select name="sex" label="Gender" class="not_blank form-control" required>
                  <option value="Male">Male</option>
                  <option value="Female">Female</option>
                </select>
              </div>
            </div>
            <p></p> -->

           <!--  <div class="row">
              <div class="col-md-2 mylabel">Civil Status *</div>
              <div class="col-md-2">
                <select name="civil_status" class="form-control" label="Civil Status" class="">
                  <option value="" selected="selected">Select Civil Status</option>
                  <option value="Single">Single</option>
                  <option value="Married">Married</option>
                  <option value="Widowed">Widowed</option>
                  <option value="Separated">Separated</option>
                  <option value="Annuled">Annuled</option>
                  <option value="others">Others</option>
                </select>
              </div>
              <div class="col-md-3 mylabel"><input placeHolder="Others" label="Others" class="not_blank form-control" id="others" name="others" type="text" value='' readonly="true" /></div>
              <div class="col-md-2 mylabel">Citizenship *</div>
              <div class="col-md-2 mylabel"><input placeHolder="Citizenship" label="Citizenship" class="not_blank form-control" id="citizenship" name="citizenship" size="20" type="text" value='' /></div>
            </div>
            <p></p>

            <div class="row">
              <div class="col-md-2 mylabel">Telephone Number</div>
              <div class="col-md-2 mylabel"><input placeHolder="Tel. No" label="Telephone No." class="not_blank form-control" id="telephone" name="telephone" size="20" type="text" value='' /></div>
              <div class="col-md-2 mylabel">Cellphone Number</div>
              <div class="col-md-2 mylabel"><input placeHolder="Cp. No" label="Cellphone No." class="not_blank form-control" id="cellphone" name="cellphone" size="20" type="text" value='' /></div>
              <div class="col-md-1 mylabel">Email</div>
              <div class="col-md-3 mylabel">
                <input label="Email Address" class="form-control form-control" id="fake_email" name="fake_email" size="10" type="email" value='' />         <p><small>(If none:use none@gmail.com)</small></p>
              </div>
            </div>
            <p></p>

            <div class="row">
              <div class="col-md-2 mylabel">Height (m)</div>
              <div class="col-md-2 mylabel">
                <input placeHolder="Height" label="Height" class="not_blank form-control" id="height" name="height" size="4" maxlength="4" type="text" value='' />
              </div>
              <div class="col-md-2 mylabel">Weight (kg)</div>
              <div class="col-md-2 mylabel"> <input placeHolder="Weight" label="Weight" class="not_blank form-control" id="weight" name="weight" size="3" maxlength="3" type="text" value='' /></div>
              <div class="col-md-2 mylabel">Blood Type</div>
              <div class="col-md-2 mylabel"> <input placeHolder="Blood Type" label="BloodType" class="not_blank form-control" id="bloodtype" name="bloodtype" size="3" maxlength="3" type="text" value='' /></div>
            </div>
            <p></p>

            <div class="row">
              <div class="col-md-2 mylabel">GSIS ID No.</div>
              <div class="col-md-2 mylabel"> <input placeHolder="GSIS" label="GSIS" class="not_blank form-control" id="gsis" name="gsis" type="text" value='' /></div>
              <div class="col-md-2 mylabel">Pag-ibig ID No.</div>
              <div class="col-md-2 mylabel"> <input placeHolder="Pag-ibig" label="Pag-ibig" class="not_blank form-control" id="Pagibig" name="Pagibig" type="text" value='' /></div>
              <div class="col-md-2 mylabel">Philhealth No.</div>
              <div class="col-md-2 mylabel"> <input placeHolder="Philhealth" label="Philhealth" class="not_blank form-control" id="philhealth" name="philhealth" type="text" value='' /></div>
            </div>
            <p></p>

            <div class="row">
              <div class="col-md-2 mylabel">SSS No.</div>
              <div class="col-md-2 mylabel"> <input placeHolder="SSS No" label="sss" class="not_blank form-control" id="sss" name="sss" type="text" value='' /></div>
              <div class="col-md-2 mylabel">TIN No.</div>
              <div class="col-md-2 mylabel"> <input placeHolder="TIN" label="TIN" class="not_blank form-control" id="tin" name="tin" type="text" value='' /></div>
            </div>
            <hr>

            <div class="row">
              <div class="col-md-3 sp_label">--Current Employment--</div>
            </div>
            <div class="row">
              <div class="col-md-2 mylabel">Position/Designation</div>
              <div class="col-md-2 mylabel"> <input placeHolder="Position/Designation" label="Position/Designation" class="not_blank form-control" id="position" name="position" type="text" value='' /></div>
              <div class="col-md-1 mylabel">School/District</div>
              <div class="col-md-3 mylabel"> <input placeHolder="School/District" label="School/District" class="not_blank form-control" id="school" name="school" type="text" value='' /></div>
              <div class="col-md-2 mylabel">Date of Employment</div>
              <div class="col-md-2 mylabel"><input placeHolder="Employment Date" label="Employment Date" class='datepicker not_blank form-control' id="date_of_emp" name="date_of_emp" size="10" type="text" value='' autocomplete="Off" /></div>
            </div>
 -->
          </fieldset>

         <!--  <fieldset class="scheduler-border">
            <legend class="scheduler-border">Family Background</legend>    
            <p></p>

            <div class="row">
              <div class="col-md-2 mylabel">Spouse's Surname</div>
              <div class="col-md-3 mylabel"><input placeHolder="Last Name" label="Last Name" class="not_blank form-control" id="sp_lname" name="sp_lname" maxlength="100" title="Last Name" type="text"  value='' /></div>
              <div class="col-md-3 mylabel"> <input placeHolder="First Name" label="First Name" class="not_blank form-control" id="sp_fname" name="sp_fname" maxlength="100" title="First Name" type="text" value='' /></div>
              <div class="col-md-3 mylabel"> <input placeHolder="Middle Name" label="Middle Name" class="not_blank form-control" id="sp_mname" name="sp_mname" maxlength="100" title="Middle Name" type="text" value='' /></div>
            </div>
            <p></p>

            <div class="row">
              <div class="col-md-2 mylabel">Occupation</div>
              <div class="col-md-2 mylabel"> <input placeHolder="Occupation" label="Occupation" class="not_blank form-control" id="occupation" name="occupation" type="text" value='' /></div>
              <div class="col-md-2 mylabel">Number of Children</div>
              <div class="col-md-2 mylabel"> <input placeHolder="CHN" label="Number of Children" class="not_blank form-control" id="num_of_children" name="num_of_children" size="3" maxlength="3" type="text" value='' /></div>
            </div>
            <p></p>

            <div class="row">
              <div class="col-md-2 mylabel">Employer/Bus. Name</div>
              <div class="col-md-4 mylabel"> <input placeHolder="Employer/Business Name" label="Employer/Business Name" class="not_blank form-control" id="bus_name" name="bus_name" type="text" value='' /></div>
              <div class="col-md-2 mylabel">Telephone Number</div>
              <div class="col-md-2 mylabel"><input placeHolder="Tel. No" label="Telephone No." class="not_blank form-control" id="bus_telephone" name="bus_telephone" size="20" type="text" value='' /></div>
            </div>
            <p></p>

            <div class="row">
              <div class="col-md-2 mylabel">Business Address</div>
              <div class="col-md-2 mylabel"><input placeHolder="Street No. / House No." id="user_enrollment_attributes_street_no" name="bus_street_no" label="Street No. / House No." class='not_blank form-control' size="10" type="text" value='' /></div>
              <div class="col-md-2 mylabel"><input placeHolder="Barangay" id="user_enrollment_attributes_street_no" name="bus_barangay" label="Barangay" class='not_blank form-control' size="10" type="text" value='' /></div>
              <div class="col-md-2 mylabel"><input placeHolder="City/Municipality" label="City/Municipality" class="not_blank form-control" name="bus_municipal" value='' size="30" type="text" /></div>
              <div class="col-md-2 mylabel"><input placeHolder="Province" label="Province" class="not_blank form-control" name="bus_province" value='' size="30" type="text" /></div>
              <div class="col-md-2 mylabel"><input placeHolder="Zip" label="Zip" class="not_blank form-control" name="bus_zip" value='' type="text" /></div>
            </div>
            <p></p>

          </fieldset>

          <fieldset class="scheduler-border">
            <legend class="scheduler-border">Highest Educational Attainment</legend>    
            <p></p>

            <div class="row table-responsive">
              <table class="table table-bordered wpad" style="overflow:true;">
                <thead class="gray-head">
                  <tr>
                    <td class="text-center" style="width:150px;">Level</td>
                    <td class="text-center">Name of School<p><small>(Write in Full)</small></p></td>
                    <td class="text-center">Degree Course<p><small>(Write in Full)</small></p></td>
                    <td class="text-center">Year Graduated<p><small>(If graduated)</small></p></td></td>
                    <td class="text-center">Highest Grade/Level/Units Earned<p><small>(If not graduated)</small></p></td>
                    <td class="text-center">Scholarship/Academic Honors Received</td>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td rowspan="2">College</td>
                    <td><input type = "text" name = "col_school_name" class = "form-control"/></td>
                    <td><input type = "text" name = "col_degree" class = "form-control"/></td>
                    <td><input type = "text" name = "col_year_grad" class = "form-control"/></td>
                    <td><input type = "text" name = "col_highest" class = "form-control"/></td>
                    <td><input type = "text" name = "col_honor" class = "form-control"/></td>
                  </tr>
                  <tr>
                    <td><input type = "text" name = "col_school_name2" class = "form-control"/></td>
                    <td><input type = "text" name = "col_degree2" class = "form-control"/></td>
                    <td><input type = "text" name = "col_year_grad2" class = "form-control"/></td>
                    <td><input type = "text" name = "col_highest2" class = "form-control"/></td>
                    <td><input type = "text" name = "col_honor2" class = "form-control"/></td>
                  </tr>
                  <tr>
                    <td rowspan="2">Graduate Studies</td>
                    <td><input type = "text" name = "grad_school_name" class = "form-control"/></td>
                    <td><input type = "text" name = "grad_degree" class = "form-control"/></td>
                    <td><input type = "text" name = "grad_year_grad" class = "form-control"/></td>
                    <td><input type = "text" name = "grad_highest" class = "form-control"/></td>
                    <td><input type = "text" name = "grad_honor" class = "form-control"/></td>
                  </tr>
                  <tr>
                    <td><input type = "text" name = "grad_school_name2" class = "form-control"/></td>
                    <td><input type = "text" name = "grad_degree2" class = "form-control"/></td>
                    <td><input type = "text" name = "grad_year_grad2" class = "form-control"/></td>
                    <td><input type = "text" name = "grad_highest2" class = "form-control"/></td>
                    <td><input type = "text" name = "grad_honor2" class = "form-control"/></td>
                  </tr>
                </tbody>
              </table>
            </div>
            <p></p>

          </fieldset>

          <fieldset class="scheduler-border">
            <legend class="scheduler-border">Civil Service Eligibility</legend>    
            <p></p>

            <div class="row table-responsive">
              <table class="table table-bordered wpad" style="overflow:true;">
                <thead class="gray-head">
                  <tr>
                    <td class="text-center" rowspan="2" style="width:350px;">Career Service/RA 1080 (Board/Bar) Under Special Laws/CES/CSEE</td>
                    <td class="text-center" rowspan="2">Rating</td>
                    <td class="text-center" rowspan="2">Date of Examination/Conferment</td>
                    <td class="text-center" rowspan="2">Place of Examination/Conferment</td>
                    <td class="text-center" rowspan="1" colspan="2" >License <small>(if Applicable)</small> </td>
                  </tr>
                  <tr>
                    <td class="text-center">Number</td>
                    <td class="text-center">Date of Release</td>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td><input type = "text" name = "career_service" class = "form-control"/></td>
                    <td><input type = "text" name = "rating" class = "form-control"/></td>
                    <td><input type = "text" name = "date_exam" class = "datepicker form-control"/></td>
                    <td><input type = "text" name = "place_exam" class = "form-control"/></td>
                    <td><input type = "text" name = "license_num" class = "form-control"/></td>
                    <td><input type = "text" name = "license_release" class = "datepicker form-control"/></td>
                  </tr>
                  <tr>
                    <td><input type = "text" name = "career_service"2 class = "form-control"/></td>
                    <td><input type = "text" name = "rating2" class = "form-control"/></td>
                    <td><input type = "text" name = "date_exam2" class = "datepicker form-control"/></td>
                    <td><input type = "text" name = "place_exam2" class = "form-control"/></td>
                    <td><input type = "text" name = "license_num2" class = "form-control"/></td>
                    <td><input type = "text" name = "license_release2" class = "datepicker form-control"/></td>
                  </tr>
                  <tr>
                    <td><input type = "text" name = "career_service3" class = "form-control"/></td>
                    <td><input type = "text" name = "rating3" class = "form-control"/></td>
                    <td><input type = "text" name = "date_exam3" class = "datepicker form-control"/></td>
                    <td><input type = "text" name = "place_exam3" class = "form-control"/></td>
                    <td><input type = "text" name = "license_num3" class = "form-control"/></td>
                    <td><input type = "text" name = "license_release3" class = "datepicker form-control"/></td>
                  </tr>
                </tbody>
              </table>
            </div>
            <p></p>

          </fieldset>

          <fieldset class="scheduler-border">
            <legend class="scheduler-border">Training Programs (Start from the most recent training)</legend>    
            <p></p>

            <div class="row table-responsive">
              <table class="table table-bordered wpad" style="overflow:true;">
                <thead class="gray-head">
                  <tr>
                    <td class="text-center" rowspan="1" style="width:350px;">Title of Seminar/Conference/Workshop/Short Courses(<small>Write in full</small>):</td>
                    <td class="text-center" rowspan="1" colspan="2" >Inclusive Dates of Attendance <small>(mm/dd/yyyy)</small> </td>
                    <td class="text-center" rowspan="2">Number of Hours</td>
                    <td class="text-center" rowspan="2">Conducted/Sponsored By <small>(Write in Full)</small></td>
                  </tr>
                  <tr>
                    <td><small>Note: For the past 5 years, Enumerate 3 Major Trainings</small></td>
                    <td class="text-center">From</td>
                    <td class="text-center">To</td>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td><input type = "text" name = "training_title" class = "form-control"/></td>
                    <td><input type = "text" name = "training_date_from" class = "datepicker form-control"/></td>
                    <td><input type = "text" name = "training_date_to" class = "datepicker form-control"/></td>
                    <td><input type = "text" name = "training_hours" class = "form-control"/></td>
                    <td><input type = "text" name = "training_by" class = "form-control"/></td>
                  </tr>
                  <tr>
                    <td><input type = "text" name = "training_title2" class = "form-control"/></td>
                    <td><input type = "text" name = "training_date_from2" class = "datepicker form-control"/></td>
                    <td><input type = "text" name = "training_date_to2" class = "datepicker form-control"/></td>
                    <td><input type = "text" name = "training_hours2" class = "form-control"/></td>
                    <td><input type = "text" name = "training_by2" class = "form-control"/></td>
                  </tr>
                  <tr>
                    <td><input type = "text" name = "training_title3" class = "form-control"/></td>
                    <td><input type = "text" name = "training_date_from3" class = "datepicker form-control"/></td>
                    <td><input type = "text" name = "training_date_to3" class = "datepicker form-control"/></td>
                    <td><input type = "text" name = "training_hours3" class = "form-control"/></td>
                    <td><input type = "text" name = "training_by3" class = "form-control"/></td>
                  </tr>
                </tbody>
              </table>
            </div>
             -->
          <p></p>

          </fieldset>
          <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8 text-center">
              <input type="submit" class = "btn btn-primary btn-block" name = "Submit" value = "Submit"/>
            </div>
            <div class="col-md-2"></div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<?=form_close()?>