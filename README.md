## LARAVEL-FILTER

filter eloquent model laravel


- In Model

```php
#use trait
use Bagusindrayana\LaravelFilter\Traits\LaravelFilter;

class User extends Authenticatable
{
    use HasFactory, Notifiable,LaravelFilter;

    //

}

```

- Using trait
```php
    $datas = User::filters('john',['name','email'])->get();

```


- Using trait with name input from html form
```php
    $datas = User::filtersInput(['name','email'],'input_name')->get();

```