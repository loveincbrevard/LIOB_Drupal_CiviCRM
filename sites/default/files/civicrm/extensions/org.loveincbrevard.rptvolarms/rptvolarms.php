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
class org_loveincbrevard_rptvolarms extends CRM_Report_Form {

  protected $_customGroupExtends = array(
    'Contact',
  //  'Individual',
    //'Household',
    //'Organization',
  );

  protected $_customGroupGroupBy = true;
  protected $_addressFieldEmail = false;

  /**
   */
  public function __construct() {
    $this->_autoIncludeIndexedFieldsAsOrderBys = 1;

    $this->_columns = array(
      'civicrm_contact' => array(
        'dao' => 'CRM_Contact_DAO_Contact',
        'fields' => array(
          'display_name' => array(
            'title' => ts('Name'),
            'required' => TRUE,
            'no_repeat' => TRUE,
          ),
          'first_name' => array(
            'title' => ts('First Name'),
          ),
          'middle_name' => array(
            'title' => ts('Middle Name'),
          ),
          'last_name' => array(
            'title' => ts('Last Name'),
          ),
          'suffix' => array(
            'title' => ts('Suffix'),
            'dbAlias' => 'st.label',
          ),
          'gender_id' => array(
            'title' => ts('Gender'),
          ),
          'age' => array(
            'title' => ts('Age'),
            'dbAlias' => 'TIMESTAMPDIFF(YEAR, contact_civireport.birth_date, CURDATE())',
          ),
        ),
        'filters' => array(
          'display_name' => array('title' => ts('Contact Name')),
          'source' => array(
            'title' => ts('Contact Source'),
            'type' => CRM_Utils_Type::T_STRING,
          ),
          'contact_type' => array(
            'title' => ts('Contact Type'),
            'operatorType' => CRM_Report_Form::OP_MULTISELECT,
            'options' => CRM_Core_PseudoConstant::get('CRM_Contact_DAO_Contact', 'contact_type'),
          ),
          'contact_sub_type' => array(
            'title' => ts('Contact Sub Type'),
            'operatorType' => CRM_Report_Form::OP_MULTISELECT,
            'options' => CRM_Core_PseudoConstant::get('CRM_Contact_DAO_Contact', 'contact_sub_type'),
          ),
          'gender_id' => array(
            'title' => ts('Gender'),
            'operatorType' => CRM_Report_Form::OP_MULTISELECT,
            'options' => CRM_Core_PseudoConstant::get('CRM_Contact_DAO_Contact', 'gender_id'),
          ),
        ),
        'grouping' => 'contact-fields',
        'order_bys' => array(
          'last_name' => array(
            'name' => 'last_name',
            'title' => ts('Last Name'),
          ),
          'first_name' => array(
            'name' => 'first_name',
            'title' => ts('First Name'),
          ),
          'suffix' => array(
            'name' => 'suffix',
            'title' => ts('Suffix'),
            'dbAlias' => 'st.label',
          ),
          'gender_id' => array(
            'name' => 'gender_id',
            'title' => ts('Gender'),
          ),
        ),
      ),
      'civicrm_address_email' => array(
        'dao' => 'CRM_Core_DAO_Address',
        'fields' => array(
          'address_email' => array(
            'title' => ts('Address/Email'),
            'no_repeat' => TRUE,
          ),
        ),
        'grouping' => 'address-fields',
        'order_bys' => array(
          'address_email' => array(
            'title' => ts('Address/Email'),
          ),
        ),
      ),
      'civicrm_phone' => array(
        'dao' => 'CRM_Core_DAO_Phone',
        'fields' => array(
          'phones' =>  array(
            'title' => ts('Phones'),
            'no_repeat' => TRUE,
          ),
        ),
        'grouping' => 'phone-fields',
      ),
      'civicrm_group' => array(
        'dao' => 'CRM_Contact_BAO_Group',
        'fields' => array(
          'groups' =>  array(
            'title' => ts('Department'),
          ),
          'subgroups' =>  array(
            'title' => ts('Teams'),
          ),
        ),
        'grouping' => 'group-fields',
        'order_bys' => array(
          'groups' => array(
            'title' => ts('Department'),
          ),
          'subgroups' =>  array(
            'title' => ts('Teams'),
          ), 
        ),
      ), 
       'civicrm_group2' => array(
        'dao' => 'CRM_Contact_DAO_GroupContact',
        'fields' => array(
			'title' => array(
				'name' => 'title',
				'title' => ts('Group'),
				'no_display' => TRUE,
			),
        ),
        'grouping' => 'group-fields',
        'order_bys' => array(
			'title' => array(
				'name' => 'title',
				'title' => ts('Group'),
			),
        ),
      ), 
      'civicrm_contact2' => array(
        'dao' => 'CRM_Contact_DAO_Contact',
        'fields' => array(
          'possible_a_minor_19' =>  array(
            'title' => ts('Possibly a Minor'),
            'dbAlias' => 'IF (IFNULL(ai.possible_a_minor_19, 0) = 1, \'Yes\', \'\')',
          ),
          'home_church' =>  array(
            'title' => ts('Home Church'),
            'dbAlias' => 'ai.home_church_25',
          ),
          'birth_day' =>  array(
            'title' => ts('Birthday'),
            'dbAlias' => 'DATE_FORMAT(contact_civireport.birth_date, \'%m/%d\')',
          ),
          'spouse' =>  array(
            'title' => ts('Spouse'),
            'dbAlias' => 'IFNULL(cr.rel_first_name, ai.first_name_of_spouse_26)',
          ),
          'release_waiver_date_23' =>  array(
            'title' => ts('Release Waiver Date'),
            'dbAlias' => 'DATE_FORMAT(ai.release_waiver_date_23, \'%m/%d/%y\')',
          ),
          't4m_training_date_24' =>  array(
            'title' => ts('T4M Training Date'),
            'dbAlias' => 'DATE_FORMAT(ai.t4m_training_date_24, \'%m/%d/%y\')',
          ),
        ),
      ),
	  
      'civicrm_address' => array(
        'dao' => 'CRM_Core_DAO_Address',
        'fields' => array(
          'name' => array(
            'title' => ts('Address Name'),
          ),
          'street_address' => array(
            'title' => ts('Street Address'),
          ),
          'supplemental_address_1' => array(
            'title' => ts('Supplementary Address Field 1'),
          ),
          'supplemental_address_2' => array(
            'title' => ts('Supplementary Address Field 2'),
          ),
          'street_number' => array(
            'name' => 'street_number',
            'title' => ts('Street Number'),
            'type' => 1,
          ),
          'street_name' => array(
            'name' => 'street_name',
            'title' => ts('Street Name'),
            'type' => 1,
          ),
          'street_unit' => array(
            'name' => 'street_unit',
            'title' => ts('Street Unit'),
            'type' => 1,
          ),
          'city' => array(
            'title' => ts('City'),
          ),
          'county_id' => array(
            'title' => ts('County'),
          ),
          'state_province_id' => array(
            'title' => ts('State/Province'),
          ),
          'postal_code' => array(
            'title' => ts('Postal Code'),
          ),
          'postal_code_suffix' => array(
            'title' => ts('Postal Code Suffix'),
          ),
          'country_id' => array(
            'title' => ts('Country'),
          ),
        ),
        'grouping' => 'location-fields',
        'order_bys' => array(
          'city' => array(
            'name' => 'city',
            'title' => ts('City'),
          ),
          'postal_code' => array(
            'name' => 'postal_code',
            'title' => ts('Postal Code'),
          ),
        ),
      ),
    ); // + $this->getAddressColumns(array('group_by' => FALSE));
	
    $this->_groupFilter = TRUE;
    $this->_tagFilter = TRUE;
	$this->_exposeContactID = FALSE;
    parent::__construct();
  }

