<template>
    <div class="user-item" :class="itemType">
            <figure class="user-item-pic">
                <span class="user-img">
                    <img src="https://via.placeholder.com/32" alt="User X profile pic" >
                </span>
                <span class="user-status-dot"></span>
            </figure>
            <span v-if="viewMode == 'card'" class="user-item-info">
                <b class="user-item-name">Minnie Pearson</b>
                <h4 class="user-item-current-hour">05:06 PM</h4>
                <span class="user-item-current-day">Wed 5th</span>
                <span class="user-item-available-time">Av: 4 AM - 5 PM</span>
            </span>
            <template v-if="viewMode == 'timeline'">
                <span class="user-item-info">

                    <b class="user-item-name">Minnie Pearson</b>
                    <span class="user-item-available-time">Av: 4 AM - 5 PM</span>

                </span>

                <h4 class="user-item-current-hour">05:06 PM</h4>
                <span class="user-item-current-day">Wed 5th</span>

            </template>

            <span class="more-option-btn">
                    <div class="more-options">
                        <span class="more-options-item">Add teammate</span>
                        <span class="more-options-item">Edit name </span>
                        <span class="more-options-item delete"><img src="../../img/delete-icon-white.svg" class="more-options-icon" alt="More options delete icon"> Delete project</span>
                    </div>
                </span>

        </div>
</template>

<script>
export default {
    data(){
        return {

        };
    },
    props:{
        viewMode:{
            type:String
        }
    },
    computed:{
        itemType(){
            if(this.viewMode == 'card'){
                return 'card';
            }
            if(this.viewMode == 'timeline'){
                return 'timeline-card';
            }
        }
    }
}
</script>