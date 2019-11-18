<template>
    
    <div class="modal select-none fixed pin z-50 overflow-x-hidden overflow-y-auto text-left" tabindex="-1" role="dialog">
        <div class="relative mx-auto flex justify-center z-20 py-view">
            <form @submit.prevent="update" autocomplete="off" class="bg-white rounded-lg shadow-lg overflow-hidden w-action">
                <h2 class="border-b border-40 py-8 px-8 text-90 font-normal text-xl">{{ __('Update setting') }}</h2> 

                <div class="action">
                    <div class="flex border-b border-40">
                        <div class="w-1/5 px-8 py-6">
                            <label for="value" class="inline-block text-80 pt-2 leading-tight">
                                {{ key }}
                            </label>
                        </div> 
                        <div class="py-6 px-8 w-1/2">
                            <input type="text" :disabled="submitting" class="w-full form-control form-input form-input-bordered flatpickr-input" name="value" :value="value">      
                        </div>
                    </div>
                </div>
                    
                <div class="bg-30 px-6 py-3 flex">
                    <div class="flex items-center ml-auto">
                        <button @click.prevent="$emit('cancel')" :disabled="submitting" type="button" class="btn btn-link dim cursor-pointer text-80 ml-auto mr-6">
                            {{ __('Cancel') }}
                        </button> 
                        <button type="submit" :disabled="submitting" class="btn btn-default btn-primary">
                            <span>{{ __('Update') }}</span>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    
</template>

<script>
export default {
    
    props: {
        data: { required: true, type: Object },
    },
    data() {
        return {
            key: null,
            value: null,
            submitting: false
        };
    },
    async created() {
        this.key = this.data.key;
        this.value = this.data.value;
    },
    methods: {
        update(event) {
            this.value = event.target.value.value;
            this.submitting = true;
            this.$emit('update', { 'key': this.key, 'value': this.value });
        }
    }

}
</script>