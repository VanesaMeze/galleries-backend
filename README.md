php artisan vendor:publish --provider="PHPOpenSourceSaver\JWTAuth\Providers\LaravelServiceProvider"

php artisan jwt:secret

php artisan key:generate

php artisan config:cache
#
email = test@tester.com

password = tester123
