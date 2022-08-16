## BOGaming Laravel 
NewYorkGaming Seamless integration API library package for laravel.

![Packagist Downloads](https://img.shields.io/packagist/dt/newyorkgaming/nygaming-laravel?style=plastic) ![Packagist Stars](https://img.shields.io/packagist/stars/newyorkgaming/nygaming-laravel?style=plastic)
###### Complete documantation coming soon.........

### Quick Installation

```bash
composer require newyorkgaming/nygaming-laravel
```

Once the newyorkgaming/nygaming-laravel package has been installed, you need to install using this artisan command:
```bash
php artisan nygaming:install
```
## Usage

```php
// fetch all games
return NeyWorkGamiang::getGamelist();


// lauchning game
return NeyWorkGaming::makeGameLink($gameId);

```

## Env
````bash
#For staging NYG_SANDBOX=true, for production NYG_SANDBOX=false
NYG_SANDBOX=true
NYG_API_KEY="NewYorkGaming API KEY"
NYG_SHOP_ID="NewYorkGaming Shop IP"
NYG_AUTH_TOKEN="NewYorkGaming Auth Token"
````


## Contributing
Pull requests are welcome. For major changes, please open an issue first to discuss what you would like to change.

Please make sure to update tests as appropriate.

## License
[MIT](https://choosealicense.com/licenses/mit/)
