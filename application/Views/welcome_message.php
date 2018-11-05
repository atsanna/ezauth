<?= view('template/_header') ?>

	<h1>Welcome to CodeIgniter</h1>

	<p class="version">version <?= CodeIgniter\CodeIgniter::CI_VERSION ?></p>

	<div class="guide">
		<p>The page you are looking at is being generated dynamically by CodeIgniter.</p>

		<p>If you would like to edit this page you'll find it located at:</p>

		<pre>
		<code>
			application/Views/welcome_message.php
		</code>
		</pre>

		<p>The corresponding controller for this page is found at:</p>

		<pre>
		<code>
			application/Controllers/Home.php
		</code>
		</pre>

		<p>If you are exploring CodeIgniter for the very first time, you
			should start by reading the
			<a href="https://bcit-ci.github.io/CodeIgniter4">User Guide</a>.</p>

	</div>

<?= view('template/_footer') ?>
