<section class="relative pt-10 bg-white overflow-hidden">
    <div class="relative z-10 container px-4 mx-auto">
        <div class="md:max-w-4xl mx-auto">
            <p class="mb-4 text-sm text-green-600 font-semibold uppercase tracking-px">Have any questions?</p>

            <div class="mb-6">

                <h2 class="mb-0 text-sm md:text-lg xl:text-lg font-bold font-heading tracking-px-n leading-none">Frequently Asked Questions</h2>
                <p class="text-gray-700 font-medium">Answers to common questions.</p>

            </div>
            <div class="mb-11 flex flex-wrap -m-1">
                <div class="w-full p-1">

                    <div class="py-7 px-8 bg-white bg-opacity-60 border border-green-600 rounded-2xl shadow-10xl">
                        <div class="flex flex-wrap justify-between -m-2">
                            <div class="flex-1 p-2">
                                <div class="faq_header">
                                    <h3 class="mb-4 text-lg font-semibold leading-normal">How do you register your farm?</h3>
                                </div>
                                <p class="text-gray-900 font-medium hidden faq_answers">Lorem ipsum dolor sit amet, to the consectr adipiscing elit. Volutpat tempor to the condi mentum vitae vel purus.</p>
                            </div>
                            <div class="w-auto p-2">
                                <i class="bi bi-chevron-down"></i>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="w-full p-1">

                    <div class="py-7 px-8 bg-white bg-opacity-60 border border-green-600 hover:border-green-800 rounded-2xl shadow-10xl" onclick="faqanswerdropdown()">
                        <div class="flex flex-wrap justify-between -m-2">
                            <div class="flex-1 p-2">
                                <div class="faq_header">
                                    <h3 class="text-lg font-semibold leading-normal">How do I know the crop to grow?</h3>
                                </div>
                                <p class="text-gray-900 font-medium hidden faq_answers">Lorem ipsum dolor sit amet, to the consectr adipiscing elit. Volutpat tempor to the condi mentum vitae vel purus.</p>

                            </div>
                            <div class="w-auto p-2">
                                <i class="bi bi-chevron-down"></i>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="w-full p-1">

                    <div class="py-7 px-8 bg-white bg-opacity-60 border border-green-600 hover:border-green-800 rounded-2xl shadow-10xl">
                        <div class="flex flex-wrap justify-between -m-2">
                            <div class="flex-1 p-2">
                                <div class="faq_header">
                                    <h3 class="text-lg font-semibold leading-normal">Is my data safe?</h3>
                                </div>
                                <p class="text-gray-900 font-medium hidden faq_answers">Lorem ipsum dolor sit amet, to the consectr adipiscing elit. Volutpat tempor to the condi mentum vitae vel purus.</p>
                            </div>
                            <div class="w-auto p-2">
                                <i class="bi bi-chevron-down"></i>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="w-full p-1">

                    <div class="py-7 px-8 bg-white bg-opacity-60 border border-green-600 hover:border-green-800 rounded-2xl shadow-10xl">
                        <div class="flex flex-wrap justify-between -m-2">
                            <div class="flex-1 p-2">
                                <div class="faq_header">
                                    <h3 class="text-lg font-semibold leading-normal">How to get support for the product?</h3>
                                </div>
                                <p class="text-gray-900 font-medium hidden">Lorem ipsum dolor sit amet, to the consectr adipiscing elit. Volutpat tempor to the condi mentum vitae vel purus.</p>
                            </div>
                            <div class="w-auto p-2">
                                <span class="text-sm rotate-180" id="arrowlegal">
                                    <i class="bi bi-chevron-down"></i>
                                </span>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <p class="text-center font-medium mb-2">
                <span class="font-semibold">Still have any questions?</span>
                <a class="font-semibold text-green-600 hover:text-green-900" href="#">Contact us</a>
            </p>
        </div>
    </div>

    <script>
        $(function() {
            $('.faq_header').click(function() {
                $(this).next().toggle(1000);
            });
        });
    </script>
</section>