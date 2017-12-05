<div class="register-box">
	<div class="register-logo">
		<a href="javascript:void(0);"><b>Attendee</b> Registration</a>
	</div>

	<?php if ( isset( $success ) ) : ?>
		<div class="callout callout-success">
			<p><?= $success ?></p>
		</div>
	<?php endif; ?>

	<?php if ( validation_errors() ) : ?>
		<div class="callout callout-danger">
			<?= validation_errors() ?>
		</div>
	<?php endif; ?>

	<div class="register-box-body">

		<p class="login-box-msg">Register an attendee</p>

		<form action="<?= base_url( 'register' ) ?>" method="post">
			<div class="box-group" id="accordion">
				<!-- we are adding the .panel class so bootstrap.js collapse plugin detects it -->
				<div class="box box-primary">
					<div class="box-header with-border">
						<h3 class="box-title">Attendee Details</h3>
					</div>
						<div class="box-body">
							<input type="hidden" name="form_submitted" value="1">
							<div class="row">
								<div class="col-xs-6">
									<div class="form-group">
										<label>Church</label>
										<select class="form-control select2" name="church" id="church" required>
											<option value="">Select church</option>
											<?php if ( ! empty( $churches ) ) : ?>
												<?php foreach ( $churches as $church ) : ?>
													<option value="<?= $church->id ?>" <?= set_select( 'church', $church->id ); ?>><?= $church->name ?></option>
												<?php endforeach; ?>
											<?php endif; ?>
										</select>
									</div>
								</div>
								<div class="col-xs-6">
									<div class="form-group has-feedback">
										<label>Name</label>
										<input name="name" id="name" class="form-control" placeholder="Full name" value="<?= set_value( 'name' ); ?>" required>
										<span class="glyphicon glyphicon-user form-control-feedback"></span>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-xs-6">
									<div class="form-group has-feedback">
										<label>Age</label>
										<input type="number" name="age" id="age" min="1" max="120" class="form-control" placeholder="Age" value="<?= set_value( 'age' ); ?>" required>
										<span class="glyphicons glyphicons-uk-rat-18 form-control-feedback"></span>
									</div>
								</div>
								<div class="col-xs-3">
									<div class="form-group has-feedback">
										<label>Gender</label><br/>
										<input type="radio" name="gender" value="M" class="flat-red" <?php echo set_radio( 'gender', 'M', true ); ?>> Male
										<input type="radio" name="gender" value="F" class="flat-red"  <?php echo set_radio( 'gender', 'F' ); ?>> Female
									</div>
								</div>
								<div class="col-xs-3">
									<div class="form-group has-feedback">
										<label>Accommodation</label><br>
										<input type="checkbox" id="accommodation" name="accommodation" value="1" class="flat-red" checked> Yes, required.
									</div>
								</div>
							</div>
						</div>
				</div>
				<div class="box box-primary">
					<div class="box-header with-border">
						<h3 class="box-title">Dates and Time</h3>
					</div>
					<!-- /.box-header -->
					<div class="box-body">
						<table class="table table-bordered">
							<tr>
								<th><label><input type="checkbox" name="all_days" id="all_days" value="1" class="all_days"> All days</label></th>
								<th>Morning</th>
								<th>Noon</th>
								<th>Evening</th>
								<th>Night</th>
							</tr>
							<tr>
								<td>
									<label><input type="checkbox" name="day[1][available]" id="day1" value="1" class="day"> Day 1</label>
								</td>
								<td></td>
								<td></td>
								<td></td>
								<td><input type="checkbox" name="day[1][night]" value="1" class="day1" disabled></td>
							</tr>
							<tr>
								<td>
									<label><input type="checkbox" name="day[2][available]" id="day2" value="1" class="day"> Day 2</label>
								</td>
								<td><input type="checkbox" name="day[2][morning]" value="1" class="day2" disabled></td>
								<td><input type="checkbox" name="day[2][noon]" value="1" class="day2" disabled></td>
								<td><input type="checkbox" name="day[2][evening]" value="1" class="day2" disabled></td>
								<td><input type="checkbox" name="day[1][night]" value="1" class="day2" disabled></td>
							</tr>
							<tr>
								<td>
									<label><input type="checkbox" name="day[3][available]" id="day3" value="1" class="day"> Day 3</label>
								</td>
								<td><input type="checkbox" name="day[3][morning]" value="1" class="day3" disabled></td>
								<td><input type="checkbox" name="day[3][noon]" value="1" class="day3" disabled></td>
								<td><input type="checkbox" name="day[3][evening]" value="1" class="day3" disabled></td>
								<td><input type="checkbox" name="day[1][night]" value="1" class="day3" disabled></td>
							</tr>
							<tr>
								<td>
									<label><input type="checkbox" name="day[4][available]" id="day4" value="1" class="day"> Day 4</label>
								</td>
								<td><input type="checkbox" name="day[4][morning]" value="1" class="day4" disabled></td>
								<td><input type="checkbox" name="day[4][noon]" value="1" class="day4" disabled></td>
								<td></td>
								<td></td>
							</tr>
						</table>
					</div>
				</div>

				<div class="row">
					<div class="col-xs-12">
						<button type="submit" class="btn btn-primary btn-block btn-flat">Register</button>
					</div>
				</div>
		</form>
	</div>

	</div>
<!-- /.form-box -->
</div>
<!-- /.register-box -->