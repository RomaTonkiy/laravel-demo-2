# Table of contents
<!-- TOC -->
* [Table of contents](#table-of-contents)
* [Init project](#init-project)
  * [See Init section in Intent LMS infrastructure](#see-init-section-in-intent-lms-infrastructure)
* [Working with Modules](#working-with-modules)
  * [Structure](#structure)
  * [Modules creation](#modules-creation)
  * [Migrations](#migrations)
  * [Translations](#translations)
  * [Permissions](#permissions)
    * [Structure](#structure-1)
    * [Example](#example)
  * [GraphQL schema](#graphql-schema)
  * [Working with filters](#working-with-filters)
    * [Base info](#base-info)
    * [Additional info](#additional-info)
  * [Working with translations for Eloquent](#working-with-translations-for-eloquent)
    * [Base info](#base-info-1)
    * [Additional info](#additional-info-1)
  * [Working with Slugs](#working-with-slugs)
    * [Base info](#base-info-2)
    * [Additional info](#additional-info-2)
  * [Working with Images](#working-with-images)
    * [Base info](#base-info-3)
    * [Additional info](#additional-info-3)
<!-- TOC -->

# Init project
## See [Init section in Intent LMS infrastructure](https://bitbucket.org/intent-solutions/intent-solutions-lms-infrastructure/src)

# Working with Modules
## Structure
- All modules stored inside [Modules folder](Modules), namespace ```\Modules```.
- Structure of module after generating is following:
```text
Modules/
├── Permissions
│ ├── GraphQL
│ │ ├── Mutations
│ │ │ ├── BackOffice
│ │ │ └── FrontOffice
│ │ ├── Queries
│ │ │ ├── BackOffice
│ │ │ └── FrontOffice
│ │ ├── Schemas
│ │ │ ├── Common
│ │ │ │ └── PermissionsCommonSchema.php
│ │ │ ├── PermissionsBackOfficeSchema.php
│ │ │ └── PermissionsDefaultSchema.php
│ │ └── Types
│ ├── Interfaces
│ ├── Models
│ ├── Filters
│ ├── Permissions
│ ├── Providers
│ │ └── PermissionsServiceProvider.php
│ ├── Repositories
│ ├── Resources
│ │ └── lang
│ │     └── en
│ │         └── permissions.php
│ ├── Services
│ ├── Traits
│ ├── composer.json
│ ├── config
│ │ ├── config.php
│ │ └── permissions_grants.php - (stores all available grants for module)
│ ├── database
│ │ ├── factories
│ │ ├── migrations
│ │ └── seeders
│ │     └── PermissionsModuleSeeder.php - (default seeder for module, you can add your own seeders and call them inside run method)
│ ├── module.json
│ └── readme.md

```

## Modules creation
To create new module for GraphQL stub:

- Login into container
```bash
make tty
```
- Create new module (you will be prompted for module name and other available configs)
```bash
php artisan module:make:graphql
```

## Migrations
- To create new migration for module run
```bash
php artisan module:make-migration {NAME} {MODULE}
```
- To run migrations for module run
```bash
php artisan module:migrate --{MODULE}
```

## Translations
- All translations stored inside ```\Modules\{Module}\Resources\lang\{lang}\{file}.php```
- You can call translation using 
```php
__('{module}::{file}.{key}')
```
or 
```php
trans('{module}::{file}.{key}')
```

## Permissions

### Structure
- All permissions stored inside ```\Modules\{Module}\Permissions\...``` 
- While creating permissions you should use [BasePermissionsGroup](Modules/Permissions/Interfaces/BasePermissionsGroup.php) 
and [BasePermission](Modules/Permissions/Interfaces/BasePermission.php) abstract classes.
- Groups are used only for grouping permissions inside GraphQL schema and for admin, real permissions are ``BasePermission``.
- Each Permission that extended from ``BasePermission`` should be related so ``BasePermissionsGroup``.
- All permissions that created for module should be registered inside ``config/permissions_grants.php`` file, 
under guards they will be used for.
- When using permissions to protect your GraphQL queries and mutations, you should use [BaseMutation](Modules/Core/GraphQL/Mutations/BaseMutation.php) 
and you should call ``set{guard_name}Guard`` ``setPermissionsGuard`` method inside constructor, and pass permission that you want to use for this mutation/query.
- If no permissions passed to ``setPermissionsGuard`` method, then on this query will not be any guards checks, 
until `authorize` method rewrited to check auth for guard.

### Example
- You have ``AdminsManageGroupPermission`` which implements ``BasePermissionsGroup`` 
```php
class AdminsManageGroupPermission extends BasePermissionsGroup
{
    public function getKey(): string
    {
        return 'manage_admins';
    }

    public function getName(): string
    {
        return __('users::permissions.admins_manage_group');
    }
}
```
- You have list of CRUD permissions, like list, create, etc... 
```CreateAdminPermission```
```php
class CreateAdminPermission extends BasePermission
{
    public function getTranslate(): string
    {
        return __('permissions::permissions.grants.create');
    }

    public function getName(): string
    {
        return $this->getGroup()->getKey() . '.create';
    }

    public function getGroup(): PermissionsGroupInterface
    {
        return app(AdminsManageGroupPermission::class);
    }
}
```

- Permissions should be declared inside ``config/permissions_grants.php`` file
```php
return [
    Admin::GUARD => [
        AdminsManageGroupPermission::class => [
            ListAdminsPermission::class,
            CreateAdminPermission::class,
            UpdateAdminPermission::class,
        ],
    ],

    Organization::GUARD => [
    ],

    Teacher::GUARD => [
    ],

    User::GUARD => [
    ],

    UserParent::GUARD => [
    ],
];
```

- And that's all, now you can use this permissions inside your GraphQL schema, to protect your queries and mutations.
```php
class CreateAdminMutation extends BaseMutation
{
    public const NAME = 'createAdmin';

    public function __construct(
    )
    {
        $this->setAdminGuard();
        $this->setPermissionsGuard(app(CreateAdminPermission::class));
    }

    ...
}
```

## GraphQL schema
- All GraphQL schemas stored inside ``\Modules\{Module}\GraphQL\Schemas\...``. You should use generated schemas, registering self-written schemas is not supported yet.
- ``{ModuleName}BackOfficeSchema`` - used for admin panel, you can register your types, queries and mutations here.
- ``{ModuleName}DefaultSchema`` - used for client side, you can register your types, queries and mutations here.
- ``Common\{ModuleName}CommonSchema`` - used for both, client and admin, you can register your types, queries and mutations here, they will be shared.


## Working with filters
### Base info
- Model that should be filtered should be extended from `Modules\Core\Models\AbstractFilterableModel`
- Model should use `Modules\Core\Traits\Filterable` trait
- Model should implement `modelFilter` method that should return class name of filter for model
```php
public function modelFilter(): string
{
    return CourseCategoryFilter::class;
}
```
- Model filter should be placed into `Modules\{Module}\Filters` folder
- Model filter should be extended from `EloquentFilter\ModelFilter`
- You can use some set of trait for filtering from `Modules\Core\Traits\Filter\...`
```php
use \Modules\Core\Traits\Filter\IdFilterTrait, \Modules\Core\Traits\Filter\SortFilterTrait;
```
- If you are using `SortFilterTrait` you should define `public function allowedOrders(): array` method in your filter
```php
public function allowedOrders(): array
{
    return [
        'id',
        'sort',
    ];
}
```

### Additional info
For filters had been used [Tucker-Eric/EloquentFilter](https://github.com/Tucker-Eric/EloquentFilter)

## Working with translations for Eloquent
### Base info
- To have translated fields in your eloquent model you should use [HasTranslations](Modules/Core/Traits/HasTranslations.php) trait
and define ```public array $translatable = ['field' ....] ``` property.
```php
use HasTranslations;

public array $translatable = [
    'name',
    'meta_title',
    'meta_description',
    'short_description',
    'description',
];
```
- All columns that should be translated should have type `JSON` or `TEXT` in your migration.
- All translations for Create/Update operations should use [TranslatableFieldInput](Modules/Core/GraphQL/Types/Inputs/TranslatableFieldInput.php) input type.
```php
return [
    'name' => [
        'type' => TranslatableFieldInput::nonNullList(),
    ],
...
];
```
- To transform `TranslatableFieldInput` into acceptable in DB format you should use 
[TranslatableFieldInputTransformer](Modules/Core/Transformers/TranslatableFieldInputTransformer.php) transformer.
```php
TranslatableFieldInputTransformer::transform($dto->name)
```
- To transform translated fields into acceptable in GraphQL format you should use resolver in GraphQL type
in combination with [TranslatableModelAttributesTransformer](Modules/Core/Transformers/TranslatableModelAttributesTransformer.php).
Dont forget to set up field as `'is_relation' => false` and use `TranslatableFieldType::list()` type.
```php
public function __construct(
    protected TranslatableModelAttributesTransformer $transformer,
)
{
}

public function fields(): array
    {
        return [
            'name' => [
                'type' => TranslatableFieldType::list(),
                'is_relation' => false,
                'resolve' => function ($root, $args) {
                    return $this->transformer->transformAttribute($root, 'name');
                },
            ],
        ...       
        ];
    }
```

### Additional info
For translations had been used [spatie/laravel-translatable](https://spatie.be/docs/laravel-translatable/v6/introduction) package. See the docs for more information.


## Working with Slugs
### Base info
Your Eloquent models should use the [HasSlug](Modules/Core/Traits/HasSlug.php) trait.

The trait contains method `getSlugOptions()` with some default settings, you can override them if you need.

```php
trait HasSlug
{
    use \Spatie\Sluggable\HasSlug;

    public const SLUG_FROM_FIELD = 'name';
    public const SLUG_FIELD = 'slug';

    /**
     * Get the options for generating the slug.
     */
    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom(self::SLUG_FROM_FIELD)
            ->saveSlugsTo(self::SLUG_FIELD)
            ->usingLanguage(config('app.locale'));
    }

    public static function getSlug($from): string
    {
        $self = new self();

        $self->{self::SLUG_FROM_FIELD} = $from;
        $self->generateSlug();

        return $self->{self::SLUG_FIELD};
    }
}

```

### Additional info
For slugs had been used [spatie/laravel-sluggable](https://github.com/spatie/laravel-sluggable) package. 
See the docs for more information.

## Working with Images

### Base info
- Your model should implement `Spatie\MediaLibrary\HasMedia` interface 
and use `Modules\Core\Traits\InteractsWithMedia` trait.
- `Modules\Core\Traits\InteractsWithMedia` trait using `\Spatie\MediaLibrary\InteractsWithMedia`
and has method for registering default single file media collection. 
```php
public function registerMediaCollections(): void
{
    $this
        ->addMediaCollection('default')
        ->singleFile();

}
```
- If you want to override default collection, you should use `registerMediaCollections` method in your model.
- If you want keep default collection and add new one, you can do it in the next way: 
```php
use InteractsWithMedia {
    registerMediaCollections as registerMediaCollectionsTrait;
}

public function registerMediaCollections(): void
{
    $this->registerMediaCollectionsTrait();

    $this
        ->addMediaCollection('your_collection')
        ->singleFile();

    $this
        ->addMediaCollection('your_second_collection')
        ->singleFile();
}
```
- To work with collections you can use `Modules\Core\Services\MediaCollectionsService`
- To retrieve media url for GraphQL type you can use next apporach:
```php
public function fields(): array
{
    return [    
        ...
        'image' => [
            'type' => Type::string(),
            'is_relation' => false,
            'resolve' => function (CourseCategory $root, $args) {
                return $root->getFirstMediaUrl(YOUR_MODEL::YOUR_MEDIA_COLLECTION_NAME);
            },
        ],
        ...
    ];
}
```

### Additional info
For images had been used [spatie/laravel-medialibrary](https://spatie.be/docs/laravel-medialibrary/v11/introduction) package.
