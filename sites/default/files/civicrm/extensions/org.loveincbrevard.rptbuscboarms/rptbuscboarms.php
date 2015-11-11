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
class org_loveincbrevard_rptbuscboarms extends CRM_Report_Form {

  protected $_customGroupExtends = array(
    'Contact',
  //  'Individual',
    //'Household',
    //'Organization',
  );

  protected $_customGroupGroupBy = true;
  protected $_civicrm_email_website = false;

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
        ),
        'filters' => array(
          'display_name' => array('title' => ts('Name')),
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
        ),
        'grouping' => 'contact-fields',
        'order_bys' => array(
          'display_name' => array(
            'name' => 'display_name',
            'title' => ts('Name'),
          ),
        ),
      ),
      
     'civicrm_group' => array(
      'dao' => 'CRM_Contact_DAO_GroupContact',
      'fields' => array(
        'category' => array(
          'name' => 'category',
          'title' => ts('Category'),
          'dbAlias' => "CASE cgroup_civireport.title WHEN INSTR (cgroup_civireport.title, 'Ministry') >= 1 THEN 'Ministry' WHEN INSTR (cgroup_civireport.title, 'Agency') >= 1 THEN 'Agency' WHEN INSTR (cgroup_civireport.title, 'Business') >= 1 THEN 'Business' ELSE 'CBO' END ",
        ),
      ),
      'filters' => array(
        'category' => array(
        'name' => 'category', 
        'title' => ts('Category')),
      ),
      'grouping' => 'group-fields',
      'order_bys' => array(
        'category' => array(
          'name' => 'category',
          'title' => ts('Category'),
        ),
      ),
    ), 

    'civicrm_tags' => array(
      'dao' => 'CRM_Core_DAO_Tag',
      'fields' => array(
        'tags' => array(
          'name' => 'tags',
          'title' => ts('Business Type'),
        ),
      ),
      'filters' => array(
        'tags' => array(
        'name' => 'tags', 
        'title' => ts('Business Type')),
      ),
      'grouping' => 'group-fields',
      'order_bys' => array(
        'tags' => array(
          'name' => 'tags',
          'title' => ts('Business Type'),
        ),
      ),
    ), 

    'civicrm_address' => array(
      'dao' => 'CRM_Core_DAO_Address',
      'fields' => array(
        'address' => array(
          'title' => ts('Address'),
          'no_repeat' => TRUE,
        ),
      ),
      'grouping' => 'address-fields',
      'order_bys' => array(
        'address' => array(
          'title' => ts('Address'),
        ),
      ),
    ),

    'civicrm_phone' => array(
      'dao' => 'CRM_Core_DAO_Phone',
      'fields' => array(
        'phones' =>  array(
          'title' => ts('Business Phone'),
          'no_repeat' => TRUE,
        ),
      ),
      'grouping' => 'phone-fields',
    ),

    'civicrm_email' => array(
      'dao' => 'CRM_Contact_DAO_Contact',
      'fields' => array(
        'emails' =>  array(
          'title' => ts('Business Email'),
          'no_repeat' => TRUE,
        ),
      ),
      'grouping' => 'email-fields',
    ),

    'civicrm_contact_leader' => array(
      'dao' => 'CRM_Contact_DAO_Contact',
      'fields' => array(
        'full_name' => array(
          'name' => 'full_name',
          'title' => ts('Contact Name'),
        ),
        'name_phone_email' => array(
          'name' => 'name_phone_email',
          'title' => ts('Contact Phone/Email'),
        ),
      ),
      'filters' => array(
        'full_name' => array(
          'name' => 'full_name',
          'title' => ts('Contact Name'),
        ),
        'name_phone_email' => array(
          'name' => 'name_phone_email',
          'title' => ts('Contact Phone/Email'),
        ),
      ),
      'grouping' => 'contact-fields',
      'order_bys' => array(
        'full_name' => array(
          'name' => 'full_name',
          'title' => ts('Contact Name'),
        ),
        'name_phone_email' => array(
          'name' => 'name_phone_email',
          'title' => ts('Contact Phone/Email'),
        ),
      ),
    ),
  
    'civicrm_address2' => array(
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
  	    
    );
	
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
            if ($tableName == 'civicrm_address' || $tableName == 'civicrm_address2') {
              $this->_addressField = TRUE;
            }
            if ($tableName == 'civicrm_email') {
              $this->_addressFieldEmail = TRUE;
            }
            elseif ($tableName == 'civicrm_phone') {
              $this->_phoneField = TRUE;
            }
            elseif ($tableName == 'civicrm_group') {
              $this->_groupField = TRUE;
            }
            elseif ($tableName == 'civicrm_tags') {
              $this->_tagField = TRUE;
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
        FROM civicrm_contact {$this->_aliases['civicrm_contact']} {$this->_aclFrom}";

    if ($this->isTableSelected('civicrm_group')) {
      $group_filters = CRM_Utils_Array::value("gid_value", $this->_params);
      $group_filters_clause = "";
      if (!empty($group_filters)) {
        $group_filters_clause = "AND gc.group_id IN (" . implode(', ', $group_filters) . ")";
      }
        
      $this->_from .= "
            LEFT OUTER JOIN civicrm_group_contact gc 
                   ON {$this->_aliases['civicrm_contact']}.id = gc.contact_id 
              JOIN civicrm_group {$this->_aliases['civicrm_group']} 
                     ON gc.group_id = {$this->_aliases['civicrm_group']}.id "
                     . $group_filters_clause;
    }

    if ($this->isTableSelected('civicrm_tags')) {
      $this->_from .= "
        LEFT OUTER JOIN v_civicrm_rpt_contact_tags {$this->_aliases['civicrm_tags']}  
          ON ({$this->_aliases['civicrm_contact']}.id = {$this->_aliases['civicrm_tags']}.contact_id) ";
    }

    if ($this->isTableSelected('civicrm_address')) {
      $this->_from .= "
          LEFT OUTER JOIN v_civicrm_rpt_contact_address {$this->_aliases['civicrm_address']}
            ON ({$this->_aliases['civicrm_contact']}.id = {$this->_aliases['civicrm_address']}.contact_id AND
              {$this->_aliases['civicrm_address']}.is_primary = 1) ";
    }

    if ($this->isTableSelected('civicrm_phone')) {
      $this->_from .= "
          LEFT OUTER JOIN v_civicrm_rpt_contact_phones {$this->_aliases['civicrm_phone']}
            ON ({$this->_aliases['civicrm_contact']}.id = {$this->_aliases['civicrm_phone']}.contact_id ) ";
    }

    if ($this->isTableSelected('civicrm_email')) {
      $this->_from .= "
          LEFT OUTER JOIN v_civicrm_rpt_contact_emails {$this->_aliases['civicrm_email']}
            ON ({$this->_aliases['civicrm_contact']}.id = {$this->_aliases['civicrm_email']}.contact_id ) ";
    }
   	
		if ($this->isTableSelected('civicrm_contact_leader')) {
      $this->_from .= "
        LEFT OUTER JOIN v_civicrm_rpt_contact_relationships leader_cr  
        	ON ({$this->_aliases['civicrm_contact']}.id = leader_cr.contact_id AND leader_cr.rel_type_name = 'Leader is')
				LEFT OUTER JOIN v_civicrm_rpt_contact_phone_email {$this->_aliases['civicrm_contact_leader']} 
					ON (leader_cr.rel_contact_id = {$this->_aliases['civicrm_contact_leader']}.contact_id)
      ";
		}

	 	if ($this->isTableSelected('civicrm_address2')) {
    	$this->_from .= "
    			LEFT OUTER JOIN civicrm_address {$this->_aliases['civicrm_address2']} 
    				ON  ({$this->_aliases['civicrm_contact']}.id = {$this->_aliases['civicrm_address2']}.contact_id 
    				AND {$this->_aliases['civicrm_address2']}.is_primary = 1) ";
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

      if (array_key_exists('civicrm_address2_state_province_id', $row)) {
        if ($value = $row['civicrm_address2_state_province_id']) {
          $rows[$rowNum]['civicrm_address2_state_province_id'] = CRM_Core_PseudoConstant::stateProvince($value, FALSE);
        }
        $entryFound = TRUE;
      }

      if (array_key_exists('civicrm_address2_country_id', $row)) {
        if ($value = $row['civicrm_address2_country_id']) {
          $rows[$rowNum]['civicrm_address2_country_id'] = CRM_Core_PseudoConstant::country($value, FALSE);
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
}
