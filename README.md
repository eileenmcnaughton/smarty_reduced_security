# smarty_reduced_security
in CiviCRM 5.69.6 and 5.74.4+ the `crmAPI` smarty function
is not permitted to be used in user content which includes

This should not be installed on versions less than 5.69.6 or between 5.69.6
and 5.74.4 because the database updates are in the
install script and the actual usage relies on smarty
having a getVersion() function, which it won't outside those versions.

- Workflow message templates
- Any similar tables added by extensions
- Scheduled reminders ?

And if the civicrm.settings.php contains
define('CIVICRM_MAIL_SMARTY', 1);

then
- Scheduled reminders
- User message templates
- Civi Mail
- Headers & footers for civicrm mailings

This extension replaces `crmAPI` in those tables with `crmAPIWithPermissionBypass`
which is not blocked. It does, however, prevent non-get functions being accessed
this way.

This extension is intended to be transitional - in most cases more
specific ways will be developer over the next few months to avoid calling the
api in a permission-bypass manner from user-editable code. However, many
sites will want a quick fix to keep existing usages of `crmAPI` working
and this will do that.

It is very much patch-welcome, intended to be a short term helper.

This is an [extension for CiviCRM](https://docs.civicrm.org/sysadmin/en/latest/customize/extensions/), licensed under [AGPL-3.0](LICENSE.txt).

## Getting Started


## Known Issues


