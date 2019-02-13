<?= view('template/_header') ?>

<div class="row justify-content-md-center">
	<div class="col-sm-4">
		<h2>Login</h2>

		<form action="/login" method="post">
			<?= csrf_field() ?>

			<small>All fields are required.</small>

			<br><br>

			<?= view('template/notices') ?>

			<!-- Email -->
			<div class="form-group">
				<label for="email" class="form-label">Email</label>
				<input type="email" name="email" class="form-control" value="<?= old('email') ?>" required>
			</div>

			<!-- Password -->
			<div class="form-group">
				<label for="password" class="form-label">Password</label>
				<input type="password" name="password" class="form-control" required>
				<small>Minimum 8 characters</small>
			</div>

            <br><br>

            <div>
                <input type="submit" class="btn btn-primary" value="Let Me In">
            </div>
		</form>

	</div>
</div>

<?= view('template/_footer') ?>
