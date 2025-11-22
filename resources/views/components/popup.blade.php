<div 
    x-data="{ show:false, message:'', type:'info' }"
    x-show="show"
    x-transition.opacity.duration.300ms
    @popup.window="
        message = $event.detail.message;
        type = $event.detail.type;
        show = true;
        setTimeout(() => show = false, 3500);
    "
    class="fixed top-6 right-6 z-[9999]"
>
    <div 
        class="px-5 py-4 rounded-xl shadow-lg flex items-start justify-between space-x-3 w-[320px]"
        :class="{
            'bg-red-500 text-white': type === 'error',
            'bg-green-500 text-white': type === 'success',
            'bg-blue-500 text-white': type === 'info',
            'bg-yellow-500 text-white': type === 'warning'
        }"
    >
        <span x-text="message"></span>
        <button @click="show = false" class="ml-auto text-xl leading-none">&times;</button>
    </div>
</div>

<script>
    function popup(message, type = 'info') {
        window.dispatchEvent(
            new CustomEvent('popup', { detail: { message, type } })
        );
    }
</script>
