@foreach($items as $faq)
    <li itemscope itemprop="mainEntity" itemtype="https://schema.org/Question" class="w-full">
    <div
        class="bg-base-100 collapse-plus hover:bg-accent hover:text-accent-content text-base-content focus:bg-accent focus:text-accent-content collapse rounded-sm"
    >
        <input aria-label="فتح القائمة الجانبية" name="faqcheck" type="checkbox" />
        <div itemprop="name" class="collapse-title after:text-3xl border-gray-500 border-b-2">{{$faq->_faq_question}}</div>
        <div itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer" class="collapse-content bg-primary text-primary-content">
            <p itemprop="text" class="pt-4">{{$faq->_faq_answer}}</p>
        </div>
    </div>
    </li>
@endforeach