   public function preProcess() {
    parent::preProcess();
  }
 
   public function select() {
    $select = array();
    $this->_columnHeaders = array();
    foreach ($this->_columns as $tableName => $table) {
      if (array_key_exists('fields', $table)) {
        foreach ($table['fields'] as $fieldName => $field) {
          if (!empty($field['required']) ||
            !empty($this->_params['fields'][$fieldName])
          ) {
            if ($tableName == 'civicrm_address') {
              $this->_addressField = TRUE;
            }
            if ($tableName == 'civicrm_address_email') {
              $this->_addressFieldEmail = TRUE;
            }
            elseif ($tableName == 'civicrm_phone') {
              $this->_phoneField = TRUE;
            }
            elseif ($tableName == 'civicrm_group') {
              $this->_groupField = TRUE;
            }
            elseif ($tableName == 'civicrm_country') {
              $this->_countryField = TRUE;
            }

            $alias = "{$tableName}_{$fieldName}";
            $select[] = "{$field['dbAlias']} as {$alias}";
            $this->_columnHeaders["{$tableName}_{$fieldName}"]['type'] = CRM_Utils_Array::value('type', $field);
            $this->_columnHeaders["{$tableName}_{$fieldName}"]['title'] = $field['title'];
            $this->_selectAliases[] = $alias;
          }
        }
      }
    }

    $this->_select = "SELECT " . implode(', ', $select) . " ";
	// JCN
	//printf("REPORT SELECT %s", $this->_select);
  }
 
