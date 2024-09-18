@foreach($items as $faq)
    <li class="w-full">
    <div
        tabindex="0"
        class="bg-base-100 collapse-plus hover:bg-accent hover:text-accent-content text-base-content focus:bg-accent focus:text-accent-content collapse rounded-sm"    
    >
        <div class="collapse-title after:text-3xl border-gray-500 border-b-2">{{$faq->_faq_question}}</div>
        <div class="collapse-content bg-primary text-primary-content">
            <p class="pt-4">{{$faq->_faq_answer}}</p>
        </div>
    </div>
    </li>
@endforeach