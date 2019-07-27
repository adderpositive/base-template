# Base template

A template for bulding small-medius sites based on Slim Framework with Twig template system.


## TODO
- [x] base MVC concept
- [x] trailing in router patterns
- [ ] i18n
- [x] db migration
- [x] .env config or something like that
- [ ] csrf protection


## Migrations & seeds

### Migration
Create new one:
`vendor/bin/phinx create <name>`

Run:
`vendor/bin/phinx migrate`

### Seeds
Create new one:
`vendor/bin/phinx seed:create <name>`

Run:
`vendor/bin/phinx seed:run`
