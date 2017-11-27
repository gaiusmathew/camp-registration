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
				<div class="panel box box-primary">
					<div class="box-header with-border">
						<h4 class="box-title">
							<a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">Attendee Details</a>
						</h4>
					</div>
					<div id="collapseOne" class="panel-collapse collapse in">
						<div class="box-body">
							<input type="hidden" name="form_submitted" value="1">
							<div class="row">
								<div class="col-xs-6">
									<div class="form-group">
										<label>Church</label>
										<select class="form-control" name="church" id="church">
											<option value="">Select church</option>
											<?php if ( ! empty( $churches ) ) : ?>
												<?php foreach ( $churches as $church ) : ?>
													<option value="<?= $church->id ?>"><?= $church->name ?></option>
												<?php endforeach; ?>
											<?php endif; ?>
										</select>
									</div>
								</div>
								<div class="col-xs-6">
									<div class="form-group has-feedback">
										<label>Name</label>
										<input name="name" id="name" class="form-control" placeholder="Full name">
										<span class="glyphicon glyphicon-user form-control-feedback"></span>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-xs-6">
									<div class="form-group has-feedback">
										<label>Age</label>
										<input type="number" name="age" id="age" min="1" max="120" class="form-control" placeholder="Age">
										<span class="glyphicons glyphicons-uk-rat-18 form-control-feedback"></span>
									</div>
								</div>
								<div class="col-xs-3">
									<div class="form-group has-feedback">
										<label>Gender</label><br/>
										<input type="radio" name="gender" value="M" class="flat-red" checked> Male
										<input type="radio" name="gender" value="F" class="flat-red"> Female
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
				</div>
				<div class="panel box box-primary">
					<div class="box-header with-border">
						<h4 class="box-title">
							<a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">Accommodation Details</a>
						</h4>
					</div>
					<div id="collapseTwo" class="panel-collapse collapse in">
						<div class="box-body">
							<div class="row">
								<div class="col-xs-6">
									<div class="form-group has-feedback">
										<label><input type="checkbox" name="day1" id="day1" value="1" class="flat-red day" checked> Day 1</label><br/>
										<input type="checkbox" name="day1_3" value="1" class="flat-red day1_children" checked> Night
									</div>
								</div>
								<div class="col-xs-6">
									<div class="form-group has-feedback">
										<label><input type="checkbox" name="day2" id="day2" value="1" class="flat-red day"> Day 2</label><br/>
										<input type="checkbox" name="day2_1" value="1" class="flat-red day2_children" checked> Morning
										<input type="checkbox" name="day2_2" value="1" class="flat-red day2_children" checked> Afternoon
										<input type="checkbox" name="day2_3" value="1" class="flat-red day2_children" checked> Night
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-xs-6">
									<div class="form-group has-feedback">
										<label><input type="checkbox" name="day3" id="day3" value="1" class="flat-red day"> Day 3</label><br/>
										<input type="checkbox" name="day3_1" value="1" class="flat-red day3_children" checked> Morning
										<input type="checkbox" name="day3_2" value="1" class="flat-red day3_children" checked> Afternoon
										<input type="checkbox" name="day3_3" value="1" class="flat-red day3_children" checked> Night
									</div>
								</div>
								<div class="col-xs-6">
									<div class="form-group has-feedback">
										<label><input type="checkbox" name="day4" id="day4" value="1" class="flat-red day"> Day 4</label><br/>
										<input type="checkbox" name="day4_1" value="1" class="flat-red day4_children" checked> Morning
										<input type="checkbox" name="day4_2" value="1" class="flat-red day4_children" checked> Afternoon
										<input type="checkbox" name="day4_3" value="1" class="flat-red day4_children" checked> Night
									</div>
								</div>
							</div>
						</div>
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