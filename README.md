# LARAVEL-FILTER

filter eloquent model laravel


## Installation

```
composer require bagusindrayana/laravel-filter

```


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
    //example if input name is "search" so you should replace input_name with "search"

```

- Set attribute in model
```php
    class User extends Authenticatable
    {
        use HasFactory, Notifiable,LaravelFilter;

        protected $filterFields = [
            'name',
            'email'
        ];



    }

    //you will only need call fuction name
    User::filters('john')->get();
    User::filtersInput(null,'search')->get();

```

- Relationship format
you need use trait to all model in relationship

```php
    protected $filterFields = [
        'name',
        'email',
        [
            'Role'=>[
                'role_name'
            ]
        ]
    ];

    //or when call function
    User::filtersInput([
        'name',
        'email',
        [
            'Role'=>[
                'role_name'
            ]
        ]
    ],'search')->get();
```


### Available scope

- filters(value,field)
- filtersInput(field,inputName)
- orFilters(value,field)
- orFiltersInput(field,inputName)