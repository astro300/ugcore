<?php return array (
  'app' => 
  array (
    'name' => 'Sistema UG',
    'env' => 'local',
    'debug' => true,
    'url' => 'http://siug.ug.edu.ec',
    'timezone' => 'America/Guayaquil',
    'locale' => 'es',
    'fallback_locale' => 'en',
    'key' => 'base64:5Sp8RP4yMQkK9zyDNxdUW9nGPh9uOpO3RypmY/8rabU=',
    'cipher' => 'AES-256-CBC',
    'log' => 'single',
    'log_level' => 'debug',
    'providers' => 
    array (
      0 => 'Illuminate\\Auth\\AuthServiceProvider',
      1 => 'Illuminate\\Broadcasting\\BroadcastServiceProvider',
      2 => 'Illuminate\\Bus\\BusServiceProvider',
      3 => 'Illuminate\\Cache\\CacheServiceProvider',
      4 => 'Illuminate\\Foundation\\Providers\\ConsoleSupportServiceProvider',
      5 => 'Illuminate\\Cookie\\CookieServiceProvider',
      6 => 'Illuminate\\Database\\DatabaseServiceProvider',
      7 => 'Illuminate\\Encryption\\EncryptionServiceProvider',
      8 => 'Illuminate\\Filesystem\\FilesystemServiceProvider',
      9 => 'Illuminate\\Foundation\\Providers\\FoundationServiceProvider',
      10 => 'Illuminate\\Hashing\\HashServiceProvider',
      11 => 'Illuminate\\Mail\\MailServiceProvider',
      12 => 'Illuminate\\Notifications\\NotificationServiceProvider',
      13 => 'Illuminate\\Pagination\\PaginationServiceProvider',
      14 => 'Illuminate\\Pipeline\\PipelineServiceProvider',
      15 => 'Illuminate\\Queue\\QueueServiceProvider',
      16 => 'Illuminate\\Redis\\RedisServiceProvider',
      17 => 'Illuminate\\Auth\\Passwords\\PasswordResetServiceProvider',
      18 => 'Illuminate\\Session\\SessionServiceProvider',
      19 => 'Illuminate\\Translation\\TranslationServiceProvider',
      20 => 'Illuminate\\Validation\\ValidationServiceProvider',
      21 => 'Illuminate\\View\\ViewServiceProvider',
      22 => 'Laravel\\Tinker\\TinkerServiceProvider',
      23 => 'UGCore\\Providers\\AppServiceProvider',
      24 => 'UGCore\\Providers\\AuthServiceProvider',
      25 => 'UGCore\\Providers\\EventServiceProvider',
      26 => 'UGCore\\Providers\\RouteServiceProvider',
      27 => 'UGCore\\Providers\\CustomValidatorServiceProvider',
      28 => 'Anhskohbo\\NoCaptcha\\NoCaptchaServiceProvider',
      29 => 'Styde\\Html\\HtmlServiceProvider',
      30 => 'UGCore\\Providers\\ComposerServiceProvider',
      31 => 'Rap2hpoutre\\LaravelLogViewer\\LaravelLogViewerServiceProvider',
      32 => 'Yajra\\Datatables\\DatatablesServiceProvider',
      33 => 'Cviebrock\\EloquentSluggable\\ServiceProvider',
      34 => 'Barryvdh\\DomPDF\\ServiceProvider',
      35 => 'Milon\\Barcode\\BarcodeServiceProvider',
    ),
    'aliases' => 
    array (
      'App' => 'Illuminate\\Support\\Facades\\App',
      'Artisan' => 'Illuminate\\Support\\Facades\\Artisan',
      'Auth' => 'Illuminate\\Support\\Facades\\Auth',
      'Blade' => 'Illuminate\\Support\\Facades\\Blade',
      'Broadcast' => 'Illuminate\\Support\\Facades\\Broadcast',
      'Bus' => 'Illuminate\\Support\\Facades\\Bus',
      'Cache' => 'Illuminate\\Support\\Facades\\Cache',
      'Config' => 'Illuminate\\Support\\Facades\\Config',
      'Cookie' => 'Illuminate\\Support\\Facades\\Cookie',
      'Crypt' => 'Illuminate\\Support\\Facades\\Crypt',
      'DB' => 'Illuminate\\Support\\Facades\\DB',
      'Eloquent' => 'Illuminate\\Database\\Eloquent\\Model',
      'Event' => 'Illuminate\\Support\\Facades\\Event',
      'File' => 'Illuminate\\Support\\Facades\\File',
      'Gate' => 'Illuminate\\Support\\Facades\\Gate',
      'Hash' => 'Illuminate\\Support\\Facades\\Hash',
      'Lang' => 'Illuminate\\Support\\Facades\\Lang',
      'Log' => 'Illuminate\\Support\\Facades\\Log',
      'Mail' => 'Illuminate\\Support\\Facades\\Mail',
      'Notification' => 'Illuminate\\Support\\Facades\\Notification',
      'Password' => 'Illuminate\\Support\\Facades\\Password',
      'Queue' => 'Illuminate\\Support\\Facades\\Queue',
      'Redirect' => 'Illuminate\\Support\\Facades\\Redirect',
      'Redis' => 'Illuminate\\Support\\Facades\\Redis',
      'Request' => 'Illuminate\\Support\\Facades\\Request',
      'Response' => 'Illuminate\\Support\\Facades\\Response',
      'Route' => 'Illuminate\\Support\\Facades\\Route',
      'Schema' => 'Illuminate\\Support\\Facades\\Schema',
      'Session' => 'Illuminate\\Support\\Facades\\Session',
      'Storage' => 'Illuminate\\Support\\Facades\\Storage',
      'URL' => 'Illuminate\\Support\\Facades\\URL',
      'Validator' => 'Illuminate\\Support\\Facades\\Validator',
      'View' => 'Illuminate\\Support\\Facades\\View',
      'Carbon' => 'Carbon\\Carbon',
      'Messages' => 'Facades\\UGCore\\Facades\\Messages',
      'Utils' => 'Facades\\UGCore\\Facades\\Utils',
      'PDF' => 'Barryvdh\\DomPDF\\Facade',
      'DNS1D' => 'Milon\\Barcode\\Facades\\DNS1DFacade',
      'DNS2D' => 'Milon\\Barcode\\Facades\\DNS2DFacade',
    ),
  ),
  'auth' => 
  array (
    'defaults' => 
    array (
      'guard' => 'web',
      'passwords' => 'users',
    ),
    'guards' => 
    array (
      'web' => 
      array (
        'driver' => 'session',
        'provider' => 'users',
      ),
      'api' => 
      array (
        'driver' => 'token',
        'provider' => 'users',
      ),
    ),
    'providers' => 
    array (
      'users' => 
      array (
        'driver' => 'eloquent',
        'model' => 'UGCore\\Core\\Entities\\Security\\User',
      ),
    ),
    'passwords' => 
    array (
      'users' => 
      array (
        'provider' => 'users',
        'table' => 'password_resets',
        'expire' => 60,
      ),
    ),
  ),
  'broadcasting' => 
  array (
    'default' => 'log',
    'connections' => 
    array (
      'pusher' => 
      array (
        'driver' => 'pusher',
        'key' => '',
        'secret' => '',
        'app_id' => '',
        'options' => 
        array (
        ),
      ),
      'redis' => 
      array (
        'driver' => 'redis',
        'connection' => 'default',
      ),
      'log' => 
      array (
        'driver' => 'log',
      ),
      'null' => 
      array (
        'driver' => 'null',
      ),
    ),
  ),
  'cache' => 
  array (
    'default' => 'file',
    'stores' => 
    array (
      'apc' => 
      array (
        'driver' => 'apc',
      ),
      'array' => 
      array (
        'driver' => 'array',
      ),
      'database' => 
      array (
        'driver' => 'database',
        'table' => 'cache',
        'connection' => NULL,
      ),
      'file' => 
      array (
        'driver' => 'file',
        'path' => 'C:\\laragon\\www\\ugcore\\storage\\framework/cache/data',
      ),
      'memcached' => 
      array (
        'driver' => 'memcached',
        'persistent_id' => NULL,
        'sasl' => 
        array (
          0 => NULL,
          1 => NULL,
        ),
        'options' => 
        array (
        ),
        'servers' => 
        array (
          0 => 
          array (
            'host' => '127.0.0.1',
            'port' => 11211,
            'weight' => 100,
          ),
        ),
      ),
      'redis' => 
      array (
        'driver' => 'redis',
        'connection' => 'default',
      ),
    ),
    'prefix' => 'laravel',
  ),
  'captcha' => 
  array (
    'secret' => '6LdxzB8TAAAAAA3GCZBsoqiuSUXbZFemyoV-XPW9',
    'sitekey' => '6LdxzB8TAAAAAP6ygyoYIbzdRVuxhB20pgL9TIpJ',
  ),
  'configVar' => 
  array (
    'concourse' => 
    array (
      'keyDocumentacion' => '8',
    ),
  ),
  'database' => 
  array (
    'default' => 'sqlsrv',
    'connections' => 
    array (
      'sqlite' => 
      array (
        'driver' => 'sqlite',
        'database' => 'ugcore',
        'prefix' => '',
      ),
      'mysql' => 
      array (
        'driver' => 'mysql',
        'host' => '186.178.5.95',
        'port' => '3306',
        'database' => 'ugcore',
        'username' => 'userDesarrollo',
        'password' => 'userDesarrollo',
        'unix_socket' => '',
        'charset' => 'utf8mb4',
        'collation' => 'utf8mb4_unicode_ci',
        'prefix' => '',
        'strict' => true,
        'engine' => NULL,
      ),
      'sqlsrv_parametros' => 
      array (
        'driver' => 'sqlsrv',
        'host' => '186.178.5.95',
        'database' => 'BdProcesosGenerales',
        'username' => 'AcademicoUser',
        'password' => 'AcademicoUserQ1w2e3r4',
        'prefix' => '',
        'ReturnDatesAsStrings' => 1,
        'charset' => 'utf8',
        'collation' => 'Modern_Spanish_CI_AS',
      ),
      'sqlsrv' => 
      array (
        'driver' => 'sqlsrv',
        'host' => '186.178.5.95',
        'database' => 'ugcore',
        'username' => 'userDesarrollo',
        'password' => 'userDesarrollo',
        'prefix' => '',
        'ReturnDatesAsStrings' => 1,
        'charset' => 'utf8',
        'collation' => ' Modern_Spanish_BIN',
      ),
      'sqlsrv_bdacademico' => 
      array (
        'driver' => 'sqlsrv',
        'host' => '186.178.5.95',
        'database' => 'BdAcademico',
        'username' => 'userDesarrollo',
        'password' => 'userDesarrollo',
        'charset' => 'utf8',
        'prefix' => '',
        'collation' => ' Modern_Spanish_BIN',
      ),
      'sqlsrv_BdTitulacion' => 
      array (
        'driver' => 'sqlsrv',
        'host' => '186.178.5.95',
        'database' => 'BdTitulacion',
        'username' => 'userDesarrollo',
        'password' => 'userDesarrollo',
        'charset' => 'utf8',
        'prefix' => '',
        'collation' => ' Modern_Spanish_BIN',
      ),
      'sqlsrv_siug' => 
      array (
        'driver' => 'sqlsrv',
        'host' => 'localhost',
        'database' => 'forge',
        'username' => 'forge',
        'password' => '',
        'charset' => 'utf8',
        'prefix' => '',
      ),
      'sqlsrv_modulos' => 
      array (
        'driver' => 'sqlsrv',
        'host' => '186.178.5.95',
        'database' => 'modulos',
        'username' => 'userDesarrollo',
        'password' => 'userDesarrollo',
        'prefix' => '',
        'ReturnDatesAsStrings' => 1,
        'charset' => 'utf8',
        'collation' => 'Modern_Spanish_CI_AS',
      ),
    ),
    'migrations' => 'migrations',
    'redis' => 
    array (
      'client' => 'predis',
      'default' => 
      array (
        'host' => '127.0.0.1',
        'password' => NULL,
        'port' => '6379',
        'database' => 0,
      ),
    ),
  ),
  'dataselects' => 
  array (
    'status' => 
    array (
      'A' => 'ACTIVO',
      'I' => 'INACTIVO',
    ),
    'semestre' => 
    array (
      1 => 'PRIMERO',
      2 => 'SEGUNDO',
      3 => 'TERCERO',
      4 => 'CUARTO',
      5 => 'QUINTO',
      6 => 'SEXTO',
      7 => 'SÉPTIMO',
      8 => 'OCTAVO',
      9 => 'NOVENO',
      10 => 'DÉCIMO',
    ),
    'catedra' => 
    array (
      1 => 'CATEDRA 1',
      2 => 'CATEDRA 2',
      3 => 'CATEDRA 3',
      4 => 'CATEDRA 4',
      5 => 'CATEDRA 5',
      6 => 'CATEDRA 6',
      7 => 'CATEDRA 7',
      8 => 'CATEDRA 8',
      9 => 'CATEDRA 9',
      10 => 'CATEDRA 10',
    ),
    'horasActividad' => 
    array (
      0 => 'Sin Actividad',
      1 => '1 Hora',
      2 => '2 Horas',
      3 => '3 Horas',
      4 => '4 Horas',
      5 => '5 Horas',
      6 => '6 Horas',
    ),
    'TipoMallaCurricular' => 
    array (
      1 => 'NUEVA',
      2 => 'ACTUAL',
    ),
    'TipoInsitutcion' => 
    array (
      'PUBLICA' => 'PUBLICA',
      'PRIVADA' => 'PRIVADA',
    ),
    'statusconfirm' => 
    array (
      'A' => 'SI',
      'I' => 'NO',
    ),
    'comisiones' => 
    array (
      1 => 'EVALUACIONES',
      2 => 'APELACIONES',
    ),
    'dedicacion' => 
    array (
      'MT' => 'MEDIO TIEMPO',
      'TC' => 'TIEMPO COMPLETO',
    ),
    'tipoAutoridad' => 
    array (
      1 => 'DECANO',
      2 => 'VICE-DECANO',
      3 => 'DIRECTOR',
      4 => 'SUB-DIRECTOR',
      5 => 'SECRETARIO',
      6 => 'COORDINADOR-PRACTICAS',
    ),
    'estadoSolicitud' => 
    array (
      'P' => 'PENDIENTE DE ASIGNACI&Oacute;N',
      'A' => 'ASIGNADA',
      'C' => 'CULMINADA',
      'R' => 'RECHAZADA',
    ),
    'estadoSolicitudColors' => 
    array (
      'P' => 'background: #f8d3af;',
      'A' => 'background: #b5ecb5;',
      'C' => 'background: #bad6ff;',
      'R' => 'background: #d13b3b;font-weight: bold;color: #FFFFFF;',
      '' => '',
    ),
  ),
  'datatables' => 
  array (
    'search' => 
    array (
      'smart' => true,
      'case_insensitive' => true,
      'use_wildcards' => false,
    ),
    'index_column' => 'DT_Row_Index',
    'fractal' => 
    array (
      'includes' => 'include',
      'serializer' => 'League\\Fractal\\Serializer\\DataArraySerializer',
    ),
    'engines' => 
    array (
      'eloquent' => 'Yajra\\Datatables\\Engines\\EloquentEngine',
      'query' => 'Yajra\\Datatables\\Engines\\QueryBuilderEngine',
      'collection' => 'Yajra\\Datatables\\Engines\\CollectionEngine',
    ),
    'builders' => 
    array (
      'Illuminate\\Database\\Eloquent\\Relations\\Relation' => 'eloquent',
      'Illuminate\\Database\\Eloquent\\Builder' => 'eloquent',
      'Illuminate\\Database\\Query\\Builder' => 'query',
      'Illuminate\\Support\\Collection' => 'collection',
    ),
    'nulls_last_sql' => '%s %s NULLS LAST',
    'error' => NULL,
    'columns' => 
    array (
      'excess' => 
      array (
        0 => 'rn',
        1 => 'row_num',
      ),
      'escape' => '*',
      'raw' => 
      array (
        0 => 'action',
      ),
      'blacklist' => 
      array (
        0 => 'password',
        1 => 'remember_token',
      ),
      'whitelist' => '*',
    ),
    'json' => 
    array (
      'header' => 
      array (
      ),
      'options' => 0,
    ),
  ),
  'dompdf' => 
  array (
    'show_warnings' => false,
    'orientation' => 'portrait',
    'defines' => 
    array (
      'DOMPDF_FONT_DIR' => 'C:\\laragon\\www\\ugcore\\storage\\fonts/',
      'DOMPDF_FONT_CACHE' => 'C:\\laragon\\www\\ugcore\\storage\\fonts/',
      'DOMPDF_TEMP_DIR' => 'C:\\Users\\DELL\\AppData\\Local\\Temp',
      'DOMPDF_CHROOT' => 'C:\\laragon\\www\\ugcore',
      'DOMPDF_UNICODE_ENABLED' => true,
      'DOMPDF_ENABLE_FONT_SUBSETTING' => false,
      'DOMPDF_PDF_BACKEND' => 'CPDF',
      'DOMPDF_DEFAULT_MEDIA_TYPE' => 'screen',
      'DOMPDF_DEFAULT_PAPER_SIZE' => 'a4',
      'DOMPDF_DEFAULT_FONT' => 'serif',
      'DOMPDF_DPI' => 96,
      'DOMPDF_ENABLE_PHP' => false,
      'DOMPDF_ENABLE_JAVASCRIPT' => true,
      'DOMPDF_ENABLE_REMOTE' => true,
      'DOMPDF_FONT_HEIGHT_RATIO' => 1.1,
      'DOMPDF_ENABLE_CSS_FLOAT' => false,
      'DOMPDF_ENABLE_HTML5PARSER' => false,
    ),
  ),
  'filesystems' => 
  array (
    'default' => 'local',
    'cloud' => 's3',
    'disks' => 
    array (
      'local' => 
      array (
        'driver' => 'local',
        'root' => 'C:\\laragon\\www\\ugcore\\storage\\app',
      ),
      'public' => 
      array (
        'driver' => 'local',
        'root' => 'C:\\laragon\\www\\ugcore\\storage\\app/public',
        'url' => 'http://siug.ug.edu.ec/storage',
        'visibility' => 'public',
      ),
      's3' => 
      array (
        'driver' => 's3',
        'key' => NULL,
        'secret' => NULL,
        'region' => NULL,
        'bucket' => NULL,
      ),
      'ftp' => 
      array (
        'driver' => 'ftp',
        'host' => '10.87.112.38',
        'username' => 'ftpuser',
        'password' => 'Q1w2e3r4',
      ),
    ),
  ),
  'html' => 
  array (
    'theme' => 'bootstrap',
    'custom' => 'themes',
    'control_access' => true,
    'translate_texts' => true,
    'novalidate' => false,
    'abbreviations' => 
    array (
      'ph' => 'placeholder',
      'max' => 'maxlength',
      'tpl' => 'template',
    ),
    'themes' => 
    array (
      'bootstrap' => 
      array (
        'field_templates' => 
        array (
          'checkbox' => 'checkbox',
          'checkboxes' => 'collections',
          'radios' => 'collections',
        ),
        'field_classes' => 
        array (
          'default' => 'form-control',
          'checkbox' => '',
          'error' => 'input-with-feedback',
        ),
      ),
    ),
  ),
  'mail' => 
  array (
    'driver' => 'smtp',
    'host' => 'smtp.office365.com',
    'port' => '587',
    'from' => 
    array (
      'address' => 'ugsystem@ug.edu.ec',
      'name' => 'ugsystem@ug.edu.ec',
    ),
    'encryption' => 'tls',
    'username' => 'ugsystem@ug.edu.ec',
    'password' => 'S@to1989UG1',
    'sendmail' => '/usr/sbin/sendmail -bs',
    'markdown' => 
    array (
      'theme' => 'default',
      'paths' => 
      array (
        0 => 'C:\\laragon\\www\\ugcore\\resources\\views/vendor/mail',
      ),
    ),
    'stream' => 
    array (
      'ssl' => 
      array (
        'allow_self_signed' => true,
        'verify_peer' => false,
        'verify_peer_name' => false,
      ),
    ),
  ),
  'queue' => 
  array (
    'default' => 'database',
    'connections' => 
    array (
      'sync' => 
      array (
        'driver' => 'sync',
      ),
      'registerUser' => 
      array (
        'driver' => 'database',
        'table' => 'jobs',
        'queue' => 'registerUser',
        'expire' => 60,
      ),
      'recoveryUser' => 
      array (
        'driver' => 'database',
        'table' => 'jobs',
        'queue' => 'recoveryUser',
        'expire' => 60,
      ),
      'database' => 
      array (
        'driver' => 'database',
        'table' => 'jobs',
        'queue' => 'default',
        'expire' => 60,
      ),
      'beanstalkd' => 
      array (
        'driver' => 'beanstalkd',
        'host' => 'localhost',
        'queue' => 'default',
        'retry_after' => 90,
      ),
      'sqs' => 
      array (
        'driver' => 'sqs',
        'key' => 'your-public-key',
        'secret' => 'your-secret-key',
        'prefix' => 'https://sqs.us-east-1.amazonaws.com/your-account-id',
        'queue' => 'your-queue-name',
        'region' => 'us-east-1',
      ),
      'redis' => 
      array (
        'driver' => 'redis',
        'connection' => 'default',
        'queue' => 'default',
        'retry_after' => 90,
      ),
    ),
    'failed' => 
    array (
      'database' => 'sqlsrv',
      'table' => 'failed_jobs',
    ),
  ),
  'services' => 
  array (
    'mailgun' => 
    array (
      'domain' => NULL,
      'secret' => NULL,
    ),
    'ses' => 
    array (
      'key' => NULL,
      'secret' => NULL,
      'region' => 'us-east-1',
    ),
    'sparkpost' => 
    array (
      'secret' => NULL,
    ),
    'stripe' => 
    array (
      'model' => 'UGCore\\Core\\Entities\\Security\\User',
      'key' => NULL,
      'secret' => NULL,
    ),
  ),
  'session' => 
  array (
    'driver' => 'file',
    'lifetime' => 30,
    'expire_on_close' => true,
    'encrypt' => false,
    'files' => 'C:\\laragon\\www\\ugcore\\storage\\framework/sessions',
    'connection' => NULL,
    'table' => 'sessions',
    'store' => NULL,
    'lottery' => 
    array (
      0 => 2,
      1 => 100,
    ),
    'cookie' => 'laravel_session',
    'path' => '/',
    'domain' => NULL,
    'secure' => false,
    'http_only' => true,
  ),
  'sluggable' => 
  array (
    'source' => NULL,
    'maxLength' => NULL,
    'method' => NULL,
    'separator' => '-',
    'unique' => true,
    'uniqueSuffix' => NULL,
    'includeTrashed' => false,
    'reserved' => NULL,
    'onUpdate' => false,
  ),
  'view' => 
  array (
    'paths' => 
    array (
      0 => 'C:\\laragon\\www\\ugcore\\resources\\views',
    ),
    'compiled' => 'C:\\laragon\\www\\ugcore\\storage\\framework\\views',
  ),
);
