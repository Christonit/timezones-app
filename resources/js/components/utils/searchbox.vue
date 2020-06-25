<template>
    <div class="searchbox">
        <div class="searchbox-keywords">
            <span class="keyword-chip">GMT + 1 <i class="keyword-chip-del">close</i> </span>
            <span class="keyword-chip">GMT + 1 <i class="keyword-chip-del">close</i> </span>
            <span class="keyword-chip">GMT + 1 <i class="keyword-chip-del">close</i> </span>
            <span class="keyword-chip">GMT + 1 <i class="keyword-chip-del">close</i> </span>
            <span class="keyword-chip">GMT + 1 <i class="keyword-chip-del">close</i> </span>
            <span class="keyword-chip">GMT + 1 <i class="keyword-chip-del">close</i> </span>
            <span class="keyword-chip">GMT + 1 <i class="keyword-chip-del">close</i> </span>
            <span class="keyword-chip">GMT + 1 <i class="keyword-chip-del">close</i> </span>
            <span class="keyword-chip">GMT + 1 <i class="keyword-chip-del">close</i> </span>
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
                <continue-btn alignment="center"></continue-btn>
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