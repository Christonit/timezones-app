<template>
    <div class="time-picker">
        <span class="time-picker-text" @click="openTimePicker">
            <slot></slot>
        </span>
        <div class="time-picker-dropdown" ref="timePickerSelect" @click="selectTimePicker">
            <span data-time="0:00">0:00</span>
            <span data-time="0:30" @click="selectTimePicker">0:30</span>
            <span data-time="1:00" @click="selectTimePicker">1:00</span>
            <span data-time="1:30" @click="selectTimePicker">1:30</span>
            <span data-time="2:00" @click="selectTimePicker">2:00</span>
            <span data-time="2:30" @click="selectTimePicker">2:30</span>
            <span data-time="3:00" @click="selectTimePicker">3:00</span>
            <span data-time="3:30" @click="selectTimePicker">3:30</span>
            <span data-time="4:00" @click="selectTimePicker">4:00</span>
            <span data-time="4:30" @click="selectTimePicker">4:30</span>
            <span data-time="5:00" @click="selectTimePicker">5:00</span>
            <span data-time="5:30" @click="selectTimePicker">5:30</span>
            <span data-time="6:00" @click="selectTimePicker">6:00</span>
            <span data-time="6:30" @click="selectTimePicker">6:30</span>
            <span data-time="7:00" @click="selectTimePicker">7:00</span>
            <span data-time="7:30" @click="selectTimePicker">7:30</span>
            <span data-time="8:00" @click="selectTimePicker">8:00</span>
            <span data-time="8:30" @click="selectTimePicker">8:30</span>
            <span data-time="9:00" @click="selectTimePicker">9:00</span>
            <span data-time="9:30" @click="selectTimePicker">9:30</span>
            <span data-time="10:00" @click="selectTimePicker">10:00</span>
            <span data-time="10:30" @click="selectTimePicker">10:30</span>
            <span data-time="11:00" @click="selectTimePicker">11:00</span>
            <span data-time="11:30" @click="selectTimePicker">11:30</span>
            <span data-time="12:00" @click="selectTimePicker">12:00</span>
            <span data-time="12:30" @click="selectTimePicker">12:30</span>
            <span data-time="13:00" @click="selectTimePicker">13:00</span>
            <span data-time="13:30" @click="selectTimePicker">13:30</span>
            <span data-time="14:00" @click="selectTimePicker">14:00</span>
            <span data-time="14:30" @click="selectTimePicker">14:30</span>
            <span data-time="15:00" @click="selectTimePicker">15:00</span>
            <span data-time="15:30" @click="selectTimePicker">15:30</span>
            <span data-time="16:00" @click="selectTimePicker">16:00</span>
            <span data-time="16:30" @click="selectTimePicker">16:30</span>
            <span data-time="17:00" @click="selectTimePicker">17:00</span>
            <span data-time="17:30" @click="selectTimePicker">17:30</span>
            <span data-time="18:00" @click="selectTimePicker">18:00</span>
            <span data-time="18:30" @click="selectTimePicker">18:30</span>
            <span data-time="19:00" @click="selectTimePicker">19:00</span>
            <span data-time="19:30" @click="selectTimePicker">19:30</span>
            <span data-time="20:00" @click="selectTimePicker">20:00</span>
            <span data-time="20:30" @click="selectTimePicker">20:30</span>
            <span data-time="21:00" @click="selectTimePicker">21:00</span>
            <span data-time="21:30" @click="selectTimePicker">21:30</span>
            <span data-time="22:00" @click="selectTimePicker">22:00</span>
            <span data-time="22:30" @click="selectTimePicker">22:30</span>
            <span data-time="23:00" @click="selectTimePicker">23:00</span>
            <span data-time="23:30" @click="selectTimePicker">23:30</span>
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
            let time = e.target.getAttribute('data-time');
            this.$emit('time-pick',time);

            if(el.classList.contains('active')){
                el.classList.remove('active')
            }

            e.stopPropagation();
        }
    }
}
</script>