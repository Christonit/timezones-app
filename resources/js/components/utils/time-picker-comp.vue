<template>
    <div class="time-picker">
        <span class="time-picker-text" @click="openTimePicker">
            12:00
        </span>
        <div class="time-picker-dropdown" ref="timePickerSelect" @click="selectTimePicker">
            <span>8:00</span>
            <span>8:00</span>
            <span>8:00</span>
            <span>8:00</span>
            <span>8:00</span>
            <span>8:00</span>
            <span>8:00</span>
            <span>8:00</span>
            <span>8:00</span>
            <span>8:00</span>
            <span>8:00</span>
            <span>8:00</span>
        </div>
    </div>
</template>

<script>
export default {
    name:'time-picker',
    methods:{
        openTimePicker(e){
            let el = this.$refs.timePickerSelect;

            if(el.classList.contains('active')){
               return el.classList.remove('active')
            }
            el.classList.add('active')
            e.stopPropagation();
        },
        selectTimePicker(e){
            let el = this.$refs.timePickerSelect;

            if(el.classList.contains('active')){
                el.classList.remove('active')
            }

            e.stopPropagation();
        }
    }
}
</script>