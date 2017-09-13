Orchid Filter
====
A convenient way to check the correctness of the data from the client.

#### Requirements
* Orchid Framework
* PHP >= 7.0

#### Installation
Run the following command in the root directory of your web project:
  
> `composer require aengine/orchid-filter`

#### Contributing
Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

#### License
The Orchid Framework is licensed under the MIT license. See [License File](LICENSE.md) for more information.

#### Usage
Extends class `AbstractFilter`
```php
class Filter extends AbstractFilter
{
    use TraitHelper;

    public static function newUser(array &$data = [])
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
```

Check data by new filter

```php
// check data
$data = [
    'username'       => 'Aleksey',
    'password'       => 'MyPassword',
    'password_again' => 'MyPassword',
    'email'          => 'aleksey@example.com',
    'ip'             => '127.0.0.1',
];

$result = Filter::newUser($data);

if ($result === true) {
    // check ok
    var_dump($data); // sanitized data
} else {
    // found an error
    var_dump($result);
}
```