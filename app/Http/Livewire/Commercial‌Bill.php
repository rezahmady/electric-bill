<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Filament\Forms;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Section;

class Commercial‌Bill extends Component implements Forms\Contracts\HasForms 
{

    use Forms\Concerns\InteractsWithForms; 

    public $tariff; // تعرفه ها
    public $subscription; // آبونمان
    public $insurance; // بیمه
    public $season_price = 0;  // بهای فصل
    public $complications; // عوارض
    public $consumption_ratio; // بند ۱-۷
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
    public $encouragement_ratio = []; // بند ۱-۱
    public $result = false;
    public $table = [];
 
    public function mount(): void
    {
        $this->form->fill();

        // $this->subscription = 11770;

        // بند ۱-۷
        $this->consumption_ratio = [
            'none_tropical' => 1,
            'tropical1' => 2,
            'tropical2' => 2,
            'tropical3' => 2,
        ];

        // بند ۱-۱
        $this->encouragement_ratio = [
            'none_tropical' => 1,
            'tropical1' => 2/3,
            'tropical2' => 2/3,
            'tropical3' => 2/3,
        ];

        // پله های مصرف
        $this->tariff = [
            // مشترکین دارای مصرف متعارف
            1 => [],
            // مشترکین پرمصرق
            2 => [
                // مناطق عادی و ماه های غیرگرم مناطق گرمسیر
                'none_tropical' => [
                    [
                        'min'   => 0,
                        'max'   => 100,
                        'price' => 2401,
                    ],
                    [
                        'min'   => 100,
                        'max'   => 200,
                        'price' => 2508,
                    ],
                    [
                        'min'   => 200,
                        'max'   => 300,
                        'price' => 2619,
                    ],
                    [
                        'min'   => 300,
                        'max'   => 400,
                        'price' => 2729,
                    ],
                    [
                        'min'   => 400,
                        'max'   => 500,
                        'price' => 3055,
                    ],
                    [
                        'min'   => 500,
                        'max'   => 600,
                        'price' => 3492,
                    ],
                    [
                        'min'   => 600,
                        'max'   => null,
                        'price' => 3927,
                    ],
                ],
                // ماه های گرم در مناطق گرمسیر
                'tropical1' => [
                    [
                        'min'   => 0,
                        'max'   => 1500,
                        'price' => 1310,
                    ],
                    [
                        'min'   => 1500,
                        'max'   => 2000,
                        'price' => 1419,
                    ],
                    [
                        'min'   => 2000,
                        'max'   => 2500,
                        'price' => 1745,
                    ],
                    [
                        'min'   => 2500,
                        'max'   => 3000,
                        'price' => 2183,
                    ],
                    [
                        'min'   => 3000,
                        'max'   => 4000,
                        'price' => 2401,
                    ],
                    [
                        'min'   => 4000,
                        'max'   => 5000,
                        'price' => 2619,
                    ],
                    [
                        'min'   => 5000,
                        'max'   => null,
                        'price' => 3273,
                    ],
                ],
                'tropical2' => [
                    [
                        'min'   => 0,
                        'max'   => 1500,
                        'price' => 1310,
                    ],
                    [
                        'min'   => 1500,
                        'max'   => 2000,
                        'price' => 1419,
                    ],
                    [
                        'min'   => 2000,
                        'max'   => 2500,
                        'price' => 1745,
                    ],
                    [
                        'min'   => 2500,
                        'max'   => 3000,
                        'price' => 2183,
                    ],
                    [
                        'min'   => 3000,
                        'max'   => 4000,
                        'price' => 2401,
                    ],
                    [
                        'min'   => 4000,
                        'max'   => 5000,
                        'price' => 2619,
                    ],
                    [
                        'min'   => 5000,
                        'max'   => null,
                        'price' => 3273,
                    ],
                ],
                'tropical3' => [
                    [
                        'min'   => 0,
                        'max'   => 1500,
                        'price' => 1310,
                    ],
                    [
                        'min'   => 1500,
                        'max'   => 2000,
                        'price' => 1419,
                    ],
                    [
                        'min'   => 2000,
                        'max'   => 2500,
                        'price' => 1745,
                    ],
                    [
                        'min'   => 2500,
                        'max'   => 3000,
                        'price' => 2183,
                    ],
                    [
                        'min'   => 3000,
                        'max'   => 4000,
                        'price' => 2401,
                    ],
                    [
                        'min'   => 4000,
                        'max'   => 5000,
                        'price' => 2619,
                    ],
                    [
                        'min'   => 5000,
                        'max'   => null,
                        'price' => 3273,
                    ],
                ],
            ],
        ];
    }
 
