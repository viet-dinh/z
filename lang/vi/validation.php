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

    'accepted' => 'Trường :attribute phải được chấp nhận.',
    'accepted_if' => 'Trường :attribute phải được chấp nhận khi :other là :value.',
    'active_url' => 'Trường :attribute phải là một URL hợp lệ.',
    'after' => 'Trường :attribute phải là một ngày sau :date.',
    'after_or_equal' => 'Trường :attribute phải là một ngày sau hoặc bằng :date.',
    'alpha' => 'Trường :attribute chỉ có thể chứa các chữ cái.',
    'alpha_dash' => 'Trường :attribute chỉ có thể chứa các chữ cái, số, dấu gạch ngang và dấu gạch dưới.',
    'alpha_num' => 'Trường :attribute chỉ có thể chứa các chữ cái và số.',
    'array' => 'Trường :attribute phải là một mảng.',
    'ascii' => 'Trường :attribute chỉ có thể chứa các ký tự và ký hiệu một byte.',
    'before' => 'Trường :attribute phải là một ngày trước :date.',
    'before_or_equal' => 'Trường :attribute phải là một ngày trước hoặc bằng :date.',
    'between' => [
        'array' => 'Trường :attribute phải có từ :min đến :max phần tử.',
        'file' => 'Trường :attribute phải có kích thước từ :min đến :max kilobytes.',
        'numeric' => 'Trường :attribute phải nằm giữa :min và :max.',
        'string' => 'Trường :attribute phải có từ :min đến :max ký tự.',
    ],
    'boolean' => 'Trường :attribute phải là đúng hoặc sai.',
    'can' => 'Trường :attribute chứa giá trị không hợp lệ.',
    'confirmed' => 'Xác nhận trường :attribute không khớp.',
    'contains' => 'Trường :attribute thiếu một giá trị cần thiết.',
    'current_password' => 'Mật khẩu không chính xác.',
    'date' => 'Trường :attribute phải là một ngày hợp lệ.',
    'date_equals' => 'Trường :attribute phải là một ngày bằng :date.',
    'date_format' => 'Trường :attribute phải khớp với định dạng :format.',
    'decimal' => 'Trường :attribute phải có :decimal chữ số thập phân.',
    'declined' => 'Trường :attribute phải bị từ chối.',
    'declined_if' => 'Trường :attribute phải bị từ chối khi :other là :value.',
    'different' => 'Trường :attribute và :other phải khác nhau.',
    'digits' => 'Trường :attribute phải là :digits chữ số.',
    'digits_between' => 'Trường :attribute phải nằm trong khoảng từ :min đến :max chữ số.',
    'dimensions' => 'Trường :attribute có kích thước hình ảnh không hợp lệ.',
    'distinct' => 'Trường :attribute có một giá trị trùng lặp.',
    'doesnt_end_with' => 'Trường :attribute không được kết thúc bằng một trong các giá trị sau: :values.',
    'doesnt_start_with' => 'Trường :attribute không được bắt đầu bằng một trong các giá trị sau: :values.',
    'email' => 'Trường :attribute phải là một địa chỉ email hợp lệ.',
    'ends_with' => 'Trường :attribute phải kết thúc bằng một trong các giá trị sau: :values.',
    'enum' => ':attribute được chọn không hợp lệ.',
    'exists' => ':attribute được chọn không hợp lệ.',
    'extensions' => 'Trường :attribute phải có một trong các phần mở rộng sau: :values.',
    'file' => 'Trường :attribute phải là một tập tin.',
    'filled' => 'Trường :attribute phải có giá trị.',
    'gt' => [
        'array' => 'Trường :attribute phải có nhiều hơn :value phần tử.',
        'file' => 'Trường :attribute phải lớn hơn :value kilobytes.',
        'numeric' => 'Trường :attribute phải lớn hơn :value.',
        'string' => 'Trường :attribute phải lớn hơn :value ký tự.',
    ],
    'gte' => [
        'array' => 'Trường :attribute phải có từ :value phần tử trở lên.',
        'file' => 'Trường :attribute phải lớn hơn hoặc bằng :value kilobytes.',
        'numeric' => 'Trường :attribute phải lớn hơn hoặc bằng :value.',
        'string' => 'Trường :attribute phải lớn hơn hoặc bằng :value ký tự.',
    ],
    'hex_color' => 'Trường :attribute phải là một màu hexadecimal hợp lệ.',
    'image' => 'Trường :attribute phải là một hình ảnh.',
    'in' => ':attribute được chọn không hợp lệ.',
    'in_array' => 'Trường :attribute phải tồn tại trong :other.',
    'integer' => 'Trường :attribute phải là một số nguyên.',
    'ip' => 'Trường :attribute phải là một địa chỉ IP hợp lệ.',
    'ipv4' => 'Trường :attribute phải là một địa chỉ IPv4 hợp lệ.',
    'ipv6' => 'Trường :attribute phải là một địa chỉ IPv6 hợp lệ.',
    'json' => 'Trường :attribute phải là một chuỗi JSON hợp lệ.',
    'list' => 'Trường :attribute phải là một danh sách.',
    'lowercase' => 'Trường :attribute phải là chữ thường.',
    'lt' => [
        'array' => 'Trường :attribute phải có ít hơn :value phần tử.',
        'file' => 'Trường :attribute phải nhỏ hơn :value kilobytes.',
        'numeric' => 'Trường :attribute phải nhỏ hơn :value.',
        'string' => 'Trường :attribute phải nhỏ hơn :value ký tự.',
    ],
    'lte' => [
        'array' => 'Trường :attribute không được có nhiều hơn :value phần tử.',
        'file' => 'Trường :attribute phải nhỏ hơn hoặc bằng :value kilobytes.',
        'numeric' => 'Trường :attribute phải nhỏ hơn hoặc bằng :value.',
        'string' => 'Trường :attribute phải nhỏ hơn hoặc bằng :value ký tự.',
    ],
    'mac_address' => 'Trường :attribute phải là một địa chỉ MAC hợp lệ.',
    'max' => [
        'array' => 'Trường :attribute không được có nhiều hơn :max phần tử.',
        'file' => 'Trường :attribute không được lớn hơn :max kilobytes.',
        'numeric' => 'Trường :attribute không được lớn hơn :max.',
        'string' => 'Trường :attribute không được lớn hơn :max ký tự.',
    ],
    'max_digits' => 'Trường :attribute không được có nhiều hơn :max chữ số.',
    'mimes' => 'Trường :attribute phải là tệp có định dạng: :values.',
    'mimetypes' => 'Trường :attribute phải là tệp có định dạng: :values.',
    'min' => [
        'array' => 'Trường :attribute phải có ít nhất :min phần tử.',
        'file' => 'Trường :attribute phải có ít nhất :min kilobytes.',
        'numeric' => 'Trường :attribute phải có ít nhất :min.',
        'string' => 'Trường :attribute phải có ít nhất :min ký tự.',
    ],
    'min_digits' => 'Trường :attribute phải có ít nhất :min chữ số.',
    'missing' => 'Trường :attribute phải bị thiếu.',
    'missing_if' => 'Trường :attribute phải bị thiếu khi :other là :value.',
    'missing_unless' => 'Trường :attribute phải bị thiếu trừ khi :other là :value.',
    'missing_with' => 'Trường :attribute phải bị thiếu khi :values có mặt.',
    'missing_with_all' => 'Trường :attribute phải bị thiếu khi :values có mặt.',
    'multiple_of' => 'Trường :attribute phải là bội số của :value.',
    'not_in' => ':attribute được chọn không hợp lệ.',
    'not_regex' => 'Định dạng của trường :attribute không hợp lệ.',
    'numeric' => 'Trường :attribute phải là một số.',
    'password' => [
        'letters' => 'Trường :attribute phải chứa ít nhất một chữ cái.',
        'mixed' => 'Trường :attribute phải chứa ít nhất một chữ hoa và một chữ thường.',
        'numbers' => 'Trường :attribute phải chứa ít nhất một số.',
        'symbols' => 'Trường :attribute phải chứa ít nhất một ký tự đặc biệt.',
        'uncompromised' => ':attribute đã xuất hiện trong một vụ rò rỉ dữ liệu. Vui lòng chọn một :attribute khác.',
    ],
    'present' => 'Trường :attribute phải có mặt.',
    'present_if' => 'Trường :attribute phải có mặt khi :other là :value.',
    'present_unless' => 'Trường :attribute phải có mặt trừ khi :other là :value.',
    'present_with' => 'Trường :attribute phải có mặt khi :values có mặt.',
    'present_with_all' => 'Trường :attribute phải có mặt khi :values có mặt.',
    'prohibited' => 'Trường :attribute bị cấm.',
    'prohibited_if' => 'Trường :attribute bị cấm khi :other là :value.',
    'prohibited_unless' => 'Trường :attribute bị cấm trừ khi :other nằm trong :values.',
    'prohibits' => 'Trường :attribute cấm :other có mặt.',
    'regex' => 'Định dạng của trường :attribute không hợp lệ.',
    'required' => 'Trường :attribute là bắt buộc.',
    'required_array_keys' => 'Trường :attribute phải chứa các mục nhập cho: :values.',
    'required_if' => 'Trường :attribute là bắt buộc khi :other là :value.',
    'required_if_accepted' => 'Trường :attribute là bắt buộc khi :other được chấp nhận.',
    'required_unless' => 'Trường :attribute là bắt buộc trừ khi :other nằm trong :values.',
    'required_with' => 'Trường :attribute là bắt buộc khi :values có mặt.',
    'required_with_all' => 'Trường :attribute là bắt buộc khi :values có mặt.',
    'required_without' => 'Trường :attribute là bắt buộc khi :values không có mặt.',
    'required_without_all' => 'Trường :attribute là bắt buộc khi không có giá trị nào trong :values có mặt.',
    'reset' => 'Trường :attribute đã được đặt lại.',
    'resized_image' => 'Trường :attribute phải có một kích thước hình ảnh hợp lệ.',
    'same' => 'Trường :attribute và :other phải trùng khớp.',
    'size' => [
        'array' => 'Trường :attribute phải chứa :size phần tử.',
        'file' => 'Trường :attribute phải là :size kilobytes.',
        'numeric' => 'Trường :attribute phải là :size.',
        'string' => 'Trường :attribute phải có :size ký tự.',
    ],
    'starts_with' => 'Trường :attribute phải bắt đầu bằng một trong các giá trị sau: :values.',
    'string' => 'Trường :attribute phải là một chuỗi.',
    'timezone' => 'Trường :attribute phải là một múi giờ hợp lệ.',
    'unique' => 'Trường :attribute đã tồn tại.',
    'uploaded' => 'Trường :attribute tải lên không thành công.',
    'uppercase' => 'Trường :attribute phải là chữ hoa.',
    'url' => 'Trường :attribute phải là một URL hợp lệ.',
    'uuid' => 'Trường :attribute phải là một UUID hợp lệ.',

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
