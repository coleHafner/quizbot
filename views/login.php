<div style="width: 300px; margin: 15% auto 0 auto; max-width: 90%;">
	<form method="post" action="<?php echo site_url('do-login') ?>">
		<div class="ui-widget-content ui-corner-all ui-helper-clearfix">

			<div style="padding: 10px">

				<label style="text-align: left;line-height: inherit;" class="form-field-label" for="username">Username</label>
				<div class="form-field-wrapper">
					<input style="font-size: 25px; width: 90%" id="username" type="text" name="username"  />
				</div>

				<label style="text-align: left;line-height: inherit;" class="form-field-label" for="password">Password</label>
				<div class="form-field-wrapper">
					<input style="font-size: 25px; width: 90%" id="password" type="password" name="password"  />
				</div>

				<div class="ui-helper-clearfix">
					<span class="ui-state-default ui-corner-all button" data-icon="power">
						<input type="submit" value="Login" />
					</span>
				</div>
			</div>
		</div>
	</form>
</div>