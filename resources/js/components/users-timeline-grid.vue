<template>
    <div class="timeline-grid">
        <div class="timeline-items">
            <div class="timeline-header">
                <user-item view-mode='timeline' class="">
                </user-item>
            </div>
            <user-item v-for="{number,key} in numbers" :key='key' view-mode='timeline'></user-item>
        </div>

        <div class="hours-items-grid">

            <span class="timeline-arrow">
                <img src="../../img/arrow-tip.svg" alt="" class="arrow-tip"/>
                <i class="arrow-line"></i>
            </span> 
            

            <div class="timeline-header">

                <div class="hour-timeframe">
                    <span class="hour-time">1</span>
                    <span class="hour-time">2</span>
                    <span class="hour-time">3</span>
                    <span class="hour-time">4</span>
                    <span class="hour-time">5</span>
                    <span class="hour-time">6</span>
                    <span class="hour-time">7</span>
                    <span class="hour-time">8</span>
                    <span class="hour-time">9</span>
                    <span class="hour-time available half entry">10</span>
                    <span class="hour-time  available">11</span>
                    <span class="hour-time available ">12</span>
                    <span class="hour-time available ">13</span>
                    <span class="hour-time  available">14</span>
                    <span class="hour-time  available">15</span>
                    <span class="hour-time  available">16</span>
                    <span class="hour-time  available">17</span>
                    <span class="hour-time  available">18</span>
                    <span class="hour-time  available leave">19</span>
                    <span class="hour-time">20</span>
                    <span class="hour-time">21</span>
                    <span class="hour-time">22</span>
                    <span class="hour-time">23</span>
                    <span class="hour-time">24</span>
                    <span class="hour-time">25</span>
                    <span class="hour-time">26</span>
                    <span class="hour-time">27</span>
                    <span class="hour-time">28</span>
                    <span class="hour-time">29</span>
                    <span class="hour-time">30</span>
                    <span class="hour-time">31</span>
                    <span class="hour-time">32</span>
                    <span class="hour-time">33</span>
                    <span class="hour-time">34</span>
                    <span class="hour-time">35</span>
                    <span class="hour-time">36</span>
                    <span class="hour-time">37</span>
                    <span class="hour-time">38</span>
                    <span class="hour-time">39</span>
                </div>

            </div>    

            <div v-for="{number,key} in numbers" :key='key' class="hour-timeframe">
                <span class="hour-time">1</span>
                <span class="hour-time">2</span>
                <span class="hour-time">3</span>
                <span class="hour-time">4</span>
                <span class="hour-time">5</span>
                <span class="hour-time">6</span>
                <span class="hour-time">7</span>
                <span class="hour-time">8</span>
                <span class="hour-time available entry">9</span>
                <span class="hour-time available">10</span>
                <span class="hour-time available">11</span>
                <span class="hour-time available">12</span>
                <span class="hour-time available">13</span>
                <span class="hour-time available">14</span>
                <span class="hour-time available">15</span>
                <span class="hour-time available">16</span>
                <span class="hour-time available">17</span>
                <span class="hour-time available">18</span>
                <span class="hour-time available">19</span>
                <span class="hour-time available leave">20</span>
                <span class="hour-time">21</span>
                <span class="hour-time">22</span>
                <span class="hour-time">23</span>
                <span class="hour-time">24</span>
                <span class="hour-time">25</span>
                <span class="hour-time">26</span>
                <span class="hour-time">27</span>
                <span class="hour-time">28</span>
                <span class="hour-time">29</span>
                <span class="hour-time">30</span>
                <span class="hour-time">31</span>
                <span class="hour-time">32</span>
                <span class="hour-time">33</span>
                <span class="hour-time">34</span>
                <span class="hour-time">35</span>
                <span class="hour-time">36</span>
                <span class="hour-time">37</span>
                <span class="hour-time">38</span>
                <span class="hour-time">39</span>
            </div>
        
        </div>

    </div>
</template>
<script>

import UserItem from './user-item.vue';

export default {
    data(){
        return {
            numbers:[1,2,3,4,5,6,7,8,9,10,11,12,13,14]
        }
    },
    components:{
        UserItem
    }
}
</script>