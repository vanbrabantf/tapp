# Coding challenge.

A small Laravel application that features a small admin flow

## Scope
- Create a laravel project with login and registration
- Write a seeder that creates an admin user
- Create 3 pages in addition to the login and registration pages
- /admin - only admin user can see - show a list of users with a button to approve / unapprove them
- /unapproved - new users who are not approved are sent here when they login
- /approved - approved users are sent here when they login

## How to setup
This project uses docker (docker-compose).
`docker-compose up -d` in the root of the application should be enough to get it setup.
To install the composer packages you could run `docker exec -it  tapp-app composer install`
The application can be found at `http://localhost:8003/` and the database credentials can be found in the docker-compose file in the root directory.

## Possible improvements
- The GitHub workflows could take some improvements (especially the test runner, add Psalm to the builder)
- We could have some extra tests for the middleware (we currently only test by feature tests)
- The admin panel could switch to async js calls (Didn't want to pull in something like React or Vue for one request, vanilla js was maybe a bit beyond the scope)
- The first idea was to use a hexagonal architecture with the command bus pattern, something I like doing, but that would be way overkill for the application.
- Use single-action controllers (handlers). Something I usually also like to use, but again, overkill for the scope.