  /**
   * @param $fields
   * @param $files
   * @param $self
   *
   * @return array
   */
  public static function formRule($fields, $files, $self) {
    $errors = $grouping = array();
    return $errors;
  }

 public function from() {
    $this->_from = "
        FROM civicrm_contact {$this->_aliases['civicrm_contact']} {$this->_aclFrom} 
        LEFT OUTER JOIN civicrm_option_value st ON  ({$this->_aliases['civicrm_contact']}.suffix_id = st.id AND st.option_group_id = 7)
                LEFT OUTER JOIN civicrm_value_individual_additional_info_5 ai ON  ({$this->_aliases['civicrm_contact']}.id = ai.entity_id AND ai.status_9 = 'ACTIVE')
					LEFT OUTER JOIN v_civicrm_rpt_contact_relationships cr ON ({$this->_aliases['civicrm_contact']}.id = cr.contact_id AND cr.rel_type_name = 'Spouse of' )";
	
	 if ($this->isTableSelected('civicrm_address_email')) {
      $this->_from .= "
            LEFT OUTER JOIN v_civicrm_rpt_contact_primary_address_email {$this->_aliases['civicrm_address_email']}
                   ON ({$this->_aliases['civicrm_contact']}.id = {$this->_aliases['civicrm_address_email']}.contact_id ) ";
	}
	 
	 if ($this->isTableSelected('civicrm_address')) {
      $this->_from .= "
            LEFT OUTER JOIN civicrm_address {$this->_aliases['civicrm_address']}
                   ON ({$this->_aliases['civicrm_contact']}.id = {$this->_aliases['civicrm_address']}.contact_id ) AND
                      {$this->_aliases['civicrm_address']}.is_primary = 1";
	}

    if ($this->isTableSelected('civicrm_country')) {
      $this->_from .= "
            LEFT JOIN civicrm_country {$this->_aliases['civicrm_country']}
                   ON {$this->_aliases['civicrm_address']}.country_id = {$this->_aliases['civicrm_country']}.id AND
                      {$this->_aliases['civicrm_address']}.is_primary = 1 ";
    }
	
	if ($this->isTableSelected('civicrm_phone')) {
      $this->_from .= "
            LEFT OUTER JOIN v_civicrm_rpt_contact_phones {$this->_aliases['civicrm_phone']}
                   ON ({$this->_aliases['civicrm_contact']}.id = {$this->_aliases['civicrm_phone']}.contact_id) ";
    }

    if ($this->isTableSelected('civicrm_group')) {
      $this->_from .= "
            LEFT OUTER JOIN v_civicrm_rpt_contact_groups {$this->_aliases['civicrm_group']}
                   ON {$this->_aliases['civicrm_contact']}.id = {$this->_aliases['civicrm_group']}.contact_id ";
    }

    if ($this->isTableSelected('civicrm_group2')) {
			$group_filters = CRM_Utils_Array::value("gid_value", $this->_params);
			$group_filters_clause = "";
			if (!empty($group_filters)) {
      	$group_filters_clause = "AND gc.group_id IN (" . implode(', ', $group_filters) . ")";
    	}
				
      $this->_from .= "
            LEFT OUTER JOIN civicrm_group_contact gc 
                   ON {$this->_aliases['civicrm_contact']}.id = gc.contact_id 
	            JOIN civicrm_group {$this->_aliases['civicrm_group2']} 
	                   ON gc.group_id = {$this->_aliases['civicrm_group2']}.id "
	                   . $group_filters_clause;
    }
              
	// JCN
	//printf("%s", $this->_from);
	
  }

