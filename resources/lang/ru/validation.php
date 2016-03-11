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

	"accepted"             => "Если Вы принимаете условия Договора оферты, Вы должны поставить галочку",
	"active_url"           => "The :attribute is not a valid URL.",
	"after"                => "The :attribute must be a date after :date.",
	"alpha"                => "The :attribute may only contain letters.",
	"alpha_dash"           => "В поле :attribute можно писать только буквы, цифры и тире.",
	"alpha_num"            => "The :attribute may only contain letters and numbers.",
	"array"                => "The :attribute must be an array.",
	"before"               => "The :attribute must be a date before :date.",
	"between"              => [
		"numeric" => "The :attribute must be between :min and :max.",
		"file"    => "The :attribute must be between :min and :max kilobytes.",
		"string"  => "The :attribute must be between :min and :max characters.",
		"array"   => "The :attribute must have between :min and :max items.",
	],
	"boolean"              => "The :attribute field must be true or false.",
	"confirmed"            => "Введенные значения в :attribute не совпадают.",
	"date"                 => "The :attribute is not a valid date.",
	"date_format"          => "The :attribute does not match the format :format.",
	"different"            => "The :attribute and :other must be different.",
	"digits"               => "The :attribute must be :digits digits.",
	"digits_between"       => "The :attribute must be between :min and :max digits.",
	"email"                => "The :attribute must be a valid email address.",
	"filled"               => "The :attribute field is required.",
	"exists"               => "The selected :attribute is invalid.",
	"image"                => "The :attribute must be an image.",
	"in"                   => "The selected :attribute is invalid.",
	"integer"              => "Значение в поле :attribute должно быть цифрой.",
	"ip"                   => "The :attribute must be a valid IP address.",
	"max"                  => [
		"numeric" => "The :attribute may not be greater than :max.",
		"file"    => "The :attribute may not be greater than :max kilobytes.",
		"string"  => "В поле :attribute не должно быть больше :max символов.",
		"array"   => "The :attribute may not have more than :max items.",
	],
//	"mimes"                => "The :attribute must be a file of type: :values.",
	"mimes"                => "Загружаемый файл должен быть в формате PDF или картинкой",
	"min"                  => [
		"numeric" => "The :attribute must be at least :min.",
		"file"    => "The :attribute must be at least :min kilobytes.",
		"string"  => "В поле :attribute должно быть введено значение, состоящее как минимум из :min сиволов.",
		"array"   => "The :attribute must have at least :min items.",
	],
	"not_in"               => "The selected :attribute is invalid.",
	"numeric"              => "В поле :attribute допускается писать только цифры, разделитель дробных знаков - точка.",
	"regex"                => "The :attribute format is invalid.",
	"required"             => "Поле :attribute должно быть заполнено.",
	"required_if"          => "The :attribute field is required when :other is :value.",
	"required_with"        => "The :attribute field is required when :values is present.",
	"required_with_all"    => "The :attribute field is required when :values is present.",
	"required_without"     => "The :attribute field is required when :values is not present.",
	"required_without_all" => "The :attribute field is required when none of :values are present.",
	"same"                 => "The :attribute and :other must match.",
	"size"                 => [
		"numeric" => "The :attribute must be :size.",
		"file"    => "The :attribute must be :size kilobytes.",
		"string"  => "The :attribute must be :size characters.",
		"array"   => "The :attribute must contain :size items.",
	],
	"string"               => "The :attribute must be a string.",
	"unique"               => "Такое название :attribute уже есть в базе данных.",
	"url"                  => "The :attribute format is invalid.",
	"timezone"             => "The :attribute must be a valid zone.",
	"alpha_spaces"         => "В поле :attribute допускается писать только буквы и пробел.",
	"alpha_spaces_numbers" => "В поле :attribute допускается писать только буквы, цифры и пробел.",
	"alpha_spaces_numbers_etc" => "В поле :attribute допускается писать только буквы, цифры, пробел и некоторые символы.",
	"chars_numbers_spaces" => "В поле :attribute допускается писать только буквы, цифры и пробел",
	"only_numbers_like_string" => "В поле :attribute допускается писать только цифры",
	"chars_numbers_spaces_dot" => "В поле :attribute допускается писать только буквы, цифры, пробел и точку",
	"chars_numbers_spaces_dot_numberSymbol" => "В поле :attribute допускается писать только буквы, цифры, пробел, точку и №",
	"numbers_brackets_defis_spaces" => "В поле :attribute допускается писать только цифры, скобки, дефис и пробел",

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
	| The following language lines are used to swap attribute place-holders
	| with something more reader friendly such as E-Mail Address instead
	| of "email". This simply helps us make messages a little cleaner.
	|
	*/

	'attributes' => [],

];
