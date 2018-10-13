Orchid Filter
====
A convenient way to check the correctness of the data from the client.

#### Requirements
* PHP >= 7.0

#### Installation
Run the following command in the root directory of your web project:
  
> `composer require aengine/orchid-filter`

#### Usage
Extends class `Filter`
```php
class  UserFilter extends Filter
{
    use TraitFilter;

    // check data for create new user
    public static function add(array &$data = [])
    {
        $filter = new self($data);

        $filter->addGlobalRule($filter->leadEscape()) // global rule for all fields in $data
               ->addGlobalRule($filter->leadTrim())
               ->attr('username')
                   ->addRule($filter->checkStrlenMax(20)) // parameter passing for checking
                   ->addRule($filter->checkStrlenMin(3))
               ->attr('password')
                   ->addRule($filter->checkStrlenMax(20))
                   ->addRule($filter->checkStrlenMin(5))
               ->attr('password_again')
                   ->addRule($filter->checkStrlenMax(20))
                   ->addRule($filter->checkStrlenMin(5))
                   ->addRule($filter->checkEqualToField('password'), 'Passwords do not match') // second arg is reason error
               ->attr('email')
                   ->addRule($filter->checkEmail())
                ->attr('ip')
                    ->addRule($filter->checkIp());

        return $filter->run();
    }
}

// check data
$data = [
    'username'       => 'Aleksey',
    'password'       => 'MyPassword',
    'password_again' => 'MyPassword',
    'email'          => 'aleksey@example.com',
    'ip'             => '127.0.0.1',
];

$result = UserFilter::add($data);

if ($result === true) {
    // check ok
    var_dump($data); // sanitized data
} else {
    // found an error
    var_dump($result);
}
```

#### Usage with FilterModel class and Annotations

Uses annotations to describe filtering rules

```php
use AEngine\Orchid\Filter as Filter;

class User extends FilterModel
{
    /**
     * @Filter\Required()
     * @Filter\Check\StrlenMin(3)
     * @Filter\Check\StrlenMax(20)
     *
     * @var string
     */
    public $username;

    /**
     * @Filter\Required()
     * @Filter\Check\StrlenMin(5)
     * @Filter\Check\StrlenMax(20)
     *
     * @var string
     */
    public $password;

    /**
     * @Filter\Required()
     * @Filter\Check\StrlenMin(5)
     * @Filter\Check\StrlenMax(20)
     * @Filter\Check\EqualToField('password', message="Passwords do not match")
     *
     * @var string
     */
    public $password_again;

    /**
     * @Filter\Required()
     * @Filter\Check\Email()
     *
     * @var string
     */
    public $email;

    /**
     * @Filter\Required()
     * @Filter\Check\Ip()
     *
     * @var string
     */
    public $ip;
}

$user = new User([
    'username'       => 'Aleksey',
    'password'       => 'MyPassword',
    'password_again' => 'MyPassword',
    'email'          => 'aleksey@example.com',
    'ip'             => '127.0.0.1',
]);

$result = $car->filter();

if ($result === true) {
    // check ok
    var_dump($user); // sanitized model
} else {
    // found an error
    var_dump($result);
}

```

#### Contributing
Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

#### License
The Orchid Filter is licensed under the MIT license. See [License File](LICENSE.md) for more information.
