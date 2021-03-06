<?php
/**
 * phpVMS - Virtual Airline Administration Software
 * Copyright (c) 2008 Nabeel Shahzad
 * For more information, visit www.phpvms.net
 *	Forums: http://www.phpvms.net/forum
 *	Documentation: http://www.phpvms.net/docs
 *
 * phpVMS is licenced under the following license:
 *   Creative Commons Attribution Non-commercial Share Alike (by-nc-sa)
 *   View license.txt in the root, or visit http://creativecommons.org/licenses/by-nc-sa/3.0/
 *
 * @author Nabeel Shahzad
 * @copyright Copyright (c) 2008, Nabeel Shahzad
 * @link http://www.phpvms.net
 * @license http://creativecommons.org/licenses/by-nc-sa/3.0/
 * @package module_admin_sitecms
 */

class Reports extends CodonModule {
	function HTMLHead() {
		$this->set('sidebar', 'sidebar_reports.php');
	}

	public function index() {
		$this->overview();
	}

	public function overview() {
		$this->set('acstats', StatsData::AircraftUsage());
		$this->set('toproutes', StatsData::TopRoutes());

		$this->set('allairlines', OperationsData::GetAllAirlines());

		$this->render('reports_main.php');
	}

	public function aircraft() {
		$acstats = StatsData::AircraftUsage();

		$this->set('acstats', $acstats);
		$this->render('reports_aircraft.php');
	}
}