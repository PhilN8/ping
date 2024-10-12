# Ping Service API

In here, I will write the lessons I learn from JustSteveKing's [API course](https://apiacademy.treblle.com/laravel-api-course/intro-and-setup)

## Lesson 2

`auth:sanctum` middleware requires the `web` routes to be specified because some session information is set up automatically via web, which are required by the Sanctum middleware

## Lesson 4

Another acronym for CRUD is `BREAD`
- `B`rowse
- `R`ead
- `E`dit
- `A`dd
- `D`elete

## Lesson 7
For smaller projects: use prefixes => `v1`, `v2`

For bigger projects, or employ lots of stateful data like payments, use the Stripe Option: headers
`X-API-VERSION: 1.1.0`
Then have a middleware to check that.

### Deprecation
Addition of the HTTP Sunset Field to warn people that certain endpoints will no longer be used.
Use Middleware to add such information

## Lesson 11
Pass write operations to a background job => API can respond quicker to requests, improves testability

`Response::HTTP_ACCEPTED` => nothing wrong with the request. User does not need to know a lot (Abstraction).

`PUT` => entire payload is sent
`PATCH` => partial information

## Lesson 12

#### Internalization

- use `php artisan lang:publish` to publish the lang files.
- add your own translations
- use the `__()` function to have access the translation keys.

## Lesson 13

#### Caching

predis/predis package OR change the `CACHE_STORE` in the `.env` file to `redis`