    protected function getFormSchema() 
    {
        return [
            Grid::make([
                'default' => 1,
                'sm' => 3,
                'xl' => 3,
                '2xl' => 3,
            ])
            ->schema([
                Select::make('type')
                ->label('نوع منطقه')
                ->required()
                ->default(0)
                ->options([
                    0 => 'منطقه عادی',
                    1 => 'گرمسیر ۱',
                    2 => 'گرمسیر ۲',
                    3 => 'گرمسیر ۳',                    
                ]),
            ]),
            Grid::make([
                'default' => 1,
                'sm' => 3,
                'xl' => 3,
                '2xl' => 3,
            ])
            ->schema([
                Section::make('طول دوره')
                ->description('تعداد روز در هر بازه زمانی را در جای خود وارد کنید')
                ->schema([
                    Forms\Components\TextInput::make('none_tropical')->label('ایام غیرگرم')->hint('روز')
                ->numeric(),
                Forms\Components\TextInput::make('tropical')->label('ایام گرم (تیر - مرداد - شهریور)')->hint('روز')
                ->numeric(),
                ]),
                
            ]),
            Grid::make([
                'default' => 1,
                'sm' => 3,
                'xl' => 3,
                '2xl' => 3,
            ])
            ->schema([
                TextInput::make('intermediate')->label(' میان باری')->hint('kwh')->numeric(),
                TextInput::make('peak')->label(' اوج باری')->hint('kwh')->numeric(),
                TextInput::make('low')->label(' کم باری')->hint('kwh')->numeric()
            ])
        ];

    } 
 
    public function submit(): void
    {
        $this->table = [];
        $this->price_low = $this->price_peak = $this->sum_durations_with_ratio = $this->base_price = $this->sum_durations = $this->season_price = 0;
        
        $form = $this->form->getState();

        $this->type = $form['type'];
        $this->tropical = $form['tropical'];

        if($form['type']) {
            $durations = [
                'none_tropical' => $form['none_tropical'] ?? 0,
                'tropical'.$form['type'] => $form['tropical'] ?? 0,
            ];
        } else {
            $durations = [
                'none_tropical' => $form['none_tropical'] ?? 0,
            ];
        }
        
        foreach ($durations as $key => $duration) {
            $this->sum_durations += $duration;
            $this->sum_durations_with_ratio += $duration*$this->consumption_ratio[$key];
        }

        if($this->type === '0' and $this->tropical !== null) {
            $this->sum_durations += $this->tropical; 
            $this->sum_durations_with_ratio += $this->tropical;
        }

        if($this->sum_durations) {
            $this->result = true;

            $this->intermediate = $form['intermediate'];
            $this->peak = $form['peak'];
            $this->low = $form['low'];
    
            foreach($durations as $key => $duration) {
                if($duration > 0) $this->perPeriod($duration, $key);
            }
    
            // بهای پایه
            $base_price = $this->base_price;
    
            $this->price_peak = ($this->sum_durations*$this->peak*873)/$this->sum_durations_with_ratio;
            $this->price_low = ($this->sum_durations*$this->low*873)/($this->sum_durations_with_ratio*2);
    
            // آبونمان
            $subscription = 11770*$this->sum_durations/30;
            
            // بهای فصل
            $trapical_duration = $this->sum_durations - $form['none_tropical'];
            if($this->type === '0' and $this->tropical !== null) {
                $season_price = (($base_price + $this->price_peak - $this->price_low + $subscription)*$trapical_duration/$this->sum_durations)/5;
            } else {
                $season_price = (($this->season_price*$trapical_duration/30)+($this->price_peak - $this->price_low + $subscription)*$trapical_duration/$this->sum_durations)/5;
            }
    
            // عوارض
            $complications = floor(($base_price + $this->price_peak - $this->price_low + $season_price)/10);
    
            // مالیات
            $tax = 9/100*($base_price + $this->price_peak - $this->price_low + $subscription + $season_price);
    
            // مبلغ صورت حساب
           $final_price = $base_price + $this->price_peak - $this->price_low + $season_price + $complications + $tax + $subscription;
    
           $this->tax = number_format(round($tax));
           $this->subscription = number_format(round($subscription));
           $this->season_price = number_format(round($season_price));
           $this->complications = number_format(round($complications));
           $this->final_price = number_format(round($final_price));
           $this->price_peak = number_format(round($this->price_peak));
           $this->price_low = number_format(round($this->price_low));
           $this->base_price = number_format(round($this->base_price));
           $this->durations = $durations;
    
           $this->dispatchBrowserEvent('scrollToBottom');
    
        }

       $this->form->fill($form);
    }

