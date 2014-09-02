<script type="text/javascript">
$(function() {

	var rolesContainer = $('#roles'),
		noRoles = $('#no-roles');

	function toggleClassroomSelector(roleSelector) {
		var classroomSelector = roleSelector.parents('li').find('.classroom-selector');

		if (roleSelector.val() == ''
			|| roleSelector.val() == '<?= Role::GLOBAL_ADMIN; ?>') {
			classroomSelector.hide();
		}else {
			classroomSelector.show();
		}
	}

	$('.role-selector:visible').change(function(event) {
		toggleClassroomSelector($(this));
	});

	$('#add-role').click(function(event) {

		event.preventDefault();
		event.stopPropagation();

		var roleTemplate = $('#role-template').clone(),
			roleSelector = roleTemplate.find('.role-selector'),
			rolesList = rolesContainer.find('ul');

		roleTemplate.css('display', 'block');
		roleSelector.change(function(event) {
			toggleClassroomSelector($(this));
		});

		if (!rolesList.length || (rolesList.length && !rolesList.find('li').length)) {

			noRoles.hide();

			if (!rolesList.length) {
				var rolesList = $('<ul>');
				rolesContainer.prepend(rolesList);
			}
		}

		var item = $('<li>').append(roleTemplate);
		rolesList.append(item);
	});
});
</script>

<h1><?php echo $user->isNew() ? "New" : "Edit" ?> User</h1>

<form method="post" action="<?php echo site_url('users/save') ?>">
	<div class="ui-widget-content ui-corner-all ui-helper-clearfix">

		<input type="hidden" name="id" value="<?php echo h($user->getId()) ?>" />

		<div class="form-field-wrapper">
			<label class="form-field-label" for="user_email">Email</label>
			<input id="user_email" type="text" name="email" value="<?php echo h($user->getEmail()) ?>" />
		</div>

		<div class="form-field-wrapper">
			<label class="form-field-label" for="user_password1">Password</label>
			<input id="user_password1" type="password" name="password1" value="" />
		</div>
		<div class="form-field-wrapper">
			<label class="form-field-label" for="user_password2">Password (again)</label>
			<input id="user_password2" type="password" name="password2" value="" />
		</div>

		<div class="form-field-wrapper">
			<label class="form-field-label" for="user_type">Type</label>
			<select id="user_type" name="type">
				<option value="">Select Type</option>
				<?php foreach (User::getTypes() as $id => $name) : ?>
					<option value="<?= $id; ?>" <?= $user->getType() == $id ? 'selected' : ''; ?>>
						<?= $name; ?>
					</option>
				<?php endforeach; ?>
			</select>
		</div>

		<?php if (App::hasPerm(Perm::USER_EDIT_ROLE) && App::can(Perm::ACTION_EDIT, $user)) : ?>
			<div class="form-field-wrapper">
				<label class="form-field-label" for="user_type">Roles</label>
				<div class="form-label-offset" id="roles">
					<?php if ($user->hasAnyRole()) : ?>
						<ul>
							<?php foreach ($user->getRoles() as $role) : ?>
								<li><?php echo View::load('users/role', array('role' => $role), true); ?></li>
							<?php endforeach; ?>
						</ul>
					<?php else : ?>
						<div id="no-roles">This user has no roles</div>
					<?php endif; ?>
					<a href="#"
						id="add-role"
						data-icon="plusthick"
						title="Add Role"
						class="button margin-top">
						Add Role
					</a>


				</div>
			</div>
		<?php endif; ?>

	</div>
	<div class="form-action-buttons ui-helper-clearfix">
		<span class="button" data-icon="disk">
			<input type="submit" value="<?php echo $user->isNew() ? "Save" : "Save Changes" ?>" />
		</span>
		<?php if (isset($_SERVER['HTTP_REFERER'])): ?>
		<a class="button" data-icon="cancel" href="<?php echo $_SERVER['HTTP_REFERER'] ?>">
			Cancel
		</a>
		<?php endif ?>
	</div>
</form>

<?= View::load('users/role', array('id' => 'role-template', 'hide' => true), true); ?>
