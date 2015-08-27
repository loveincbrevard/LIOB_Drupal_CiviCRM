CREATE OR REPLACE VIEW v_civicrm_rpt_contact_phones AS
SELECT c.id contact_id,
c.display_name full_name,
GROUP_CONCAT(DISTINCT 
CONCAT(p.phone, ' (',SUBSTR(lt2.display_name, 1, 1),  ')')  ORDER BY p.is_primary DESC SEPARATOR '<br>\r\n') phones
FROM 
civicrm_contact c
LEFT OUTER JOIN civicrm_phone p ON c.id = p.contact_id
LEFT OUTER JOIN civicrm_location_type lt2 ON p.location_type_id = lt2.id
GROUP BY c.id;


CREATE OR REPLACE VIEW v_civicrm_rpt_contact_primary_address_email AS
SELECT c.id contact_id,
c.display_name full_name,
CONCAT(
  a.street_address, '<br>\r\n', 
	IFNULL(CONCAT(supplemental_address_2, '<br>\r\n'), ''),
	IFNULL(CONCAT(supplemental_address_3, '<br>\r\n'), ''),
	IFNULL(city, ''), ', ', IFNULL(sp.name, ''), ' ', IFNULL(a.postal_code, ''),
    IF(c.do_not_email = 1, '', CONCAT('<br>\r\n', e.email, ' (',lt.display_name, '', ')'))
) address_email
FROM 
civicrm_contact c
LEFT OUTER JOIN civicrm_address a ON c.id = a.contact_id AND a.is_primary = 1
LEFT OUTER JOIN civicrm_state_province sp ON a.state_province_id = sp.id
LEFT OUTER JOIN civicrm_email e ON c.id = e.contact_id AND e.is_primary = 1
LEFT OUTER JOIN civicrm_location_type lt ON e.location_type_id = lt.id
GROUP BY c.id;


CREATE OR REPLACE VIEW  v_civicrm_rpt_contact_groups AS
SELECT c.id contact_id,
c.display_name full_name,
GROUP_CONCAT(DISTINCT IFNULL(pg.title, sg.title) ORDER BY IFNULL(pg.title, sg.title) SEPARATOR '<br>\r\n') groups,
GROUP_CONCAT(DISTINCT sg.title ORDER BY IFNULL(pg.title, sg.title), sg.title SEPARATOR '<br>\r\n') subgroups
FROM 
civicrm_contact c
LEFT OUTER JOIN civicrm_group_contact gc ON c.id = gc.contact_id
LEFT OUTER JOIN civicrm_group sg ON gc.group_id = sg.id AND sg.is_active = 1
LEFT OUTER JOIN civicrm_group pg ON sg.parents = pg.id AND pg.is_active = 1
GROUP BY c.id;

CREATE OR REPLACE VIEW  v_civicrm_rpt_contact_relationships AS
SELECT c.id contact_id,
c.display_name full_name,
c.first_name,
c.last_name,
cr.id rel_contact_id,
cr.display_name rel_full_name,
cr.first_name rel_first_name,
cr.last_name rel_last_name,
rt.id rel_type_id,
rt.name_a_b rel_type_name,
rt.label_a_b rel_type_label
FROM 
civicrm_contact c
LEFT OUTER JOIN civicrm_relationship r ON c.id = r.contact_id_a AND r.is_active = 1
LEFT OUTER JOIN civicrm_relationship_type rt ON r.relationship_type_id = rt.id AND rt.is_active = 1
LEFT OUTER JOIN civicrm_contact cr ON r.contact_id_b = cr.id;

CREATE OR REPLACE VIEW  v_civicrm_rpt_contact_name_phone_email AS
SELECT c.id contact_id,
CONCAT(
  c.display_name, 
  IF(c.do_not_phone = 1, '', CONCAT('<br>\r\n', p.phone, ' (',SUBSTR(ltp.display_name, 1, 1), ')')),
  IF(c.do_not_email = 1, '', CONCAT('<br>\r\n', e.email, ' (',SUBSTR(lte.display_name, 1, 1), ')'))
) name_phone_email
FROM 
civicrm_contact c
LEFT OUTER JOIN civicrm_phone p ON c.id = p.contact_id
LEFT OUTER JOIN civicrm_email e ON c.id = e.contact_id
LEFT OUTER JOIN civicrm_location_type lte ON e.location_type_id = lte.id
LEFT OUTER JOIN civicrm_location_type ltp ON p.location_type_id = ltp.id
WHERE e.is_primary = 1
AND p.is_primary = 1
AND c.contact_type = 'Individual'
GROUP BY c.id;


CREATE OR REPLACE VIEW v_civicrm_rpt_contact_address AS
SELECT c.id contact_id,
c.display_name full_name,
CONCAT(
  a.street_address, '<br>\r\n', 
	IFNULL(CONCAT(supplemental_address_2, '<br>\r\n'), ''),
	IFNULL(CONCAT(supplemental_address_3, '<br>\r\n'), ''),
	IFNULL(city, ''), ', ', IFNULL(sp.name, ''), ' ', IFNULL(a.postal_code, '')
) address,
a.is_primary,
a.is_billing,
a.name
FROM 
civicrm_contact c
LEFT OUTER JOIN civicrm_address a ON c.id = a.contact_id AND a.is_primary = 1
LEFT OUTER JOIN civicrm_state_province sp ON a.state_province_id = sp.id
GROUP BY c.id;


