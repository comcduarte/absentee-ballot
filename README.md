# absentee-ballot Application

## Installation
- Add required Sub Modules to project.  Update modules.conf.php to indicate the additional modules.

```
return [
	'Application',
];
```

- Add additional submodules to autoload in composer.

```
"autoload" : {
		"psr-4" : {
			"Application\\" : "module/Application/src/",
		}
	},
```

## Prerequistes
