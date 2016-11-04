<?php

declare(strict_types = 1);
const ROOT = __DIR__ . '/../src/';

spl_autoload_register(function ($class) {
    $class_path = ROOT . str_replace(['\\', '_'], '/', $class) . '.php';
    $class_path = str_replace('AEngine/Orchid/Filter/', '', $class_path);

    if (file_exists($class_path)) {
        require_once($class_path);

        return;
    }
});

use AEngine\Orchid\Filter\AbstractFilter;
use AEngine\Orchid\Filter\Rule\Sanitize\Between;
use AEngine\Orchid\Filter\Rule\Sanitize\Boolean;
use AEngine\Orchid\Filter\Rule\Sanitize\DateTime;
use AEngine\Orchid\Filter\Rule\Sanitize\Double;
use AEngine\Orchid\Filter\Rule\Sanitize\Escape;
use AEngine\Orchid\Filter\Rule\Sanitize\Integer;
use AEngine\Orchid\Filter\Rule\Sanitize\Lowercase;
use AEngine\Orchid\Filter\Rule\Sanitize\Remove;
use AEngine\Orchid\Filter\Rule\Sanitize\Trim;
use AEngine\Orchid\Filter\Rule\Validate\Boolean as isBoolean;
use AEngine\Orchid\Filter\Rule\Validate\CreditCard;
use AEngine\Orchid\Filter\Rule\Validate\Double as isDouble;
use AEngine\Orchid\Filter\Rule\Validate\Email;
use AEngine\Orchid\Filter\Rule\Validate\EqualToField;
use AEngine\Orchid\Filter\Rule\Validate\Integer as isInteger;
use AEngine\Orchid\Filter\Rule\Validate\Ip;
use AEngine\Orchid\Filter\Rule\Validate\StrlenMax;
use AEngine\Orchid\Filter\Rule\Validate\StrlenMin;
use AEngine\Orchid\Filter\Rule\Validate\Upload;
use AEngine\Orchid\Filter\Rule\Validate\Url;

class Filter extends AbstractFilter
{
    public static function test(array &$data = [])
    {
        $filt = new self($data);

        $filt->addGlobalRule((new Escape)())
             ->attr('bool')
                 ->addRule((new Boolean)())
                 ->addRule((new isBoolean)())
             ->attr('int')
                 ->addRule((new Integer)())
                 ->addRule((new isInteger)())
                 ->addRule((new Between)(3, 5))
             ->attr('float')
                 ->addRule((new Double)(4))
                 ->addRule((new isDouble)())
                 ->addRule((new Between)(3, 5))
             ->attr('username')
                 ->addRule((new Trim)())
                 ->addRule((new StrlenMax)(12))
                 ->addRule((new StrlenMin)(3))
             ->attr('password')
                 ->addRule((new Trim)())
                 ->addRule((new StrlenMax)(20))
                 ->addRule((new StrlenMin)(3))
             ->attr('password_again')
                 ->addRule((new Trim)())
                 ->addRule((new StrlenMax)(20))
                 ->addRule((new StrlenMin)(3))
                 ->addRule((new EqualToField)('password'))
             ->attr('pan')
                 ->addRule((new Trim)())
                 ->addRule((new CreditCard)())
             ->attr('ip')
                 ->addRule((new Trim)())
                 ->addRule((new Ip)())
             ->attr('site')
                 ->addRule((new Trim)())
                 ->addRule((new Lowercase)())
                 ->addRule((new Url)())
             ->attr('date')
                ->addRule((new DateTime)())
             ->attr('now')
                ->addRule((new Remove)())
             ->attr('upload')
                ->addRule((new Upload)())
             ->attr('email')
                 ->addRule((new Trim)())
                 ->addRule((new Email)());

        return $filt->run();
    }
}

$data = [
    'bool'           => 'on',
    'int'            => 8 * 0.7656451,
    'float'          => 4 * 0.7656451,
    'username'       => 'Alex',
    'password'       => 'MyPassword',
    'password_again' => 'MyPassword',
    'pan'            => '0000 0000 0000 0000',
    'ip'             => '127.0.0.1',
    'site'           => 'http://example.com',
    'date'           => time(),
    'now'            => '',
    'upload'         => '',
    'email'          => 'alex@example.com',
];
$data = array_merge($data, $_FILES);
$result = Filter::test($data);

?>
<pre><?
    var_dump($data);
    var_dump($result);
?></pre>
<form enctype="multipart/form-data" method="post">
    <input name="upload" type="file"/>
    <input type="submit">
</form>
