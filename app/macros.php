<?php

\Illuminate\Support\Collection::macro(
    'mapKeysWith',
    function ($callable) {
        /* @var $this \Illuminate\Support\Collection */
        return $this->mapWithKeys(function ($item, $key) use ($callable) {
            if (is_array($item)) {
                $item = collect($item)
                    ->mapKeysWith($callable)
                    ->toArray();
            }
            return [$callable($key) => $item];
        });
    }
);

\Illuminate\Support\Collection::macro(
    'mapKeysToCamelCase',
    function () {
        /* @var $this \Illuminate\Support\Collection */
        return $this->mapKeysWith('camel_case');
    }
);

\Illuminate\Database\Query\Builder::macro(
    'whereSpatialDistance',
    function ($column, $operator, $point, $distance, $boolean = 'and') {
        $this->whereRaw(
            "ST_Distance_Sphere(`{$this->from}`.`$column`, POINT(?, ?)) $operator ?",
            [$point[0], $point[1], $distance],
            $boolean
        );
    }
);

\Illuminate\Database\Query\Builder::macro(
    'orWhereSpatialDistance',
    function ($column, $operator, $point, $distance) {
        $this->whereSpatialDistance($column, $operator, $point, $distance, 'or');
    }
);

\Illuminate\Filesystem\Filesystem::macro(
    'extractZip',
    function ($path, $extractTo) {
        $zip = new ZipArchive();
        $zip->open($path);
        $zip->extractTo($extractTo);
        $zip->close();
    }
);

//\Illuminate\Validation\Rule::macro(
//    'before',
//    function(Carbon\Carbon $date) {
//        return 'before:' . $date->toDateTimeString();
//    }
//);

\Illuminate\Validation\Rule::mixin(new \App\RulesMixin());