    public function perPeriod($duration, $key) {

        if($this->type === '0' and $this->tropical !== null) $duration += $this->tropical;
        
        $percent = $duration*$this->consumption_ratio[$key]/$this->sum_durations_with_ratio;
        
        $total_consumption = $percent*($this->intermediate + $this->peak + $this->low);

        // متوسط مصرف ماهانه
        $average_consumption = $total_consumption/$duration*30;

        // نوع مشتری
        $customer_type = $this->getCustomerType($average_consumption, $key);

        $this->table[$key] = [
            'label' => ($key === 'none_tropical') ? 'عادی' : 'گرمسیری',
            'duration' => $duration,
            'consumption' => round($total_consumption, 2),
            'monthly_consumption' => round($total_consumption*30/$duration, 2)
        ];

        // اضافه پرداخت اوج بار
        $peak = $this->peak*$this->encouragement_ratio[$key];
        $peak = ($customer_type === 1) ? $peak*600 : $peak*873;
        $this->price_peak += $peak;

        // کسورات مصارف غیر اوج باری
        $low = $this->low*$this->encouragement_ratio[$key];
        $low = ($customer_type === 1) ? $low*300 : $low*436.5;
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
                    if($key != 'none_tropical') $this->season_price += $tariff[$id]['price']*$average_consumption;
                    $tarif_table[$id]['consumption'] = round($average_consumption, 2);
                    $tarif_table[$id]['monthly_consumption'] = number_format(round($tariff[$id]['price']*$average_consumption));
                } else {
                    for($i = 0; $i< $id; $i++) {
                        $MBP += $tariff[$i]['price']*($tariff[$i]['max'] - $tariff[$i]['min']);
                        if($key != 'none_tropical') $this->season_price += $tariff[$i]['price']*($tariff[$i]['max'] - $tariff[$i]['min']);
                        $tarif_table[$i]['consumption'] = $tariff[$i]['max'] - $tariff[$i]['min'];
                        $tarif_table[$i]['monthly_consumption'] = number_format(round($tariff[$i]['price']*($tariff[$i]['max'] - $tariff[$i]['min'])));
                    }
                    $MBP += $tariff[$id]['price']*($average_consumption - $tariff[$id]['min']);
                    if($key != 'none_tropical') $this->season_price += $tariff[$id]['price']*($average_consumption - $tariff[$id]['min']);
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
        return 2;
    }

    public function render()
    {
        return view('livewire.industrial‌-bill');
    }
}
