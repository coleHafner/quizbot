
<?php $role = empty($role) ? new UserRole() : $role; ?>

<div class="ui-helper-clearfix"
	<?= !empty($id) ? ' id="' . $id . '"' : ''; ?>
	<?= !empty($hide) ? ' style="display:none;"' : ''; ?>>

	<div class="pull-left">
		<select name="roles[id][]" class="role-selector">

			<option value="">Select Role</option>

			<?php foreach (Role::getRoles() as $id => $name) : ?>
				<option value="<?= $id; ?>"
					<?= $id == $role->getRoleId() ? 'selected' : ''; ?>>
					<?= $name; ?>
				</option>
			<?php endforeach; ?>
		</select>
	</div>
	<div class="pull-left margin-right">
		<select name="roles[classroom][]" class="classroom-selector"
			<?= $role->getRoleId() == Role::GLOBAL_ADMIN || !$role->getRoleId() ? 'style="display:none;"' : ''; ?>>

			<option value="">Select Classroom</option>

			<?php foreach (Classroom::getActive() as $classroom) : ?>
				<option value="<?= $classroom->getId(); ?>"
					<?= $classroom->getId() == $role->getClassroomId() ? 'selected' : ''; ?>>
					<?= $classroom; ?>
				</option>
			<?php endforeach; ?>
		</select>
	</div>
</div>