  public function postProcess() {

    $this->beginPostProcess();

    // get the acl clauses built before we assemble the query
    $this->buildACLClause($this->_aliases['civicrm_contact']);

    $sql = $this->buildQuery(TRUE);
    
		// JCN
		//printf("SQL %s", $sql);
    
    $rows = $graphRows = array();
    $this->buildRows($sql, $rows);

    $this->formatDisplay($rows);
    $this->doTemplateAssignment($rows);
    $this->endPostProcess($rows);
  }

  function groupBy() {
    //$this->_groupBy = "GROUP BY {$this->_aliases['civicrm_contact']}.id";
  }
  
  
  /**
   * @param $rows
   *
   * @return bool
   */
  private function _initBasicRow(&$rows, &$entryFound, $row, $rowId, $rowNum, $types) {
    if (!array_key_exists($rowId, $row)) {
      return FALSE;
    }

    $value = $row[$rowId];
    if ($value) {
      $rows[$rowNum][$rowId] = $types[$value];
    }
    $entryFound = TRUE;
  }

  /**
   * Alter display of rows.
   *
   * Iterate through the rows retrieved via SQL and make changes for display purposes,
   * such as rendering contacts as links.
   *
   * @param array $rows
   *   Rows generated by SQL, with an array for each row.
   */
  public function alterDisplay(&$rows) {
    $entryFound = FALSE;

    $genders = CRM_Core_PseudoConstant::get('CRM_Contact_DAO_Contact', 'gender_id', array('localize' => TRUE));

    foreach ($rows as $rowNum => $row) {
      // make count columns point to detail report
      // convert sort name to links
      if (array_key_exists('civicrm_contact_display_name', $row) &&
        array_key_exists('civicrm_contact_id', $row)
      ) {
        $url = CRM_Report_Utils_Report::getNextUrl('contact/detail',
          'reset=1&force=1&id_op=eq&id_value=' . $row['civicrm_contact_id'],
          $this->_absoluteUrl, $this->_id, $this->_drilldownReport
        );
        $rows[$rowNum]['civicrm_contact_display_name_link'] = $url;
        $rows[$rowNum]['civicrm_contact_display_name_hover'] = ts("View Constituent Detail Report for this contact.");
        $entryFound = TRUE;
      }

      if (array_key_exists('civicrm_address_state_province_id', $row)) {
        if ($value = $row['civicrm_address_state_province_id']) {
          $rows[$rowNum]['civicrm_address_state_province_id'] = CRM_Core_PseudoConstant::stateProvince($value, FALSE);
        }
        $entryFound = TRUE;
      }

      if (array_key_exists('civicrm_address_country_id', $row)) {
        if ($value = $row['civicrm_address_country_id']) {
          $rows[$rowNum]['civicrm_address_country_id'] = CRM_Core_PseudoConstant::country($value, FALSE);
        }
        $entryFound = TRUE;
      }

      // handle gender id
      $this->_initBasicRow($rows, $entryFound, $row, 'civicrm_contact_gender_id', $rowNum, $genders);

      // display birthday in the configured custom format
      if (array_key_exists('civicrm_contact_birth_date', $row)) {
        $birthDate = $row['civicrm_contact_birth_date'];
        if ($birthDate) {
          $rows[$rowNum]['civicrm_contact_birth_date'] = CRM_Utils_Date::customFormat($birthDate, '%Y%m%d');
        }
        $entryFound = TRUE;
      }

      // skip looking further in rows, if first row itself doesn't
      // have the column we need
      if (!$entryFound) {
        break;
      }
    }
  }
    
/*
 public function postProcess() {

    $this->beginPostProcess();
	
    // note1: your query
    $myQuery = "SELECT c.id 'Contact ID',
				c.display_name 'Name',
				a.address_email 'Address/Email',
				p.phones 'Phone',
				g.groups 'Department',
				g.subgroups 'Team(s)',
				IF (IFNULL(ai.possible_a_minor_19, 0) = 1, 'Yes', '') possible_a_minor_19,
				ai.home_church_25,
				DATE_FORMAT(c.birth_date, '%m/%d') 'Birthday',
				IFNULL(cr.rel_first_name, ai.first_name_of_spouse_26) 'Spouse',
				DATE_FORMAT(ai.release_waiver_date_23, '%m/%d/%y') release_waiver_date_23,
				DATE_FORMAT(ai.t4m_training_date_24, '%m/%d/%y') t4m_training_date_24
				FROM 
				civicrm_contact c 
				LEFT OUTER JOIN v_civicrm_rpt_contact_primary_address_email a ON c.id = a.contact_id
				LEFT OUTER JOIN v_civicrm_rpt_contact_phones p ON c.id = p.contact_id
				LEFT OUTER JOIN v_civicrm_rpt_contact_groups g ON c.id = g.contact_id
				LEFT OUTER JOIN civicrm_value_individual_additional_info_5 ai ON c.id = ai.entity_id AND ai.status_9 = 'ACTIVE'
				LEFT OUTER JOIN v_civicrm_rpt_contact_relationships cr ON c.id = cr.contact_id AND cr.rel_type_name = 'Spouse of'
				WHERE c.contact_type = 'Individual'
				GROUP BY c.id
				ORDER BY g.groups, g.subgroups;";
				 
        // note2: register columns you want displayed-
    $this->_columnHeaders =
            array( 'Name' => array( 'title' => 'Name' ),
                   'Address/Email'  => array( 'title' => 'Address/Email' ),
                   'Phone' => array( 'title' => 'Phone' ),
                   'Department' => array( 'title' => 'Department' ),
                   'Team(s)' => array( 'title' => 'Team(s)' ),
                   'possible_a_minor_19' => array( 'title' => 'Possibly a Minor' ),
                   'home_church_25' => array( 'title' => 'Home Church' ),
                   'Birthday' => array( 'title' => 'Birthday' ),
                   'Spouse' => array( 'title' => 'Spouse' ),
                   'release_waiver_date_23' => array( 'title' => 'Release Waiver Date' ),
                   't4m_training_date_24' => array( 'title' => 'T4M Training Date' ),
                  );
                       
    // note3: let report do the fetching of records for you
    $this->buildRows ( $myQuery, $rows );
 
    // note4: required if there are no searchable fields in the report
    //protected $_noFields = TRUE;
    $_noFields = TRUE;
    $this->formatDisplay($rows);
    $this->doTemplateAssignment($rows);
    $this->endPostProcess($rows);
  }
*/

}
