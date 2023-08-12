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
    'accepted'         => ':attribute debe ser aceptado.',
    'active_url'       => ':attribute no es una URL válida.',
    'accepted_if' => 'El campo :attribute debe aceptarse cuando :other es :value.',
    'after' => 'The :attribute field must be a date after :date.',
    'after_or_equal' => 'The :attribute field must be a date after or equal to :date.',
    'after'            => ':attribute debe ser una fecha posterior a :date.',
    'alpha'            => ':attribute solo debe contener letras.',
    'alpha_dash'       => ':attribute solo debe contener letras, números y guiones.',
    'alpha_num'        => ':attribute solo debe contener letras y números.',
    'array'            => ':attribute debe ser un conjunto.',
    'ascii' => 'El campo :attribute solo debe contener símbolos y caracteres alfanuméricos de un solo byte.',
    'before'           => ':attribute debe ser una fecha anterior a :date.',
    'before_or_equal' => 'El campo :attribute debe ser una fecha anterior o igual a :date.',
    'between' => [
        'array'   => ':attribute tiene que tener entre :min - :max ítems.',
        'file'    => ':attribute debe pesar entre :min - :max kilobytes.',
        'numeric' => ':attribute tiene que estar entre :min - :max.',
        'string'  => ':attribute tiene que tener entre :min - :max caracteres.',
    ],
    'boolean'          => 'El campo :attribute debe tener un valor verdadero o falso.',
    'confirmed'        => 'La confirmación de :attribute no coincide.',
    'current_password' => 'The password is incorrect.',
    'date'             => ':attribute no es una fecha válida.',
    'date_equals' => 'The :attribute field must be a date equal to :date.',
    'date_format'      => ':attribute no corresponde al formato :format.',
    'decimal' => 'The :attribute field must have :decimal decimal places.',
    'declined' => 'The :attribute field must be declined.',
    'declined_if' => 'The :attribute field must be declined when :other is :value.',
    'different'        => ':attribute y :other deben ser diferentes.',
    'digits'           => ':attribute debe tener :digits dígitos.',
    'digits_between'   => ':attribute debe tener entre :min y :max dígitos.',
    'dimensions' => 'El :attribute tiene dimensiones de imagen no válidas.',
    'distinct' => 'The :attribute field has a duplicate value.',
    'doesnt_end_with' => 'The :attribute field must not end with one of the following: :values.',
    'doesnt_start_with' => 'The :attribute field must not start with one of the following: :values.',
    'email'            => ':attribute no es un correo válido',
    'ends_with' => 'The :attribute field must end with one of the following: :values.',
    'enum' => 'The selected :attribute is invalid.',
    'exists'           => ':attribute es inválido.',
    'file' => 'The :attribute field must be a file.',
    'filled'           => 'El campo :attribute es obligatorio.',
    'gt' => [
        'array' => 'The :attribute field must have more than :value items.',
        'file' => 'The :attribute field must be greater than :value kilobytes.',
        'numeric' => 'The :attribute field must be greater than :value.',
        'string' => 'The :attribute field must be greater than :value characters.',
    ],
    'gte' => [
        'array' => 'The :attribute field must have :value items or more.',
        'file' => 'The :attribute field must be greater than or equal to :value kilobytes.',
        'numeric' => 'The :attribute field must be greater than or equal to :value.',
        'string' => 'The :attribute field must be greater than or equal to :value characters.',
    ],
    'image'            => ':attribute debe ser una imagen.',

    'in'               => ':attribute es inválido.',
    'in_array' => 'The :attribute field must exist in :other.',
    'integer'          => ':attribute debe ser un número entero.',
    'ip'               => ':attribute debe ser una dirección IP válida.',
    'ipv4' => 'The :attribute field must be a valid IPv4 address.',
    'ipv6' => 'The :attribute field must be a valid IPv6 address.',
    'json' => 'The :attribute field must be a valid JSON string.',
    'lowercase' => 'The :attribute field must be lowercase.',
    'lt' => [
        'array' => 'The :attribute field must have less than :value items.',
        'file' => 'The :attribute field must be less than :value kilobytes.',
        'numeric' => 'The :attribute field must be less than :value.',
        'string' => 'The :attribute field must be less than :value characters.',
    ],
    'lte' => [
        'array' => 'The :attribute field must not have more than :value items.',
        'file' => 'The :attribute field must be less than or equal to :value kilobytes.',
        'numeric' => 'The :attribute field must be less than or equal to :value.',
        'string' => 'The :attribute field must be less than or equal to :value characters.',
    ],
    'mac_address' => 'The :attribute field must be a valid MAC address.',
    'max' => [
        'array'   => ':attribute no debe tener más de :max elementos.',
        'file'    => ':attribute no debe ser mayor que :max kilobytes.',
        "numeric" => ":attribute no debe ser mayor a :max.",
        "string"  => ":attribute no debe ser mayor que :max caracteres.",
    ],
    'max_digits' => 'The :attribute field must not have more than :max digits.',
    "mimes"            => ":attribute debe ser un archivo con formato: :values.",
    'mimetypes' => 'The :attribute field must be a file of type: :values.',
    'min' => [
        "array"   => ":attribute debe tener al menos :min elementos.",
        "file"    => "El tamaño de :attribute debe ser de al menos :min kilobytes.",
        "numeric" => "El tamaño de :attribute debe ser de al menos :min.",
        "string"  => ":attribute debe contener al menos :min caracteres.",
    ],
    'min_digits' => 'The :attribute field must have at least :min digits.',
    'missing' => 'The :attribute field must be missing.',
    'missing_if' => 'The :attribute field must be missing when :other is :value.',
    'missing_unless' => 'The :attribute field must be missing unless :other is :value.',
    'missing_with' => 'The :attribute field must be missing when :values is present.',
    'missing_with_all' => 'The :attribute field must be missing when :values are present.',
    'multiple_of' => 'The :attribute field must be a multiple of :value.',
    "not_in"           => ":attribute es inválido.",
    'not_regex' => 'The :attribute field format is invalid.',
    "numeric"          => ":attribute debe ser numérico.",
    'password' => [
        'letters' => 'The :attribute field must contain at least one letter.',
        'mixed' => 'The :attribute field must contain at least one uppercase and one lowercase letter.',
        'numbers' => 'The :attribute field must contain at least one number.',
        'symbols' => 'The :attribute field must contain at least one symbol.',
        'uncompromised' => 'The given :attribute has appeared in a data leak. Please choose a different :attribute.',
    ],
    'present' => 'The :attribute field must be present.',
    'prohibited' => 'The :attribute field is prohibited.',
    'prohibited_if' => 'The :attribute field is prohibited when :other is :value.',
    'prohibited_unless' => 'The :attribute field is prohibited unless :other is in :values.',
    'prohibits' => 'The :attribute field prohibits :other from being present.',
    "regex"            => "El formato de :attribute es inválido.",
    "required"         => "El campo :attribute es obligatorio.",
    'required_array_keys' => 'The :attribute field must contain entries for: :values.',
    "required_if"      => "El campo :attribute es obligatorio cuando :other es :value.",
    'required_if_accepted' => 'The :attribute field is required when :other is accepted.',
    'required_unless' => 'The :attribute field is required unless :other is in :values.',
    "required_with"    => "El campo :attribute es obligatorio cuando :values está presente.",
    "required_with_all" => "El campo :attribute es obligatorio cuando :values está presente.",
    "required_without" => "El campo :attribute es obligatorio cuando :values no está presente.",
    "required_without_all" => "El campo :attribute es obligatorio cuando ninguno de :values estén presentes.",
    "same"             => ":attribute y :other deben coincidir.",
    'size' => [
        "array"   => ":attribute debe contener :size elementos.",
        "file"    => "El tamaño de :attribute debe ser :size kilobytes.",
        "numeric" => "El tamaño de :attribute debe ser :size.",
        "string"  => ":attribute debe contener :size caracteres.",
    ],
    'starts_with' => 'The :attribute field must start with one of the following: :values.',
    "string"           => "The :attribute must be a string.",
    "timezone"         => "El :attribute debe ser una zona válida.",
    "unique"           => ":attribute ya ha sido registrado.",
    'uploaded' => 'The :attribute failed to upload.',
    'uppercase' => 'The :attribute field must be uppercase.',
    "url"              => "El formato :attribute es inválido.",
    'ulid' => 'The :attribute field must be a valid ULID.',
    'uuid' => 'The :attribute field must be a valid UUID.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention 'attribute.rule' to name the lines. This makes it quick to
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
    | with something more reader friendly such as 'E-Mail Address' instead
    | of 'email'. This simply helps us make our message more expressive.
    |
    */

    'attributes' => [
        'firstName' => 'primer nombre',
        'secondName' => 'segundo nombre',
        'firstLastName' => 'primer apellido',
        'secondLastName' => 'segundo apellido',
        'marriedLastName' => 'apellido casad@',
        'birthDate' => 'fecha de nacimiento',
        'dpi' => 'DPI',
        'profession' => 'profesión',
        'photo' => 'fotografía',
        'yearsWorking' => 'años laborados',
        'salary' => 'salario',
        'email' => 'correo electrónico',
        'password'=> 'contraseña',
        'currentPassword' => 'contraseña actual',
        'newPassword' => 'contraseña nueva',

        'name' => 'nombre',
        'description' => 'descripción',
        'type' => 'tipo',
        'required' => 'requerido',
        'form_assignment_group' => 'grupo de asignación',
        'user_id' => 'usuario',
        'digitalSignature' => 'firma digital',
        'form_id' => 'tipo de formulario',

        //signing credential
        'signingCredential.username_signing' => 'Usuario de firma',
        'signingCredential.password_signing' => 'Contraseña de firma',
        'signature_type_id' => 'tipo de firma',

        'user.dpi' => 'DPI',
        'user.phone' => 'teléfono',

        //document
        'document.name' => 'nombre del documento',
        'document.review_group_id' => 'grupo de revisión',
        'document.webhook'  => 'webhook'
    ],

];
