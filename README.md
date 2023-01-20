curl -s "https://laravel.build/example-app?with=mysql,redis" | bash

sail artisan make:model -m Cliente

sail artisan make:factory ClienteFactory

php artisan test --filter=ClientePopulateTest::test_main

php artisan test --filter=ClientePopulateTest::test_delete_model

php artisan test --filter=ClientePopulateTest::test_restore_deleted_model

php artisan test --filter=ClientePopulateTest::test_remove_deleted_model

php artisan test --filter=ClientePopulateTest::test_force_deleted_model
