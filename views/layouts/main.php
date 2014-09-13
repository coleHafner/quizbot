<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1" />

		<title><?php echo $title ?></title>

		<link type="text/css" rel="stylesheet" href="<?php echo site_url('css/themes/light-green/jquery-ui-1.10.4.custom.css', true) ?>" />
		<link rel="stylesheet" href="<?= site_url('vendor/jquery-simplecolorpicker/jquery.simplecolorpicker.css'); ?>" />
		<link type="text/css" rel="stylesheet" href="<?php echo site_url('css/style.css', true) ?>" />

		<script language="Javascript" type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
		<script language="Javascript" type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/jquery-ui.min.js"></script>
		<script language="Javascript" type="text/javascript" src="<?php echo site_url('js/global.js', true) ?>"></script>
		<script type="text/javascript" src="<?= site_url('vendor/jquery-simplecolorpicker/jquery.simplecolorpicker.js'); ?>"></script>

		<script type="text/javascript">
			$(function() {
				$('#classroom-switcher').change(function() {
					if (!$(this).val()) {
						return;
					}

					window.location.href = '<?= site_url('switch-classroom'); ?>/' + $(this).val();
				});
			})
		</script>

	</head>
	<body>
		<div class="nav ui-helper-clearfix">
			<div class="pull-left">
				<img class="logo" src="<?= site_url('images/logo.png'); ?>" title="logo" />
			</div>
			<?php if (App::isLoggedIn()) : ?>
				<div class="pull-left">
					<ul>
						<?php foreach($actions as $label => $url): ?>
							<li>
								<a <?php echo @$current_page == $label ? 'class="active"' : ''; ?>
									href="<?php echo $url ?>">
									<?php echo $label ?>
								</a>
							</li>
						<?php endforeach ?>

						<?php if (App::hasPerm(Perm::CLASSROOM_ACT_AS) && count(App::getUser()->getClassrooms()) > 1) : ?>
							<li>
								<select id="classroom-switcher">
									<option value="">Select Classroom</option>
									<?php foreach (App::getUser()->getClassrooms() as $classroom): ?>
										<option <?php echo App::getClassroomId() == $classroom->getId() ?  'selected' : ''; ?>
											value="<?php echo $classroom->getId() ?>">
											<?php echo $classroom; ?>
										</option>
									<?php endforeach ?>
								</select>
							</li>
						<?php endif; ?>
					</ul>
				</div>

				<div class="pull-right user-credentials">
					Logged in as <a href="<?= site_url('users/edit/' . App::getUserId()); ?>"> <?= App::getUser(); ?></a>
					&nbsp;&nbsp;
					<a href="/logout">Logout</a>
				</div>
			<?php endif; ?>
		</div>

		<div class="content-wrapper ui-widget">
			<?php View::load('errors', compact('errors')) ?>
			<?php View::load('messages', compact('messages')) ?>

			<div class="content">
				<?php View::load($content_view, $params) ?>
			</div>
		</div>

	</body>
</html>