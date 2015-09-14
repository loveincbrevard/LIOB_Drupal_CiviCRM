<?php
/*
 +--------------------------------------------------------------------+
 | CiviCRM version 4.6                                                |
 +--------------------------------------------------------------------+
 | Copyright CiviCRM LLC (c) 2004-2015                                |
 +--------------------------------------------------------------------+
 | This file is a part of CiviCRM.                                    |
 |                                                                    |
 | CiviCRM is free software; you can copy, modify, and distribute it  |
 | under the terms of the GNU Affero General Public License           |
 | Version 3, 19 November 2007 and the CiviCRM Licensing Exception.   |
 |                                                                    |
 | CiviCRM is distributed in the hope that it will be useful, but     |
 | WITHOUT ANY WARRANTY; without even the implied warranty of         |
 | MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.               |
 | See the GNU Affero General Public License for more details.        |
 |                                                                    |
 | You should have received a copy of the GNU Affero General Public   |
 | License and the CiviCRM Licensing Exception along                  |
 | with this program; if not, contact CiviCRM LLC                     |
 | at info[AT]civicrm[DOT]org. If you have questions about the        |
 | GNU Affero General Public License or the licensing of CiviCRM,     |
 | see the CiviCRM license FAQ at http://civicrm.org/licensing        |
 +--------------------------------------------------------------------+
 */

/**
 *
 * @package CRM
 * @copyright CiviCRM LLC (c) 2004-2015
 * $Id$
 *
 */
class org_loveincbrevard_rptvoltimesheetlog extends CRM_Volunteer_Form_VolunteerReport {

	function __construct() {
		 parent::__construct();
		 $time_completed_minutes = $this->customFields['time_completed_minutes']['column_name'];
		 $this->_columns['time_completed']['fields']['time_hrs_mins_completed'] = 
		 array(
			'title' => ts('Time Completed Hrs. & Mins.'),
			'dbAlias' => "CONCAT(FORMAT(FLOOR({$time_completed_minutes}/ 60),0), ' hrs. ', ({$time_completed_minutes} % 60), ' mins.')",
			'no_repeat' => TRUE,
			'default' => TRUE,
		);
	}

  function statistics(&$rows) {
		$statistics = parent::statistics($rows);
		$completed_mins = $statistics['counts']['completed']['value'];
		$completed_hrs_mins = floor($completed_mins / 60) . ' hrs. ' . ($completed_mins % 60) . ' mins.';
		$statistics['counts']['completed_hrs_mins'] = array(
			'title' => ts('Total Time Completed in Hrs. & Mins.'),
			'value' => $completed_hrs_mins,
			'type' => CRM_Utils_Type::T_STRING,
		);
		return $statistics;
	}
}
