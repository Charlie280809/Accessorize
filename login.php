<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login to Accessorize</title>
</head>
<body>
<div class="form form_login">
        <form action="" method="post">
            
            <!-- <//?php if(isset($error)): ?> als de variabele 'error' bestaat, voer code block uit
                <div class="error">
                    <p>
                        Hmm, your e-mail or password must be wrong. Please try again.
                    </p>
                </div>
            <//?php endif; ?> -->

            <div class="form_field">					
                <label for="Email">E-mail</label>
				<input type="text" name="email">
			</div>

			<div class="form_field">
				<label for="Password">Password</label>
				<input type="password" name="password">
			</div>

			<div class="form_field">
				<input type="submit" value="Sign in" class="btn_submit">	
				<!-- <input type="checkbox" id="rememberMe"><label for="rememberMe" class="label__inline">Remember me</label> -->
			</div>

        </form>
    </div>
</body>
</html>