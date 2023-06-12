<div class="row mt-5">
	<div class="col-md-4"></div>
	<div class="col-md-4">
		<form action="./app/auth/login.php" method="post">
			<div class="input-group mb-3">
				<div class="input-group-prepend">
					<span class="input-group-text" style="width: 100px;">Username</span>
				</div>
				<input type="text" name="username" class="form-control" placeholder="john" required>
			</div>
			<div class="input-group mb-3">
				<div class="input-group-prepend">
					<span class="input-group-text" style="width: 100px;">Password</span>
				</div>
				<input type="password" name="password" class="form-control" placeholder="" required>
			</div>
			<button type="submit" class="btn btn-primary w-100">Login</button>
		</form>
	</div>
	<div class="col-md-4"></div>
</div>
