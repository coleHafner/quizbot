<?php

class DevicesController extends LoggedInApplicationController {

	/**
	 * Returns all Device records matching the query. Examples:
	 * GET /devices?column=value&order_by=column&dir=DESC&limit=20&page=2&count_only
	 * GET /rest/devices.json&limit=5
	 *
	 * @return Device[]
	 */
	function index() {
		$q = null;

		if (!App::hasPerm(Perm::REACTIVATE)) {
			$q = Query::create()->add(Device::ARCHIVED, null);
		}

		$q = Device::getQuery(@$_GET, $q);

		// paginate
		$limit = empty($_REQUEST['limit']) ? 25 : $_REQUEST['limit'];
		$page = empty($_REQUEST['page']) ? 1 : $_REQUEST['page'];
		$class = 'Device';
		$method = 'doSelectIterator';
		$this['pager'] = new QueryPager($q, $limit, $page, $class, $method);

		if (isset($_GET['count_only'])) {
			return $this['pager'];
		}
		return $this['devices'] = $this['pager']->fetchPage();
	}

	/**
	 * Form to create or edit a Device. Example:
	 * GET /devices/edit/1
	 *
	 * @return Device
	 */
	function edit($id = null) {
		return $this->getDevice($id)->fromArray(@$_GET);
	}

	/**
	 * Saves a Device. Examples:
	 * POST /devices/save/1
	 * POST /rest/devices/.json
	 * PUT /rest/devices/1.json
	 */
	function save($id = null) {
		$device = $this->getDevice($id);

		try {
			$device->fromArray($_REQUEST);

			if (App::getSession()) {
				$device->setSession(App::getSession());
			}

			if (App::getClassroom()) {
				$device->setClassroomId(App::getClassroomId());
			}

			if ($device->validate()) {

				$device->save();
				$this->flash['messages'][] = 'Device saved';
				$this->redirect('devices/show/' . $device->getId());
			}
			$this->flash['errors'] = $device->getValidationErrors();
		} catch (Exception $e) {
			$this->flash['errors'][] = $e->getMessage();
		}

		$this->redirect('devices/edit/' . $device->getId() . '?' . http_build_query($_REQUEST));
	}

	/**
	 * Returns the Device with the id. Examples:
	 * GET /devices/show/1
	 * GET /rest/devices/1.json
	 *
	 * @return Device
	 */
	function show($id = null) {
		return $this->getDevice($id);
	}

	/**
	 * Deletes the Device with the id. Examples:
	 * GET /devices/delete/1
	 * DELETE /rest/devices/1.json
	 */
	function delete($id = null) {
		$device = $this->getDevice($id);

		try {
			if (null !== $device && $device->delete()) {
				$this['messages'][] = 'Device deleted';
			} else {
				$this['errors'][] = 'Device could not be deleted';
			}
		} catch (Exception $e) {
			$this['errors'][] = $e->getMessage();
		}

		if ($this->outputFormat === 'html') {
			$this->flash['errors'] = @$this['errors'];
			$this->flash['messages'] = @$this['messages'];
			$this->redirect('devices');
		}
	}

	/**
	 * @return Device
	 */
	private function getDevice($id = null) {
		// look for id in param or in $_REQUEST array
		if (null === $id && isset($_REQUEST[Device::getPrimaryKey()])) {
			$id = $_REQUEST[Device::getPrimaryKey()];
		}

		if ('' === $id || null === $id) {
			// if no primary key provided, create new Device
			$this['device'] = new Device;
		} else {
			// if primary key provided, retrieve the record from the db
			$this['device'] = Device::retrieveByPK($id);
		}
		return $this['device'];
	}

}