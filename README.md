Orchid Filter
====
A convenient way to check the correctness of the data from the client.

#### Requirements
* Orchid Framework
* PHP >= 7.0

#### Installation
Run the following command in the root directory of your web project:
  
> `composer require aengine/orchid-filter`

### Usage
Extends class `AbstractFilter`
```php
class Filter extends AbstractFilter
{
    public static function newUser(array &$data = [])
    {
        $filter = new self($data);

        $filter->addGlobalRule((new Escape)()) // global rule for all fields in $data
               ->addGlobalRule((new Trim)())
               ->attr('username')
                   ->addRule((new StrlenMax)(20))
                   ->addRule((new StrlenMin)(3))
               ->attr('password')
                   ->addRule((new StrlenMax)(20))
                   ->addRule((new StrlenMin)(3))
               ->attr('password_again')
                   ->addRule((new StrlenMax)(20))
                   ->addRule((new StrlenMin)(3))
                   ->addRule((new EqualToField)('password'), 'Passwords do not match')
               ->attr('email')
                   ->addRule((new Email)());

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
