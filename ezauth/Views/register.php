<?= view('template/_header') ?>

<div class="row justify-content-md-center">
	<div class="col-sm-4">
		<h2>Register</h2>

		<form action="/register" method="post">
			<?= csrf_field() ?>

			<small>All fields are required.</small>

			<br><br>

			<?= view('template/notices') ?>

			<!-- First name -->
			<div class="form-group">
				<label for="first_name" class="form-label">First Name</label>
				<input type="text" name="first_name" class="form-control" value="<?= old('first_name') ?>" required>
			</div>

			<!-- Last Name -->
			<div class="form-group">
				<label for="last_name" class="form-label">Last Name</label>
				<input type="text" name="last_name" class="form-control" value="<?= old('last_name') ?>" required>
			</div>

			<!-- Email -->
			<div class="form-group">
				<label for="email" class="form-label">Email</label>
				<input type="email" name="email" class="form-control" value="<?= old('email') ?>" required>
			</div>

			<br>

			<!-- Password -->
			<div class="form-group">
				<label for="password" class="form-label">Password</label>
				<input type="password" name="password" class="form-control" required>
				<small>Minimum 8 characters</small>
			</div>

			<!-- Password (again) -->
			<div class="form-group">
				<label for="pass_confirm" class="form-label">Password (again)</label>
				<input type="password" name="pass_confirm" class="form-control" required>
			</div>

			<br>

			<div class="text-right">
				<input type="submit" value="Register" class="btn btn-primary btn-block">
			</div>

		</form>

	</div>
</div>

<?= view('template/_footer') ?>
