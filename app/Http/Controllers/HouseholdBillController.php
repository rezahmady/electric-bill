<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class HouseholdBillController extends Controller
{
    public $subscription; // آبونمان
    public $insurance; // بیمه
    public $complications; // عوارض
    public $consumption_ratio = [
        'none_tropical' => 1,
        'tropical0' => 1,
        'tropical1' => 4,
        'tropical2' => 3,
        'tropical3' => 2,
        'tropical4' => 1.3,
    ];
    public $type;
    public $tropical;
    
    public $intermediate;
    public $peak;
    public $low;
    public $base_price = 0;
    public $sum_durations_with_ratio = 0;
    public $sum_durations;
    public $price_peak = 0; // اضافه پرداخت اوج بار
    public $price_low = 0; // کسورات مصارف غیر اوج باری
    public $encouragement_ratio = [
        'none_tropical' => 1,
        'tropical0' => 1,
        'tropical1' => 1/3,
        'tropical2' => 2/3,
        'tropical3' => 2/3,
        'tropical4' => 2/3,
    ];
    public $result = false;
    public $table = [];
    public $tariff = [
        // مشترکین دارای مصرف متعارف
        1 => [
            // مناطق عادی و ماه های غیرگرم مناطق گرمسیر
            'none_tropical' => [
                [
                    'min' => 0,
                    'max' => 100,
                    'price' => 600
                ],
                [
                    'min' => 100,
                    'max' => 200,
                    'price' => 700
                ],
                [
                    'min' => 200,
                    'max' => 300,
                    'price' => 1500
                ],
            ],
            'tropical0' => [
                [
                    'min' => 0,
                    'max' => 100,
                    'price' => 600
                ],
                [
                    'min' => 100,
                    'max' => 200,
                    'price' => 700
                ],
                [
                    'min' => 200,
                    'max' => 300,
                    'price' => 1500
                ],
            ],
            // ماه های گرم در مناطق گرمسیر ۱
            'tropical1' => [
                [
                    'min'   => 0,
                    'max'   => 1000,
                    'price' => 200,
                ],
                [
                    'min'   => 1000,
                    'max'   => 200,
                    'price' => 223,
                ],
                [
                    'min'   => 2000,
                    'max'   => 3000,
                    'price' => 241,
                ],
            ],
            // ماه های گرم در مناطق گرمسیر ۲
            'tropical2' => [
                [
                    'min'   => 0,
                    'max'   => 1000,
                    'price' => 441,
                ],
                [
                    'min'   => 1000,
                    'max'   => 2000,
                    'price' => 999,
                ],
            ],
            // ماه های گرم در مناطق گرمسیر ۳
            'tropical3' => [
                [
                    'min'   => 0,
                    'max'   => 1000,
                    'price' => 501,
                ],
            ],
            // ماه های گرم در مناطق گرمسیر ۴
            'tropical4' => [
                [
                    'min'   => 0,
                    'max'   => 100,
                    'price' => 482,
                ],
                [
                    'min'   => 100,
                    'max'   => 200,
                    'price' => 561,
                ],
                [
                    'min'   => 200,
                    'max'   => 300,
                    'price' => 999,
                ],
                [
                    'min'   => 300,
                    'max'   => 400,
                    'price' => 1599,
                ],
            ],
        ],
        // مشترکین پرمصرق
        2 => [
            // مناطق عادی و ماه های غیرگرم مناطق گرمسیر
            'none_tropical' => [
                [
                    'min'   => 0,
                    'max'   => 100,
                    'price' => 913,
                ],
                [
                    'min'   => 100,
                    'max'   => 200,
                    'price' => 1061,
                ],
                [
                    'min'   => 200,
                    'max'   => 300,
                    'price' => 2278,
                ],
                [
                    'min'   => 300,
                    'max'   => 400,
                    'price' => 4100,
                ],
                [
                    'min'   => 400,
                    'max'   => 500,
                    'price' => 4710,
                ],
                [
                    'min'   => 500,
                    'max'   => 600,
                    'price' => 5025,
                ],
                [
                    'min'   => 600,
                    'max'   => null,
                    'price' => 6534,
                ],
            ],
            'tropical0' => [
                [
                    'min'   => 0,
                    'max'   => 100,
                    'price' => 913,
                ],
                [
                    'min'   => 100,
                    'max'   => 200,
                    'price' => 1061,
                ],
                [
                    'min'   => 200,
                    'max'   => 300,
                    'price' => 2278,
                ],
                [
                    'min'   => 300,
                    'max'   => 400,
                    'price' => 4100,
                ],
                [
                    'min'   => 400,
                    'max'   => 500,
                    'price' => 4710,
                ],
                [
                    'min'   => 500,
                    'max'   => 600,
                    'price' => 5025,
                ],
                [
                    'min'   => 600,
                    'max'   => null,
                    'price' => 6534,
                ],
            ],
            // ماه های گرم در مناطق گرمسیر ۱
            'tropical1' => [
                [
                    'min'   => 0,
                    'max'   => 1000,
                    'price' => 305,
                ],
                [
                    'min'   => 1000,
                    'max'   => 2000,
                    'price' => 337,
                ],
                [
                    'min'   => 2000,
                    'max'   => 3000,
                    'price' => 364,
                ],
                [
                    'min'   => 3000,
                    'max'   => 3500,
                    'price' => 1519,
                ],
                [
                    'min'   => 3500,
                    'max'   => 4500,
                    'price' => 2736,
                ],
                [
                    'min'   => 4500,
                    'max'   => 6000,
                    'price' => 3494,
                ],
                [
                    'min'   => 6000,
                    'max'   => null,
                    'price' => 4100,
                ],
            ],
            // ماه های گرم در مناطق گرمسیر ۲
            'tropical2' => [
                [
                    'min'   => 0,
                    'max'   => 1000,
                    'price' => 670,
                ],
                [
                    'min'   => 1000,
                    'max'   => 2000,
                    'price' => 1519,
                ],
                [
                    'min'   => 2000,
                    'max'   => 3000,
                    'price' => 2583,
                ],
                [
                    'min'   => 3000,
                    'max'   => 3500,
                    'price' => 3189,
                ],
                [
                    'min'   => 3500,
                    'max'   => 4500,
                    'price' => 3801,
                ],
                [
                    'min'   => 4500,
                    'max'   => 6000,
                    'price' => 4100,
                ],
                [
                    'min'   => 6000,
                    'max'   => null,
                    'price' => 4407,
                ],
            ],
            // ماه های گرم در مناطق گرمسیر ۳
            'tropical3' => [
                [
                    'min'   => 0,
                    'max'   => 1000,
                    'price' => 759,
                ],
                [
                    'min'   => 1000,
                    'max'   => 1500,
                    'price' => 1978,
                ],
                [
                    'min'   => 1500,
                    'max'   => 2000,
                    'price' => 3494,
                ],
                [
                    'min'   => 2000,
                    'max'   => 3500,
                    'price' => 3801,
                ],
                [
                    'min'   => 3500,
                    'max'   => 4500,
                    'price' => 4100,
                ],
                [
                    'min'   => 4500,
                    'max'   => 6000,
                    'price' => 4407,
                ],
                [
                    'min'   => 6000,
                    'max'   => null,
                    'price' => 4710,
                ],
            ],
            // ماه های گرم در مناطق گرمسیر ۴
            'tropical4' => [
                [
                    'min'   => 0,
                    'max'   => 100,
                    'price' => 731,
                ],
                [
                    'min'   => 100,
                    'max'   => 200,
                    'price' => 851,
                ],
                [
                    'min'   => 200,
                    'max'   => 300,
                    'price' => 1519,
                ],
                [
                    'min'   => 300,
                    'max'   => 400,
                    'price' => 2428,
                ],
                [
                    'min'   => 400,
                    'max'   => 500,
                    'price' => 3494,
                ],
                [
                    'min'   => 500,
                    'max'   => 600,
                    'price' => 4557,
                ],
                [
                    'min'   => 600,
                    'max'   => null,
                    'price' => 5469,
                ],
            ],
        ],
    ];

    public function index(Request $request) {

        $validation = Validator::make($request->all(),[ 
            'type' => 'required|in:0,1,2,3,4',
            'none_tropical' => 'numeric',
            'tropical' => 'numeric',
            'intermediate' => 'required|numeric',
            'peak' => 'required|numeric',
            'low' => 'required|numeric',
        ],[],[
            'type' => 'نوع منطقه',
            'none_tropical' => 'ایام غیرگرم',
            'tropical' => 'ایام گرم',
            'intermediate' => 'میان باری',
            'peak' => 'اوج باری',
            'low' => 'کم باری',
        ]);
    
        if($validation->fails()){
            $errors = $validation->errors();
            return $errors->toJson();
        }

        $this->table = [];
        $this->price_low = $this->price_peak = $this->sum_durations_with_ratio = $this->base_price = $this->sum_durations = 0;
        
        $form = $request->all();

        $this->type = $form['type'];
        $this->tropical = $form['tropical'];

        $durations = [
            'none_tropical' => $form['none_tropical'] ?? 0,
            'tropical'.$form['type'] => $form['tropical'] ?? 0,
        ];

        foreach($durations as $key => $duration) {
            $this->sum_durations += $duration;
            $this->sum_durations_with_ratio += $duration*$this->consumption_ratio[$key];
        }

        $this->intermediate = $form['intermediate'];
        $this->peak = $form['peak'];
        $this->low = $form['low'];

        foreach($durations as $key => $duration) {
            if($duration > 0) $this->perPeriod($duration, $key);
        }

        // بهای پایه
        $base_price = $this->base_price;

        // بیمه
        $insurance = $this->sum_durations*100/3;

        // عوارض
        $complications = floor(($base_price + $this->price_peak - $this->price_low)/10);

        // آبونمان
        $subscription = 11770*$this->sum_durations/30;

        // مالیات
        $tax = 9/100*($base_price + $this->price_peak - $this->price_low + $subscription);

        // مبلغ صورت حساب
       $final_price = $base_price + $this->price_peak - $this->price_low + $insurance + $complications + $tax + $subscription;

       $this->tax = number_format(round($tax));
       $this->subscription = number_format(round($subscription));
       $this->insurance = number_format(round($insurance));
       $this->complications = number_format(round($complications));
       $this->final_price = number_format(round($final_price));
       $this->price_peak = number_format(round($this->price_peak));
       $this->price_low = number_format(round($this->price_low));
       $this->base_price = number_format(round($this->base_price));
       $this->durations = $durations;


       $result = [
           'table1' => [
               'head' => [
                   'نرخ',
                   'روزهای اوج بار',
                   'روزهای عادی',
                   'كل مصرف',
                   'متوسط ماهانه مصرف(kwh)',
               ],
               'body' => $this->getTable1()
            ],
            'table2' => [
                'head' => [
                    '',
                    'كنتور میان باری(kwh)',
                    'كنتور اوج بار(kwh)',
                    'كنتور كم باری(kwh)'
                ],
                'body' => [
                    'مصرف',
                    $this->intermediate,
                    $this->peak,
                    $this->low                    
                ]
            ],
            'invoice' => [
                [
                    'title' => 'بهای پایه',
                    'value' => $this->base_price,
                ],
                [
                    'title' => 'اضافه پرداختی مصارف اوج بار',
                    'value' => $this->price_peak,
                ],
                [
                    'title' => 'کسورات مصارف غیر اوج بار',
                    'value' => $this->price_low,
                ],
                [
                    'title' => 'بیمه',
                    'value' => $this->insurance,
                ],
                [
                    'title' => 'عوارض برق',
                    'value' => $this->complications,
                ],
                [
                    'title' => 'مالیات بر ارزش افزوده',
                    'value' => $this->tax,
                ],
                [
                    'title' => 'آبونمان',
                    'value' => $this->subscription,
                ],
                [
                    'title' => 'مبلغ صورتحساب',
                    'value' => $this->final_price,
                ]
            ],
            'more_tables' => $this->getMoreTables()

       ];

       return response()->json($result);
    }

    public function getTable1() {
        $table = [];
        foreach($this->table as $key => $row) {
            $table[$key] = [];
            array_push($table[$key], $row['label']);
            if($this->type === '0' and $this->tropical !== null) {
                if($row['label'] === 'عادی غیرگرم') {
                    array_push($table[$key], ' - ', $row['duration']);
                } else {
                    array_push($table[$key], $this->tropical , ' - ');
                }
            } else {
                if($row['label'] === 'عادی غیرگرم') {
                    array_push($table[$key], ' - ', $row['duration']);
                } else {
                    array_push($table[$key], $row['duration'] , ' - ');
                }
            }
            array_push($table[$key], $row['consumption']);
            array_push($table[$key], $row['monthly_consumption']);
        }

        return $table;
    }

    public function getMoreTables() {
        $table = [];
        foreach($this->table as $key => $item) {
            $body = [];
            foreach($item['tariff'] as $row) {
                $body[] = [
                    "از ".$row['min']." تا ".$row['max']." کیلوواتساعت",
                    $row['price'],
                    $row['consumption'],
                    $row['monthly_consumption']
                ];
            }

            $table[$key] = [
                'title' => "تعرفه ".$item['label']." بمدت ".$item['duration']." روز",
                'head' => [
                    'پله های مصرف',
                    'نرخ (ریال)',
                    'متوسط ماهانه مصرف',
                    'مبلغ ماهانه'
                ],
                'body' => $body
            ];
        }
        return $table;
    }

    public function perPeriod($duration, $key) {

        $percent = $duration*$this->consumption_ratio[$key]/$this->sum_durations_with_ratio;

        $total_consumption = $percent*($this->intermediate + $this->peak + $this->low);

        // متوسط مصرف ماهانه
        $average_consumption = $total_consumption/$duration*30;
        
        // نوع مشتری
        $customer_type = $this->getCustomerType($average_consumption, $key);
        // if($key === 'tropical0') dd($key, $total_consumption, $customer_type);

        $label = ($key === 'none_tropical') ? 'عادی غیرگرم' : 'گرمسیری';
        if($key === 'tropical0') $label = 'عادی گرم';

        $this->table[$key] = [
            'label' => $label,
            'duration' => $duration,
            'consumption' => round($total_consumption, 2),
            'monthly_consumption' => round($total_consumption*30/$duration, 2)
        ];

        // اضافه پرداخت اوج بار
        $peak = $this->peak*$this->encouragement_ratio[$key]*$percent;
        $peak = ($customer_type === 1) ? $peak*600 : $peak*913;
        $this->price_peak += $peak;

        // کسورات مصارف غیر اوج باری
        $low = $this->low*$this->encouragement_ratio[$key]*$percent;
        $low = ($customer_type === 1) ? $low*300 : $low*456.5;
        $this->price_low += $low;

        // بهای پایه ماهانه
        $month_base_price = $this->getBasePrice($average_consumption, $key);

        // بهای پایه
        $this->base_price += $month_base_price/30*$duration;
    }

    public function getBasePrice($average_consumption, $key) {
        $customer_type = $this->getCustomerType($average_consumption, $key);

        $tariff = $this->tariff[$customer_type][$key];
        $size = sizeof($tariff);
        $MBP = 0;

        $tarif_table = $tariff;
        foreach($tariff as $id => $item) {
            if ((($id === $size-1) && ($average_consumption >= $item['min'])) || ($average_consumption >= $item['min'] && $average_consumption < $item['max'])) {
                
                if($id === 0) {
                    $MBP += $tariff[$id]['price']*$average_consumption;
                    $tarif_table[$id]['consumption'] = round($average_consumption, 2);
                    $tarif_table[$id]['monthly_consumption'] = number_format(round($tariff[$id]['price']*$average_consumption));
                } else {
                    for($i = 0; $i< $id; $i++) {
                        $MBP += $tariff[$i]['price']*($tariff[$i]['max'] - $tariff[$i]['min']);
                        $tarif_table[$i]['consumption'] = $tariff[$i]['max'] - $tariff[$i]['min'];
                        $tarif_table[$i]['monthly_consumption'] = number_format(round($tariff[$i]['price']*($tariff[$i]['max'] - $tariff[$i]['min'])));
                    }
                    $MBP += $tariff[$id]['price']*($average_consumption - $tariff[$id]['min']);
                    $tarif_table[$id]['consumption'] = round($average_consumption - $tariff[$id]['min'], 2);
                    $tarif_table[$id]['monthly_consumption'] = number_format(round($tariff[$id]['price']*($average_consumption - $tariff[$id]['min'])));
                }
            } else {
                $tarif_table[$id]['consumption'] = '';
                $tarif_table[$id]['monthly_consumption'] = '';
            }
        }
        $this->table[$key]['tariff'] = $tarif_table;
        return $MBP;
    }

    public function getCustomerType($consumption, $key) {
        switch ($key) {
            case 'none_tropical':
                $customer_type = ($consumption > 200) ? 2 : 1;
                break;
            case 'tropical0':
                $customer_type = ($consumption > 300) ? 2 : 1;
                break;
            case 'tropical1':
                $customer_type = ($consumption > 3000) ? 2 : 1;
                break;
            case 'tropical2':
                $customer_type = ($consumption > 2000) ? 2 : 1;
                break;
            case 'tropical3':
                $customer_type = ($consumption > 1000) ? 2 : 1;
                break;
            case 'tropical4':
                $customer_type = ($consumption > 400) ? 2 : 1;
                break;

            }

        return $customer_type;
    }
}
