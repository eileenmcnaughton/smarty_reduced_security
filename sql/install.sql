UPDATE civicrm_msg_template
SET
msg_html = REPLACE(msg_html, '{crmAPI ', '{crmAPIWithPermissionBypass '),
    msg_text = REPLACE(msg_text, '{crmAPI ', '{crmAPIWithPermissionBypass '),
    msg_subject = REPLACE(msg_subject, '{crmAPI ', '{crmAPIWithPermissionBypass ')
WHERE
    msg_html LIKE '%{crmAPI %'
    OR msg_text LIKE '%{crmAPI %'
    OR msg_subject LIKE '%{crmAPI %';


UPDATE civicrm_action_schedule
SET
  body_text = REPLACE(body_text, '{crmAPI ', '{crmAPIWithPermissionBypass '),
  body_html = REPLACE(body_html, '{crmAPI ', '{crmAPIWithPermissionBypass '),
  subject = REPLACE(subject, '{crmAPI ', '{crmAPIWithPermissionBypass '),
  sms_body_text = REPLACE(sms_body_text, '{crmAPI ', '{crmAPIWithPermissionBypass ')
WHERE
  body_text LIKE '%{crmAPI %'
   OR body_html LIKE '%{crmAPI %'
   OR subject LIKE '%{crmAPI %'
   OR sms_body_text LIKE '%{crmAPI %';

UPDATE civicrm_mailing
SET
  body_text = REPLACE(body_text, '{crmAPI ', '{crmAPIWithPermissionBypass '),
  body_html = REPLACE(body_html, '{crmAPI ', '{crmAPIWithPermissionBypass '),
  subject = REPLACE(subject, '{crmAPI', '{crmAPIWithPermissionBypass ')
WHERE
  body_text LIKE '%{crmAPI %'
   OR body_html LIKE '%{crmAPI %'
   OR subject LIKE '%{crmAPI ';
