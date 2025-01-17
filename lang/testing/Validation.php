<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted' => 'accepted',
    'accepted_if' => 'accepted_if',
    'active_url' => 'active_url',
    'after' => 'after',
    'after_or_equal' => 'after_or_equal',
    'alpha' => 'alpha',
    'alpha_dash' => 'alpha_dash',
    'alpha_num' => 'alpha_num',
    'array' => 'array',
    'ascii' => 'ascii',
    'before' => 'before',
    'before_or_equal' => 'before_or_equal',
    'between' => [
        'array' => 'between',
        'file' => 'between',
        'numeric' => 'between',
        'string' => 'between',
    ],
    'boolean' => 'boolean',
    'can' => 'can',
    'confirmed' => 'confirmed',
    'contains' => 'contains',
    'current_password' => 'current_password',
    'date' => 'date',
    'date_equals' => 'date_equals',
    'date_format' => 'date_format',
    'decimal' => 'decimal',
    'declined' => 'declined',
    'declined_if' => 'declined_if',
    'different' => 'different',
    'digits' => 'digits',
    'digits_between' => 'digits_between',
    'dimensions' => 'dimensions',
    'distinct' => 'distinct',
    'doesnt_end_with' => 'doesnt_end_with',
    'doesnt_start_with' => 'doesnt_start_with',
    'email' => 'email',
    'ends_with' => 'ends_with',
    'enum' => 'enum',
    'exists' => 'exists',
    'extensions' => 'extensions',
    'file' => 'file',
    'filled' => 'filled',
    'gt' => [
        'array' => 'gt',
        'file' => 'gt',
        'numeric' => 'gt',
        'string' => 'gt',
    ],
    'gte' => [
        'array' => 'gte',
        'file' => 'gte',
        'numeric' => 'gte',
        'string' => 'gte',
    ],
    'hex_color' => 'hex_color',
    'image' => 'image',
    'in' => 'in',
    'in_array' => 'in_array',
    'integer' => 'integer',
    'ip' => 'ip',
    'ipv4' => 'ipv4',
    'ipv6' => 'ipv6',
    'json' => 'json',
    'list' => 'list',
    'lowercase' => 'lowercase',
    'lt' => [
        'array' => 'lt',
        'file' => 'lt',
        'numeric' => 'lt',
        'string' => 'lt',
    ],
    'lte' => [
        'array' => 'lte',
        'file' => 'lte',
        'numeric' => 'lte',
        'string' => 'lte',
    ],
    'mac_address' => 'mac_address',
    'max' => [
        'array' => 'max',
        'file' => 'max',
        'numeric' => 'max',
        'string' => 'max',
    ],
    'max_digits' => 'max_digits',
    'mimes' => 'mimes',
    'mimetypes' => 'mimetypes',
    'min' => [
        'array' => 'min',
        'file' => 'min',
        'numeric' => 'min',
        'string' => 'min',
    ],
    'min_digits' => 'min_digits',
    'missing' => 'missing',
    'missing_if' => 'missing_if',
    'missing_unless' => 'missing_unless',
    'missing_with' => 'missing_with',
    'missing_with_all' => 'missing_with_all',
    'multiple_of' => 'multiple_of',
    'not_in' => 'not_in',
    'not_regex' => 'not_regex',
    'numeric' => 'numeric',
    'password' => [
        'letters' => 'letters',
        'mixed' => 'mixed',
        'numbers' => 'numbers',
        'symbols' => 'symbols',
        'uncompromised' => 'uncompromised',
    ],
    'present' => 'present',
    'present_if' => 'present_if',
    'present_unless' => 'present_unless',
    'present_with' => 'present_with',
    'present_with_all' => 'present_with_all',
    'prohibited' => 'prohibited',
    'prohibited_if' => 'prohibited_if',
    'prohibited_unless' => 'prohibited_unless',
    'prohibits' => 'prohibits',
    'regex' => 'regex',
    'required' => 'required',
    'required_array_keys' => 'required_array_keys',
    'required_if' => 'required_if',
    'required_if_accepted' => 'required_if_accepted',
    'required_if_declined' => 'required_if_declined',
    'required_unless' => 'required_unless',
    'required_with' => 'required_with',
    'required_with_all' => 'required_with_all',
    'required_without' => 'required_without',
    'required_without_all' => 'required_without_all',
    'same' => 'same',
    'size' => [
        'array' => 'size',
        'file' => 'size',
        'numeric' => 'size',
        'string' => 'size',
    ],
    'starts_with' => 'starts_with',
    'string' => 'string',
    'timezone' => 'timezone',
    'unique' => 'unique',
    'uploaded' => 'uploaded',
    'uppercase' => 'uppercase',
    'url' => 'url',
    'ulid' => 'ulid',
    'uuid' => 'uuid',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap our attribute placeholder
    | with something more reader friendly such as "E-Mail Address" instead
    | of "email". This simply helps us make our message more expressive.
    |
    */

    'attributes' => [],

];
