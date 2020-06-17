<template>
    <div class="searchbox">
        <div class="searchbox-keyboards">
            <span class="keyboard-chip">GMT + 1 <i class="keyboard-chip-del">close</i> </span>
            <span class="keyboard-chip">GMT + 1 <i class="keyboard-chip-del">close</i> </span>
            <span class="keyboard-chip">GMT + 1 <i class="keyboard-chip-del">close</i> </span>
            <span class="keyboard-chip">GMT + 1 <i class="keyboard-chip-del">close</i> </span>
            <span class="keyboard-chip">GMT + 1 <i class="keyboard-chip-del">close</i> </span>
            <span class="keyboard-chip">GMT + 1 <i class="keyboard-chip-del">close</i> </span>
            <span class="keyboard-chip">GMT + 1 <i class="keyboard-chip-del">close</i> </span>
            <span class="keyboard-chip">GMT + 1 <i class="keyboard-chip-del">close</i> </span>
            <span class="keyboard-chip">GMT + 1 <i class="keyboard-chip-del">close</i> </span>
        </div>

        <div class="searchbox-results">
            <span class="searchbox-result-item">
                <span class="text">GMT + 2</span>
                <checkbox></checkbox>
            </span>
            <span class="searchbox-result-item">
                <span class="text">GMT + 2</span>
                <checkbox></checkbox>
            </span>
            <span class="searchbox-result-item">
                <span class="text">GMT + 2</span>
                <checkbox></checkbox>
            </span>
            <span class="searchbox-result-item">
                <span class="text">GMT + 2</span>
                <checkbox></checkbox>
            </span>
        </div>

        <div class="w-100 my-4">
                <continue-btn centered="true"></continue-btn>
        </div>
        
    </div>
</template>

<script>
import Checkbox from '../utils/checkbox-input';
import ContinueBtn from '../utils/buttons/continue-btn';

export default {
    components:{
        Checkbox,
        ContinueBtn
    }    
}
</script>