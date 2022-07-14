# Director Portal

## The Webpages

### Director View
- Home: `/portal/` - User portal homepage
- Library Overview: `/portal/reference-guide/view.php?libraries=XXX`- Overview of important library data.
- Reference Guide: `/portal/reference-guide/view.php?libraries=XXX` - Director Reference Guide
- eContent: `/portal/econtent/library.php?libraries=XXX` - eContent Group Purchase view/edit.

### Admin View
- Home: `/admin.php` - Admin portal homepage
- Library Overview: `/portal/overview/index.php` - Choose a library to edit or view overview
- Reference Guide: `/portal/reference-guide/index.php` - Choose a library to view reference guide.
- IT/Tech: `/admin/it/` - Landing page for IT management links.
  - Deep Freeze Licenses: `/admin/it/df/` - List of DF licenses per library.
  - Technical Contacts: `/admin/it/tc/` - List of tech contacts per library.
  - Envisionware Console: `/admin/it/env/` - List of Envisionware console data per library.
  - IP Addresses: `/admin/it/ips/` - List of IPs per library.
- eContent: `/portal/econtent/index.php` - Landing page for eContent links.
    - GP: Choose a Library: `/portal/econtent/choose.php` - Choose a library to view/edit eContent GP
    - eContent GP Overview: `/portal/econtent/view.php` - View all library eContent GP.
- ILS: `/admin/ils/` - Landing page for ILS links.
    - Mobile App: `admin/ils/mobileapp/view.php` - View and edit all MobileApp logins for each library.
    - Aspen: `admin/ils/aspen/` - View and edit all Aspen links per library.




## The Database
---
The database is the back-end which stores the data. 

The database is **mainlib_libraryinfo** and has the following tables:
- `aspen`
- `data_table`
- `deep_freeze`
- `diagram_survey`
- `econtent`
- `econtentlist`
- `envisionware`
- `ip_addresses`
- `libraries`
- `mobile_app`
- `password_reset_temp`
- `technical_contacts`
- `users`

### users and password_reset_temp
The `users` and `password_reset_temp` are the tables for authentication and account management.

The `libraries` table is referenced in almost every view and contains 3 columns:
  - `id`
  - `library_name`
  - `library_abbr`

### data_table
This table started out as the sole table in the database before many columns were broken out to their own database. It contains 8 colums:
  - `id`
  - `admin_pw`
  - `menu_page` (0/1 value)
  - `wifi_page` (0/1 value)
  - `library_email`
  - `google_drive` (0/1 value)
  - `magellan_user`
  - `magellan_pass`

### deep_freeze
This table is for tracking Deep Freeze licenses and has 3 columns.
  - `id`
  - `library_id`
  - `license_count`

### diagram_survey
This table tracks the date the network diagram and survey were updated respectively. It has 4 columns.
  - `id`
  - `library_id`
  - `diagramLastUpdate`
  - `surveyLastUpdate`

### econtent and econtent_list
These tables are for tracking the group purchase econtent for each library. 

`econtent` contains the list of each econtent and has 2 columns:
  - `id`
  - `name`

`econtent_list` contains the ID of the econtent and the id of the library it belongs to. It has 3 columns:
  - `id`
  - `econtent_id`
  - `library_id`

### envisionware
This table tracks everything Envisionware. It has 24 columns:
  - `id`
  - `library_id`
  - `envisionware` (0/1 value)
  - `envisionware_pc_res` (0/1 value)
  - `env_lpt_print` (0/1 value)
  - `env_aam` (0/1 value)
  - `env_mobile_print` (0/1 value)
  - `con_model`
  - `con_svc_tag`
  - `con_os`
  - `con_ip`
  - `con_acronis`
  - `client_pcs`
  - `v_LPTA`
  - `v_JQE`
  - `v_PS`
  - `v_PDS`
  - `v_PCRMC`
  - `v_SM`
  - `vending`
  - `release_mode`
  - `bw_email`
  - `color_email`
  - `web_portal`

### ip_addresses
This tracks the IP addresses for each library. This table has 4 columns.
  - `id`
  - `library_id`
  - `ip_addr_1`
  - `ip_addr_2`

### mobile_app
This tracks mobile app credentials for each library. This table has 6 columns.
  - `id`
  - `library_id`
  - `username`
  - `password`
  - `self_check` (0/1 value)
  - `click_collect` (0/1 value)

### technical_contacts
This tracks each library's two technical contacts. There are 6 columns.
  - `id`
  - `library_id`
  - `tech_contact_one_name`
  - `tech_contact_one_email`
  - `tech_contact_two_name`
  - `tech_contact_two_email`


