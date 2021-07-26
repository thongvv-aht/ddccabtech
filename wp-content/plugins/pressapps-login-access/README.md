#Login &amp; Access

###Embed Form using PHP Function
- To embed form using php function, this must be placed in the `.php` file.

|     Function      |       Description         |
| ----------------- | ------------------------- |
| `palo_login()`    | Login Form                |
| `palo_register()` | Registration Form         |
| `palo_reset()`    | Lost Password Reset Form. |


|        Function         |       Description    |             Attributes             |
| ----------------------- | -------------------- |----------------------------------- |
| `palo_modal_login()`    | Login Modal Form     |`$login_text`  = (default) `Login`  |
|                         |                      |`$logout_text` = (default) `Logout` |
| `palo_modal_register()` | Register Modal Form  |`$register_text`  = (default) `Register`|
|                         |                      |`$registered_text` = (default) `You are already registered` |


###Embed Form using Shortcode
- To embed form using shortcode, this must be placed on the content of the post.

|     Function      |       Description         |
| ----------------- | ------------------------- |
| `[palo_login]`    | Login Form                |
| `[palo_register]` | Registration Form         |
| `[palo_forgotten]`| Lost Password Reset Form. |


|        Function         |       Description    |             Attributes             |
| ----------------------- | -------------------- |----------------------------------- |
| `palo_modal_login`      | Login Modal Form     |`login_text`  = (default) `Login`   |
|                         |                      |`logout_text` = (default) `Logout`  |
| `palo_modal_register()` | Register Modal Form  |`register_text`  = (default) `Register`|
|                         |                      |`registered_text` = (default) `You are already registered` |