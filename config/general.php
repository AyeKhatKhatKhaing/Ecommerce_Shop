<?php

return [

    'captcha_secret'  => env('NOCAPTCHA_SECRET', null),
    'captcha_sitekey' => env('NOCAPTCHA_SITEKEY', null),

    'currency_type'   => [
        "HK$" => "HK$",
        "MOP" => "MOP",
    ],

    'account_type'    => [
        "individual" => "Individual Account",
        "company"    => "Company Account",
    ],

    'amount_type'     => [
        "0" => "Amount",
        "1" => "Percent",
    ],

    'country_type'    => [
        "hk" => "Hong Kong",
        "ma" => "Macau",
    ],

    'coupon_type'     => [
        "new"     => "Member Welcome Coupon",
        "tier"    => "Member Tier Upgrade Coupon",
        "product" => "Product Coupon",
    ],

    'discount_type'   => [
        "amount"     => "Amount",
        "percentage" => "Percentage",
    ],

    'menu_type'       => [
        "category"  => "Category",
        "promotion" => "Promotion",
    ],

    'recon_payment'         => [
        'visa'      => 'Visa',
        'master'    => 'Master',
        'upop'      => 'Unionpay',
        'alipay_hk' => 'AlipayHK',
        'alipay'    => 'Alipay',
        'wechat'    => 'Wechat',
    ],

    // 'country_codes' => [
    //     'Hong Kong (+852)' => 'Hong Kong (+852)',
    //     'Chine (+86)' => 'Chine (+86)',
    //     'Singapore (+65)' => 'Singapore (+65)',
    //     'Malaysia (+60)' => 'Malaysia (+60)',
    //     'Myanmar (+95)' => 'Myanmar (+95)',
    // ],

    "hant_codes"      => [
        852 => "香港 (+852)",
        853 => "澳門 (+853)",
        86  => "中國 (+86)",
        54  => "阿根廷 (+54)",
        1   => "加拿大 (+1)",
        1   => "美國 (+1)",
        81  => "日本 (+81)",
        82  => "韓國 (+82)",
        886 => "台灣 (+886)",
        32  => "比利時 (+32)",
        49  => "德國 (+49)",
        30  => "希臘 (+30)",
        39  => "意大利 (+39)",
        41  => "瑞士 (+41)",
        354 => "冰島 (+354)",
        31  => "荷蘭 (+31)",
        353 => "愛爾蘭 (+353)",
        47  => "挪威 (+47)",
        43  => "奧地利 (+43)",
        358 => "芬蘭/奧蘭群島 (+358)",
        48  => "波蘭 (+48)",
        33  => "法國 (+33)",
        593 => "厄瓜多爾 (+593)",
        359 => "保加利亞 (+359)",
        95  => 'Myanmar (+95)',
    ],

    "en_codes"        => [
        852 => "Hong Kong (+852)",
        853 => "Macau (+853)",
        86  => "China (+86)",
        54  => "Argentina (+54)",
        1   => "Canada (+1)",
        1   => "United States (+1)",
        81  => "Japan (+81)",
        82  => "Korea Republic of (+82)",
        886 => "Taiwan (+886)",
        32  => "Belgium (+32)",
        49  => "Germany (+49)",
        30  => "Greece (+30)",
        39  => "Italy (+39)",
        41  => "Switzerland (+41)",
        354 => "Iceland (+354)",
        31  => "Netherlands (+31)",
        353 => "Ireland (+353)",
        47  => "Norway (+47)",
        43  => "Austria (+43)",
        358 => "Finland/Aland Islands (+358)",
        48  => "Poland (+48)",
        33  => "France (+33)",
        593 => "Ecuador (+593)",
        359 => "Bulgaria (+359)",
        95  => 'Myanmar (+95)',
    ],

    "hans_codes"      => [
        852 => "香港 (+852)",
        853 => "澳门 (+853)",
        86  => "中国 (+86)",
        54  => "阿根廷 (+54)",
        1   => "加拿大 (+1)",
        1   => "美国 (+1)",
        81  => "日本 (+81)",
        82  => "韩国 (+82)",
        886 => "台湾 (+886)",
        32  => "比利时 (+32)",
        49  => "德国 (+49)",
        30  => "希腊 (+30)",
        39  => "意大利 (+39)",
        41  => "瑞士 (+41)",
        354 => "冰岛 (+354)",
        31  => "荷兰 (+31)",
        353 => "爱尔兰 (+353)",
        47  => "挪威 (+47)",
        43  => "奥地利 (+43)",
        358 => "芬兰/奥兰群岛 (+358)",
        48  => "波兰 (+48)",
        33  => "法国 (+33)",
        593 => "厄瓜多尔 (+593)",
        359 => "保加利亚 (+359)",
        95  => 'Myanmar (+95)',
    ],
];
