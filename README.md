# iqomp/helper

Collection of global helper functions.

## Installation

```bash
composer require iqomp/helper
```

## Functions

### alt(...$args)

Get thruly value from multiple options

### deb(...$args): void

Printout vars for debuging purpose

### group_by_prop(array $array, string $prop): array

Group list of object by property of the object

### hs(string $str): string

Shorthand for htmlspeciachars

### is_indexed_array(array $array): bool

Check if the array is indexed array

### object_replace(object $origin, object $new): object

Replace object old property to the new one

### objectify($arr)

Convert the array value to object

### prop_as_key(array $array, string $prop): array

Use array object property as array key

### to_slug(string $str): string

Convert standard string to slug style
