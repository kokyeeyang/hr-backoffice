<!-- <script type="text/javascript" src="tinymce/TinyMCEe.min.js"></script> -->
<style>
	input[type='checkbox'] {
		width: 20px;
	} 

	div #offer-letter-input {
		height: 80px;
		margin-bottom: 30px;
	}

</style>

<script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
<script>
 tinymce.init({
   selector: 'textarea#editor',  //Change this value according to your HTML
   auto_focus: 'element1',
   width: "400",
   height: "100"
 }); 
 
 </script>
<div class="breadcrumb">
  <div class="breadcrumb_wrapper">
    <div class="breadcrumb-top"><?php echo Yii::t('app', 'Add New Offer Letter Template'); ?></div>
    <div class="breadcrumb-bottom breadcrumb-bottom-people">
      <div class="title">
        <span><?php echo Yii::t('app', 'Add a new offer letter template'); ?></span>
      </div>
    </div>
  </div>
</div>
<div class="common_content_wrapper admin_login_log_list">
  <div class="common_content_inner_wrapper">
    <h4 class="widget_title"><?php echo Yii::t('app', 'Add a new offer letter template'); ?>
    </h4>
    <form method="post" enctype="multipart/form-data" id="createOfferLetterForm" name="createOfferLetterForm" action="<?php echo $this->createUrl('registration/saveOfferLetterTemplate') ?>">
    	<div id="offer-letter-input" style="margin-bottom:10px; margin-top: 10px;">
    		<tr>
		    	<td><?php echo Yii::t('app', 'Offer Letter Title'); ?> </td>
	  			<td>:</td>
	  			<td>
	  				<input type="text" name="offerLetterTitle"/>
	  			</td>
	  			<td><?php echo Yii::t('app', 'Description'); ?> </td>
	  			<td>:</td>
	  			<td>
	  				<textarea name="offerLetterDescription"/ rows="3"></textarea>
	  			</td>
	  		</tr>
  		</div>
    	<table style="line-height: 32px;padding-left: 10px;font-size: 15px; margin-bottom:10px;">
    		<textarea id="offer-letter-template" name="offer-letter-template">
				  <p style="text-align: left; margin:40px;">
				    <img src="/images/alllanguages/sagaos_logo.png">
				  </p>
					<p style="text-align: left; margin:40px;">
						<b>PRIVATE & CONFIDENTIAL</b>
						<br/><br/>
						<?php echo $dateToday; ?>
						<br/><br/>
						IC No: %%Candidate ID%%
						<br/><br/>
						Address: %%Candidate Address%%
						<br/><br/>
						LETTER OF APPOINTMENT - %%Candidate position%%
						<br/>
					</p>
					<p style="margin:40px;">
						We are pleased to offer you employment as %%Candidate position%% with SAGAOS SDN. BHD. (herein after referred to as "the Company") with effect from <?php echo $dateToday; ?>.
						<br/><br/>
						The Company reserves the right to introduce, modify, amend or annul any terms and conditions at any time during its operations. Any such changes shall be notified by issuance of circulars, memorandums or other instructions by whatever means from time to time, will form part of the terms and conditions of employment.
						<br/><br/>
						You will be reporting to %%Candidate's superior%%.
						<br/><br/>  

						The terms and conditions of your appointment are as follows:
						<div style="padding-left:60px;"><b> 1)Commencement </b></div>
						The date of commencement is provisionally set as the %%Candidate's start date%%.
						<br/><br/>
						Your official working hours shall not exceed (48) forty-eight hours per calendar week until and unless consent is given by Employee to work additional hours. 
						<br/><br/>
						You will initially be employed for a probation (qualifying) period of 3 months. This period is agreed as reasonable having regard to the nature and circumstances of your employment. After successful completion of the Probationary Period, the Company shall confirm to the Employee in writing about such successful completion of the Probationary Period. The said probationary period may be reduced or extended at the discretion of the Company.
						<br/><br/>
						<div style="padding-left:60px;"><b> 2)Remuneration </b></div>
						You shall receive a starting probationary salary, which upon successful completion of the probationary period, will increase to a fixed monthly salary on the following month as highlighted below:
						<div style="padding-left:60px;">
							- Probationary period - %%Candidate probationary salary %% MYR <br/>
							- Once probation done - %%Candidate regular salary %% MYR 
						</div>
						<br/><br/>
						In addition to your base salary, you will be eligible to receive a shift allowance amounting RM500.00 of your base salary.  Any allowance paid will be at the discretion of the company. The company reserves the right to amend or withdraw the allowance, at its absolute discretion.
						<br/><br/>
						The Company will conduct a salary review annually on, before or within a reasonable time (not to exceed twenty-five (25) days) after completion of 1 year of service and subsequent annual anniversary thereafter.
						<div style="padding-left:60px;"><b> 3)Annual bonus </b></div>
						A bonus up to 20% of your annual salary (pro-rata from time of appointment with a minimum of 6 months of employment) will be based on both the overall company performance and your own performance (KPIs, development, application to the position) and will be at the sole discretion of the Company. As appropriate, this will be paid at the end of Q1 each year. Employee will not be entitled to be considered for a bonus if he/she has left the employment of the Company or is serving out any notice given by him/her or by the Company to terminate his/her employment at the date when any bonuses are in fact paid. The Company may at any time withdraw or modify the bonus scheme.
						<br/><br/>
						<div style="padding-left:60px;"><b> 4)Incentives </b></div>
						In additional to annual base salary, you shall be eligible to receive a quarterly incentive bonus based on achievement of personal and / or team KPIs/goals during each quarterly review period (which shall commence on the first day of each quarter and conclude on the last day of each quarter). In the event the Company determines that the KPIs/goals set for any quarterly review period have been achieved, you shall be entitled to receive a targeted incentive with the amount of such bonus to be determined in the discretion of Company.
						<div style="padding-left:60px;"><b> 5)Benefits </b></div>
						<br/><br/>
						As a full-time employee of the Company, you are eligible in the Company's employee benefits program;
						<br/><br/>
						*	As part of your package, a transport allowance of MYR100.00 will be provided on a monthly basis.
						<br/>
						*	Gym or fitness allowance - company shall subsidise 50% of the cost *subject to company's terms and condition.
						<br/><br/>
						<div style="padding-left:60px;"><b> 6)Performance of Duties  </b></div>
						You shall endeavour your duties in the utmost ability and with due care, skill and judgement in accordance with the highest professional standards to the satisfaction of the Company.
						<br/><br/>
						You shall be responsible to carry out all the work assigned to you promptly and discharge it to the satisfaction of the Company in accordance with the policies and directives.
						<br/><br/>
						We shall hold you personally responsible for any loss of funds and other negotiable instruments that may be in your possession due to negligence. You shall be responsible for the safe-custody of all the office assets entrusted to you and upon your leaving, by your resignation or otherwise, you shall deliver the complete set of assets entrusted to you, to your line manager. 
						<br/><br/>
						The roles and responsibilities within the position as Online Customer Service agent are as listed within the job description. Because of the changing nature of the Company's business, in addition to and/or instead of your initial duties, the Company may reasonably require you from time to time or permanently to undertake other work within your capacity. 
						<div style="padding-left:60px;"><b> 7)Annual Leave   </b></div>
						a) You are entitled to annual leave of sixteen (16) working days in twelve months. <br/>
						b) Only confirmed employees are entitled to annual leave in proportion to the number of completed months of service. Annual leave must be applied in advance and the Company reserves the right to disapprove any application of annual leave. <br/>
						c) Unutilized annual leave up to maximum of 6 days as at December 31 of each year may be carried forward to the first quarter, i.e. March 31 of the next calendar year. All unutilized annual leave exceeding 6 days will be forfeited without any compensation or payment in lieu of the unutilized annual leave. <br/>
						<div style="padding-left:60px;"><b> 8)Public Holidays </b></div>
						The Company agrees to grant 16 paid public holidays declared by the Federal Government and of the State in which you are being employed which will be added into the Employee's Annual Leave entitlement. Any sudden declared official public holiday shall be granted as additional and will be added to your Leave in Lieu allowance. 
						<div style="padding-left:60px;"><b> 9)Compassionate/Emergency/Marriage Leave  </b></div>
						You shall be entitled to a maximum of fourteen (14) days of medical leave in each calendar year provided your sickness is certified by a practitioner recognized by the Company and a certificate presented within 7 days. Any subsequent medical leave shall be regarded as unpaid leave. 
						<div style="padding-left:60px;"><b> 10)Compassionate/Emergency/Marriage Leave </b></div>
						The Company agrees to grant paid leave on compassionate/emergency/marriage/paternity grounds to you in any one calendar year:
						<br/><br/>
						a) Death of your legal child, wife, parents - 3 days of compassionate leave <br/>
						b) Birth of child - 5 days of paternity leave
						<div style="padding-left:60px;"><b> 11)Medical Benefits  </b></div>
						Medical insurance (in-patient only) shall be provided by the Company via the Company's nominated insurer for doctors/medical practitioners recognised by the Company. The Company reserves the right to reject your medical bill if found to be false.
						<br/><br/>
					  Non hospitalisation (out-patient) medical bills can be claimed as expenses, to cover doctor consultations and any subsequently prescribed medication up to a capped amount of MYR300 per month and limited to MYR2,000 within any 12 month period. 
					  <br/><br/>
					  The Company shall not pay for medical or surgical or other appliances, dentures, spectacles, lenses and optician's fees, any expenses in respect of miscarriage, any expenses arising out of self-inflicted injury or illness or disease caused by misconduct, any expenses for treatment in mental cases which have been certified by a Government Doctor in charge of mental cases and any expenses incurred in respect of illness, injury or disablement arising from any proven fault of the employee, participation in any hazardous sport, pursuit or pastime, attempted suicide, the performance of any unlawful act, exposure to any unjustifiable hazards, except when endeavouring to save human life, the use of drugs not medically prescribed, congenital anomalies, excessive use of alcohol and plastic surgery for beautification purposes. 
					  <br/><br/>
					  The Company reserves the right to change the medical benefits offered to Employee at any time.
					  <div style="padding-left:60px;"><b> 12)Prolonged illness  </b></div>
					  On the recommendation of the Company's recognized Doctor, in the event you are suffering from tuberculosis, leukaemia, paralysis, cancer or any other illness of a prolonged nature which renders you unable to perform your duties, you shall be granted a three (3) months leave in addition to your medical leave entitlement.
					  <br/><br/>
					  In the cases where early prognosis certified by the Company's recognized Doctor which indicates six months or more or prolonged illness, you may, at your option elect to resign to from the service of the Company.
					  <div style="padding-left:60px;"><b> 13)Confidential Information   </b></div>
					  You hereby acknowledge that in the course of your employment, you may have access to and be entrusted with confidential information all of which information is or may be highly confidential.
						<br/><br/>
						All confidential information obtained by you from the Company in the course of performing your duties shall be treated as confidential and shall not be disclosed to any third party at any time.
						<br/><br/>
						You shall not at any time during the continuance of and/or after termination of your appointment and/or resignation, except by the direction or with the express written approval of the Company, divulge directly or indirectly to any individual, group or body corporate, knowledge or information which you may have acquired during the course of or incidental to your appointment by the Company concerning information, affairs or property of the Company and/or their affiliates or any business or property or transactions or policies in which the Company may be concerned or interested.
						<div style="padding-left:60px;"><b> 14)Related Expenses  </b></div>
						You shall be entitled for any travelling and other expenses incurred during the course of your services in the Company provided receipts and bills are produced accordingly.
						<div style="padding-left:60px;"><b> 15)Usage  </b></div>
						You must, when using the Company's premises or facilities, comply with all the Company's regulations and procedures and in addition any laws, directions and procedures relating to occupational health and safety and security, which at the material time in force in Malaysia. 
						<div style="padding-left:60px;"><b> 16)Retirement  </b></div>
						Your retirement age will be at the age of sixty (60). However, at the discretion of the Company, you may be re-employed on a month to month basis after your retirement.
						<div style="padding-left:60px;"><b> 17)Termination  </b></div>
						The employment herein may be terminated:- 
						<br/><br/>
						Within the first 3 months, by either party going to the other, not less than two (2) weeks' notice by the Company for any reasons without compensation or vice versa;
						<br/><br/>
						After confirmation, by either party going to the other, not less than one (1) month notice by the Company for any reasons without compensation or vice versa;
						<br/><br/>
						Immediate dismissal (24 hours) by the Company, without notice in the event of any serious misconduct or persistent tardiness or neglect of duty or serious of persistent breach of any of the terms herein or the rules or regulation, without any compensation. 
						<div style="padding-left:60px;"><b> 18)Income tax  </b></div>
						In accordance with Section 83(3) of the Income Tax Act 1967, we shall have to withhold any monies due to you on your resignation or termination of your services until tax clearance has been granted by the Directory General of Income Tax. 
						<div style="padding-left:60px;"><b> 19)Referees  </b></div>
						We reserve the right to seek clarification and reports from the referees and employers stated in the application Form for Employment and/or any other persons whom we deem necessary. In the event that any of your representations/declarations/undertakings given during the interviews or stated in the Application Form for Employment or given/stated elsewhere are found to be untrue or inaccurate and/or we receive unfavourable reports by the aforesaid person(s), this offer will be considered null and void. 
						<div style="padding-left:60px;"><b> 20)Certificate of Good Conduct  </b></div>
						You will be required, as a condition of your employment with the Company, to obtain a Good Conduct Certificate from the government agency and submit not later than 2 months of your employment. The Company reserves the right to terminate your employment for just cause at any time without notice and without payment in lieu of notice.
						<div style="padding-left:60px;"><b> 21)Miscellaneous   </b></div>
						The aforesaid terms and conditions of your employment are as by no means exhaustive. You shall be advised of the other terms and conditions of employment subsequent to you reporting for duty. 
						<div style="padding-left:60px;"><b> 22)Governing law   </b></div>
						The terms and conditions herein shall be governed and construed in accordance with the laws of Malaysia.
						<div style="padding-left:60px;"><b> 23)Personal data   </b></div>
						You shall agree, by execution of this Agreement, that the Company may collect, use, process and transmit locally or internationally your personal data for management, business and other legitimate purposes.
						<br/><br/><br/>
						If you accept our offer of employment on the terms and conditions stipulated above, kindly indicate your acceptance by signing on both copies of this letter and return the duplicate copy to us.
						<br/><br/><br/>
						Yours faithfully
						<br/><br/><br/>
						SAGAOS SDN BHD.
						<br/><br/>
						Signed:______________________________________
						<br/><br/>
						<div>
							<div class="director" style="margin-right: 120px; margin-left:40px ; margin-bottom:40px; display:inline-block;">Name: John Dickinson</div>
							<div class="director" style="margin-right: 120px; margin-bottom:40px; display:inline-block;">Position: Director</div>
							<div class="director" style="margin-right: 120px; margin-bottom:40px; display:inline-block;">Dated: <?php echo $dateToday; ?></div>
						</div>
						<div style="margin-left:40px; margin-right:40px">
							For and on behalf of the Company
							<div style="border-bottom: 3px solid black;"></div>
						</div>
						<!-- <div class="acknowledgement" style="text-align: center; margin-top:5px; margin-left:570px; margin-right:570px; border-bottom: 1px solid black;"><b> ACKNOWLEDGEMENT </b></title> -->
						<div style="text-align: center;  margin-left:480px;">
							<div class="acknowledgement" style="text-align: center; width: 30%; border-bottom: 1px solid black;"><b> ACKNOWLEDGEMENT </b></title>
						</div>
						</div>	
						I %%Candidate name%% agree to the employment within the Company and accept the stipulated terms and conditions of employment and confirm that I have received a copy of this letter of Appointment.
						<br/><br/>
						Signed: ____________________________________ 
						<div>
							<div class="candidate" style="margin-right: 120px; margin-left:40px ; margin-bottom:40px; display:inline-block;">Name: %%Candidate Name%%</div>
							<div class="candidate" style="margin-right: 120px; margin-bottom:40px; display:inline-block;">Dated: </div>
							<div class="candidate" style="margin-right: 120px; margin-bottom:40px; display:inline-block;"></div>
						</div>
					</p>
				</textarea>
	    	<div id="department-dropdown" style="margin-top: 10px; margin-bottom: 10px;">
	    		<input type="checkbox" name="department[]" id="productDelivery" value="Product Delivery" class="department-dropdown">
	    		<label for="productDelivery">Product Delivery</label>

	    		<input type="checkbox" name="department[]" id="customerService" value="Customer Service" class="department-dropdown">
	    		<label for="customerService">Customer Service</label>

	    		<input type="checkbox" name="department[]" id="marketing" value="Marketing" class="department-dropdown">
	    		<label for="marketing">Marketing</label>

	    		<input type="checkbox" name="department[]" id="paymentSecurity" value="Payment & Securities" class="department-dropdown">
	    		<label for="paymentSecurity">Payment & Securities</label>

	    		<input type="checkbox" name="department[]" id="content" value="Content" class="department-dropdown">
	    		<label for="content">Content</label>

	    		<input type="checkbox" name="department[]" id="hr" value="HR" class="department-dropdown">
	    		<label for="hr">HR</label>

	    		<input type="checkbox" name="department[]" id="design" value="Design" class="department-dropdown">
	    		<label for="design">Design</label>
	    	</div>
    		<input type="checkbox" name="offerLetterIsManagerial" id="offerLetterIsManagerial" value="1" class="department-dropdown">
    		<label for="offerLetterIsManagerial">Is for a managerial position</label>
    	</table>
    	 <input type="button" id="saveOfferLetterButton" name="saveOfferLetterButton" value="<?php echo Yii::t('app', 'Save this as a template'); ?>">
    </form>
  </div>
</div>