<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------
| DATABASE CONNECTIVITY SETTINGS
| -------------------------------------------------------------------
| This file will contain the settings needed to access your database.
|
| For complete instructions please consult the 'Database Connection'
| page of the User Guide.
|
| -------------------------------------------------------------------
| EXPLANATION OF VARIABLES
| -------------------------------------------------------------------
|
|	['hostname'] The hostname of your database server.
|	['username'] The username used to connect to the database
|	['password'] The password used to connect to the database
|	['database'] The name of the database you want to connect to
|	['dbdriver'] The database type. ie: mysql.  Currently supported:
				 mysql, mysqli, postgre, odbc, mssql, sqlite, oci8
|	['dbprefix'] You can add an optional prefix, which will be added
|				 to the table name when using the  Active Record class
|	['pconnect'] TRUE/FALSE - Whether to use a persistent connection
|	['db_debug'] TRUE/FALSE - Whether database errors should be displayed.
|	['cache_on'] TRUE/FALSE - Enables/disables query caching
|	['cachedir'] The path to the folder where cache files should be stored
|	['char_set'] The character set used in communicating with the database
|	['dbcollat'] The character collation used in communicating with the database
|				 NOTE: For MySQL and MySQLi databases, this setting is only used
| 				 as a backup if your server is running PHP < 5.2.3 or MySQL < 5.0.7
|				 (and in table creation queries made with DB Forge).
| 				 There is an incompatibility in PHP with mysql_real_escape_string() which
| 				 can make your site vulnerable to SQL injection if you are using a
| 				 multi-byte character set and are running versions lower than these.
| 				 Sites using Latin-1 or UTF-8 database character set and collation are unaffected.
|	['swap_pre'] A default table prefix that should be swapped with the dbprefix
|	['autoinit'] Whether or not to automatically initialize the database.
|	['stricton'] TRUE/FALSE - forces 'Strict Mode' connections
|							- good for ensuring strict SQL while developing
|
| The $active_group variable lets you choose which connection group to
| make active.  By default there is only one group (the 'default' group).
|
| The $active_record variables lets you determine whether or not to load
| the active record class
*/

$active_group = 'local';
$active_record = TRUE;
/*Live Environment*/
$db['default']['hostname'] = 'localhost';
$db['default']['username'] = 'vcity';
$db['default']['password'] = 'admin2014@)!$';
$db['default']['database'] = 'ci_notifyr';
$db['default']['dbdriver'] = 'mysqli';
$db['default']['dbprefix'] = '';
$db['default']['pconnect'] = TRUE;
$db['default']['db_debug'] = TRUE;
$db['default']['cache_on'] = FALSE;
$db['default']['cachedir'] = '';
$db['default']['char_set'] = 'utf8';
$db['default']['dbcollat'] = 'utf8_general_ci';
$db['default']['swap_pre'] = '';
$db['default']['autoinit'] = TRUE;
$db['default']['stricton'] = FALSE;

/*Test Environment*/
$db['local']['hostname'] = 'localhost';
$db['local']['username'] = 'root';
$db['local']['password'] = '';
$db['local']['database'] = 'notifyr1';
$db['local']['dbdriver'] = 'mysqli';
$db['local']['dbprefix'] = '';
$db['local']['pconnect'] = TRUE;
$db['local']['db_debug'] = TRUE;
$db['local']['cache_on'] = FALSE;
$db['local']['cachedir'] = '';
$db['local']['char_set'] = 'utf8';
$db['local']['dbcollat'] = 'utf8_general_ci';
$db['local']['swap_pre'] = '';
$db['local']['autoinit'] = TRUE;
$db['local']['stricton'] = FALSE;


/**
 * connection to the external db for farmerquery
 */
$db['extdb']['hostname'] = '(localdb)\MSSQLLocalDB';
$db['extdb']['username'] = 'sys';
$db['extdb']['password'] = 'dev';
$db['extdb']['database'] = 'NG_Core_AuthDb';
$db['extdb']['dbdriver'] = 'sqlsrv';
$db['extdb']['dbprefix'] = '';
$db['extdb']['pconnect'] = FALSE; /*TRUE;*/
$db['extdb']['db_debug'] = TRUE;
$db['extdb']['cache_on'] = FALSE;
$db['extdb']['cachedir'] = '';
$db['extdb']['char_set'] = 'utf8';
$db['extdb']['dbcollat'] = 'utf8_general_ci';
$db['extdb']['swap_pre'] = '';
$db['extdb']['autoinit'] = TRUE;
$db['extdb']['stricton'] = FALSE;


$db['sqldb']['hostname'] = "(localdb)\MSSQLLocalDB";//"127.0.0.1"; // or put the IP of your SQL Server Instance
//$db['sqldb']['port'] = 1433; // or the port you configured on step 6
$db['sqldb']['username'] = 'dev';
$db['sqldb']['password'] = 'sys';
$db['sqldb']['database'] = 'walletmanagr';
$db['sqldb']['dbdriver'] = 'sqlsrv';
$db['sqldb']['dbprefix'] = '';
$db['sqldb']['pconnect'] = FALSE; // Pay attention to this, codeigniter makes true for sqldb
$db['sqldb']['db_debug'] = TRUE;
$db['sqldb']['cache_on'] = FALSE;
$db['sqldb']['cachedir'] = '';
$db['sqldb']['char_set'] = 'utf8';
$db['sqldb']['dbcollat'] = 'utf8_general_ci';
$db['sqldb']['swap_pre'] = '';
$db['sqldb']['autoinit'] = TRUE;
$db['sqldb']['stricton'] = FALSE;

/* End of file database.php */
/* Location: ./application/config/database.php */

