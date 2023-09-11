### MYTH AUTH SETUP FOLDER
 - C:\laragon\www\myigni\app\Config\Validation.php
 ```php
    public array $ruleSets = [
        Rules::class,
        FormatRules::class,
        FileRules::class,
        CreditCardRules::class,
        \Myth\Auth\Authentication\Passwords\ValidationRules::class,
    ];
        // \Myth\Auth\Authentication\Passwords\ValidationRules::class, tambahlan ini
 ```
 - C:\laragon\www\myigni\vendor\myth\auth\src\Config\Routes.php
 routes for Authentication

 - C:\laragon\www\myigni\vendor\myth\auth\src\Config\Auth.php
 ```php
     // jika ingin mengganti view bawaan dari myth
     public $views = [
        'login'           => 'Myth\Auth\Views\login',
        'register'        => 'Myth\Auth\Views\register',
        'forgot'          => 'Myth\Auth\Views\forgot',
        'reset'           => 'Myth\Auth\Views\reset',
        'emailForgot'     => 'Myth\Auth\Views\emails\forgot',
        'emailActivation' => 'Myth\Auth\Views\emails\activation',
    ];
 ```

 - C:\laragon\www\myigni\app\Config\Filters.php
 ```php
        // tambahkan tiga baris didalam $aliases seperti dibawah ini
        public array $aliases = [
            'csrf'          => CSRF::class,
            'toolbar'       => DebugToolbar::class,
            'honeypot'      => Honeypot::class,
            'invalidchars'  => InvalidChars::class,
            'secureheaders' => SecureHeaders::class,
            'login' => \Myth\Auth\Filters\LoginFilter::class,
            'role' => \Myth\Auth\Filters\RoleFilter::class,
            'permission' => \Myth\Auth\Filters\PermissionFilter::class,
        ];
        'login' => \Myth\Auth\Filters\LoginFilter::class,
        'role' => \Myth\Auth\Filters\RoleFilter::class,
        'permission' => \Myth\Auth\Filters\PermissionFilter::class,
 ```
 ada dua opsi dalam menggunakan myth, yang pertama adalah membuat semua route dikenai batasan / middleware dengan cara seperti ini 
 ```php
     // nyalakan atau uncomment honeypot dan login didalam 'before'
     public array $globals = [
        'before' => [
            'honeypot', 
            'login'
            // 'csrf',
            // 'invalidchars',
        ],
        'after' => [
            'toolbar',
            // 'honeypot',
            // 'secureheaders',
        ],
    ];
 ```
 - C:\laragon\www\myigni\vendor\myth\auth\src\Filters\LoginFilter.php
 ```php
 //jika terjadi err coba berikan $arguments = null didalam kedua function/method ini 
    public function before(RequestInterface $request, $arguments = null)
    {
        //....
     public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
 ```
