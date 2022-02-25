<div>
    <x-slot name="print:hidden header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            تجاری
        </h2>
    </x-slot>
    {{-- The Master doesn't talk, he acts. --}}
    <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
        <div class="print:hidden md:grid md:grid-cols-3 md:gap-6">
            <div class="md:col-span-1 flex justify-between">
                <div class="px-4 sm:px-0">
                    <h3 class="text-lg font-medium text-gray-900">قبض مشترک تجاری</h3>

                    <p class="mt-1 text-sm text-gray-600">
                        اطلاعات قبض را با دقت وارد کرده و روی گزینه ارسال بزنید
                    </p>
                </div>

                <div class="px-4 sm:px-0">
                    
                </div>
            </div>

            <div class="mt-5 md:mt-0 md:col-span-2">
                <form wire:submit.prevent="submit">
                    <div class="px-4 py-5 bg-white sm:p-6 shadow sm:rounded-tl-md sm:rounded-tr-md">
                        {{ $this->form }}
                        
                    </div>

                        <div class="flex items-center justify-end px-4 py-3 bg-gray-50 text-right sm:px-6 shadow sm:rounded-bl-md sm:rounded-br-md">
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition" wire:loading.attr="disabled" wire:target="photo">
                                ارسال
                            </button>
                        </div>
                </form>
            </div>
        </div>

        <!-- Livewire Component wire-end:z9zlfiHPYH9H8GrsQGmX -->
        <div class="print:hidden hidden sm:block">
            <div class="py-8">
                <div class="border-t border-gray-200"></div>
            </div>
        </div>

        @if($result)
        <div class="md:grid md:grid-cols-3 md:gap-6" id="idElement">
            <div class="md:col-span-1 flex justify-between">
                <div class="px-4 sm:px-0">
                    <h3 class="text-lg font-medium text-gray-900">قبض نهایی مشترک تجاری</h3>

                    <p class="mt-1 text-sm text-gray-600">
                        جزئیات قبض بر اساس مصوبات ۱۴۰۰
                    </p>
                </div>

                <div class="px-4 sm:px-0">
                    
                </div>
            </div>

            <div class="mt-5 md:mt-0 md:col-span-3">
                <div class="px-0 py-0 sm:p-6 ">

                    <div class="px-4 py-8 sm:px-8">
                        <table class="text-center border-collapse w-full my-3 border border-slate-400 bg-white text-sm shadow-sm">
                          <thead class="bg-slate-50">
                            <tr>
                              <th class="w-1/5 border border-slate-300 font-semibold p-4 text-slate-900 text-right">نرخ</th>
                              <th class="w-1/5 border border-slate-300 font-semibold p-4 text-slate-900 text-right">
                                روزهای اوج بار
                              </th>
                              <th class="w-1/5 border border-slate-300 font-semibold p-4 text-slate-900 text-right">
                                روزهای عادی
                              </th>
                              <th class="w-1/5 border border-slate-300 font-semibold p-4 text-slate-900 text-right">
                                كل مصرف
                              </th>
                              <th class="w-1/5 border border-slate-300 font-semibold p-4 text-slate-900 text-right">
                                متوسط ماهانه مصرف<span style="font-size: x-small; padding: 5px;">(kwh)</span>
                              </th>
                            </tr>
                          </thead>
                          <tbody>
                              @foreach ($table as $row)
                              @if($type == '0' and $tropical !== null)
                              <tr>
                                <td class="border border-slate-300 bg-white p-4 text-slate-500">{{$row['label']}}</td>
                                <td class="border border-slate-300 bg-white p-4 text-slate-500">{{$tropical}}</td>
                                <td class="border border-slate-300 bg-white p-4 text-slate-500">{{$row['duration'] - $tropical}}</td>
                                <td class="border border-slate-300 bg-white p-4 text-slate-500">{{$row['consumption']}}</td>
                                <td class="border border-slate-300 bg-white p-4 text-slate-500">{{$row['monthly_consumption']}}</td>
                              </tr>
                              @else
                              <tr>
                                <td class="border border-slate-300 bg-white p-4 text-slate-500">{{$row['label']}}</td>
                                @if($row['label'] === 'عادی')
                                <td class="border border-slate-300 bg-white p-4 text-slate-500"> - </td>
                                <td class="border border-slate-300 bg-white p-4 text-slate-500">{{$row['duration']}}</td>
                                @else
                                <td class="border border-slate-300 bg-white p-4 text-slate-500">{{$row['duration']}}</td>
                                <td class="border border-slate-300 bg-white p-4 text-slate-500"> - </td>
                                @endif
                                <td class="border border-slate-300 bg-white p-4 text-slate-500">{{$row['consumption']}}</td>
                                <td class="border border-slate-300 bg-white p-4 text-slate-500">{{$row['monthly_consumption']}}</td>
                              </tr>
                              @endif
                              @endforeach
                          </tbody>
                        </table>

                        <table class="border-collapse w-full my-3 border border-slate-400 bg-white text-sm shadow-sm">
                            <thead class="bg-slate-50">
                              <tr>
                                <th class="w-1/4 border border-slate-300 font-semibold p-4 text-slate-900 text-right">&nbsp;</th>
                                <th class="w-1/4 border border-slate-300 font-semibold p-4 text-slate-900 text-right">
                                  كنتور میان باری<span style="font-size: x-small; padding: 5px;">(kwh)</span>
                                </th>
                                <th class="w-1/4 border border-slate-300 font-semibold p-4 text-slate-900 text-right">
                                  كنتور اوج بار<span style="font-size: x-small; padding: 5px;">(kwh)</span>
                                </th>
                                <th class="w-1/4 border border-slate-300 font-semibold p-4 text-slate-900 text-right">
                                  كنتور كم باری<span style="font-size: x-small; padding: 5px;">(kwh)</span>
                                </th>
                                
                              </tr>
                            </thead>
                            <tbody>
                              <tr>
                                <td class="border border-slate-300 bg-white p-4 text-slate-500">مصرف</td>
                                <td class="border border-slate-300 bg-white p-4 text-slate-500">{{$intermediate}}</td>
                                <td class="border border-slate-300 bg-white p-4 text-slate-500">{{$peak}}</td>
                                <td class="border border-slate-300 bg-white p-4 text-slate-500">{{$low}}</td>
                              </tr>
                            </tbody>
                        </table>
                    
                        <table class="text-center border-collapse w-full my-3 bg-gray-100 text-sm shadow-sm">
                          <tbody>
                            <tr>
                              <td class="border border-slate-300 p-4 text-slate-۹00 bg-slate-50 font-semibold">بهای پایه</td>
                              <td class="border border-slate-300 bg-white p-4 text-slate-500">{{$base_price}}</td>
                              <td class="border border-slate-300 p-4 text-slate-۹00 bg-slate-50 font-semibold">عوارض برق</td>
                              <td class="border border-slate-300 bg-white p-4 text-slate-500">{{$complications}}</td>
                            </tr>
                            <tr>
                                <td class="border border-slate-300 p-4 text-slate-۹00 bg-slate-50 font-semibold">اضافه پرداختی مصارف اوج بار</td>
                                <td class="border border-slate-300 bg-white p-4 text-slate-500">{{$price_peak}}</td>
                                <td class="border border-slate-300 p-4 text-slate-۹00 bg-slate-50 font-semibold">مالیات بر ارزش افزوده</td>
                                <td class="border border-slate-300 bg-white p-4 text-slate-500">{{$tax}}</td>
                            </tr>
                            <tr>
                                <td class="border border-slate-300 p-4 text-slate-۹00 bg-slate-50 font-semibold">کسورات مصارف غیر اوج بار</td>
                                <td class="border border-slate-300 bg-white p-4 text-slate-500">{{$price_low}}</td>
                                <td class="border border-slate-300 p-4 text-slate-۹00 bg-slate-50 font-semibold">آبونمان</td>
                                <td class="border border-slate-300 bg-white p-4 text-slate-500">{{$subscription}}</td>
                                <td class="border border-slate-300 p-4 text-slate-۹00 bg-slate-50 font-semibold">مبلغ صورتحساب</td>
                            </tr>
                            <tr>
                                <td class="border border-slate-300 p-4 text-slate-۹00 bg-slate-50 font-semibold">بهای فصل</td>
                                <td class="border border-slate-300 bg-white p-4 text-slate-500">{{$season_price}}</td>
                                <td class="border border-slate-300 p-4 text-slate-500 border-l-0 bg-slate-50 font-semibold"></td>
                                <td class="border border-slate-300 p-4 border-r-0 text-slate-500 bg-slate-50 font-semibold">&nbsp;</td>
                                <td class="border border-slate-300 bg-white p-4 text-slate-900">{{$final_price}}</td>
                            </tr>
                          </tbody>
                        </table>

                        
                        @foreach ($table as $item)
                        <div class="border border-slate-300 border-b-0 bg-slate-100 w-full font-semibold p-4 mt-2 text-slate-900 text-center" >تعرفه {{$item['label']}} بمدت {{$item['duration']}} روز</div>
                        <table class="text-center border-collapse mb-4 w-full bg-white text-sm shadow-sm">
                            <thead class="bg-slate-50">
                              <tr>
                                <th class="w-1/4 border border-slate-300 font-semibold p-4 text-slate-900 text-right">پله های مصرف</th>
                                <th class="w-1/4 border border-slate-300 font-semibold p-4 text-slate-900 text-right">
                                    نرخ <span style="font-size: x-small; padding: 5px;">(ریال)</span>
                                </th>
                                <th class="w-1/4 border border-slate-300 font-semibold p-4 text-slate-900 text-right">
                                    متوسط ماهانه مصرف
                                </th>
                                <th class="w-1/4 border border-slate-300 font-semibold p-4 text-slate-900 text-right">
                                    مبلغ ماهانه
                                </th>
                              </tr>
                            </thead>
                            <tbody>
                                @foreach ($item['tariff'] as $row)
                                <tr>
                                  <td class="border border-slate-300 p-4 text-slate-۹00 bg-slate-50 font-semibold">از {{$row['min']}} تا {{$row['max']}} کیلوواتساعت</td>
                                  <td class="border border-slate-300 bg-white p-4 text-slate-500">{{$row['price']}}</td>
                                  <td class="border border-slate-300 bg-white p-4 text-slate-500">{{$row['consumption']}}</td>
                                  <td class="border border-slate-300 bg-white p-4 text-slate-500">{{$row['monthly_consumption']}}</td>
                                </tr>
                                    
                                @endforeach
                            </tbody>
                          </table>
                          @endforeach

                          <script>
                            window.addEventListener('scrollToBottom', event => {
                              document.querySelector('#idElement').scrollIntoView({
                                  behavior: 'smooth'
                              });
                            })
                          </script>
                    
                        </div>

                </div>

            </div>
        </div>
        @endif

    </div>

    
<div>
