<div class="p-6 sm:px-20 bg-white border-b border-gray-200">
    <div>
        <x-jet-application-logo class="block h-12 w-auto" />
    </div>

    <div class="flex justify-between flex-wrap">
        <div class="mt-6 text-gray-500">
            <b>پیاده سازی توسط</b> : رضا احمدی سبزوار - علی بخشی
        </div>
        <div class="mt-6 text-gray-500">
            <b>استاد راهنما</b> : دکتر نصور باقری
        </div>
    </div>
</div>

<div class="bg-gray-200 bg-opacity-25 grid grid-cols-1 md:grid-cols-2">
    <div class="p-6">
        <div class="flex items-center">
            <img width="30px" class="pl-1" src="{{asset('img/house.png')}}" alt="">
            <div class="ml-4 text-lg text-gray-600 leading-7 font-semibold"><a href="{{url('house-hold')}}">خانگی</a></div>
        </div>

        <div class="ml-12">
            <div class="mt-2 text-sm text-gray-500">
                با وارد نمودن اطلاعات مربوط به محل اقامت و اطلاعات کنتور می‌توان با استفاده از این قسمت مبلغ قابل پرداخت برای مصارف خانگی را مشخص کرد
            </div>

            <a href="{{url('house-hold')}}">
                <div dir="ltr" class="mt-3 flex items-center text-sm font-semibold text-indigo-700">
                        <div>محاسبه</div>

                        <div class="ml-1 text-indigo-500">
                            <svg viewBox="0 0 20 20" fill="currentColor" class="w-4 h-4"><path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                        </div>
                </div>
            </a>
        </div>
    </div>

    <div class="p-6 border-t border-gray-200 md:border-t-0 md:border-l">
        <div class="flex items-center">
            <img width="30px" class="pl-1" src="{{asset('img/store.png')}}" alt="">
            <div class="ml-4 text-lg text-gray-600 leading-7 font-semibold"><a href="{{url('/industrial-bill')}}">تجاری</a></div>
        </div>

        <div class="ml-12">
            <div class="mt-2 text-sm text-gray-500">
                با وارد نمودن اطلاعات مربوط به محل اقامت و اطلاعات کنتور می‌توان با استفاده از این قسمت مبلغ قابل پرداخت برای مصارف صنعتی را مشخص کرد
            </div>

            <a href="{{url('/commercial-bill')}}">
                <div dir="ltr" class="mt-3 flex items-center text-sm font-semibold text-indigo-700">
                        <div>محاسبه</div>

                        <div class="ml-1 text-indigo-500">
                            <svg viewBox="0 0 20 20" fill="currentColor" class="w-4 h-4"><path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                        </div>
                </div>
            </a>
        </div>
    </div>

</div>
