<template>
    <header v-if="device_width <= screen_sizes.lg" class="top-bar-mobile">
        <button class="menu-btn" @click="toggleSidebar">
            <img src="../../img/menu-mobile-icon.svg"/>
        </button>
        <div class="top-bar">
            <div class="clock-type-switch">
                <span :class="hour_clock == 24 ? 'active':''" @click="switchHourClock">24</span>
                <span :class="hour_clock == 12 ? 'active':''" @click="switchHourClock">12</span>
            </div>
            <div id='top-searchbar' class="input-group">
                <div class="top-searchbar-content">
                    <i class="search-icon"></i>

                    <input  class="form-control top-searchbar-input" 
                        type="text"
                        @click="openSearchbox" 
                        placeholder="Employee name, New York, GTM-1, project 01"/>
                </div>

                <div class="selected-keywords">
                    <span class="keyword-chip">GMT + 1 <i class="keyword-chip-del">close</i> </span>
                    <span class="keyword-chip">GMT + 1 <i class="keyword-chip-del">close</i> </span>
                    <span class="keyword-chip">GMT + 1 <i class="keyword-chip-del">close</i> </span>
                    <span class="keyword-chip">GMT + 1 <i class="keyword-chip-del">close</i> </span>
                </div>

                <searchbox v-if="team_project.searchbox_visible"></searchbox>
            
            </div>
            <div class="view-toggle">
                <span class="grid-view view-toggle-btn" 
                :class="(team_project.view_mode == 'card') ? 'active' : '' "
                @click="toggleTeamViewMode"></span>

                <span class="list-view view-toggle-btn" 
                :class="(team_project.view_mode == 'timeline') ? 'active': '' " 
                @click="toggleTeamViewMode"></span>

            </div>
        </div>
            
    </header>


    <header class="top-bar" v-else>
       <div class="clock-type-switch">
            <span :class="hour_clock == 24 ? 'active':''" @click="switchHourClock">24</span>
            <span :class="hour_clock == 12 ? 'active':''" @click="switchHourClock">12</span>
        </div>
            <div id='top-searchbar' class="input-group">
                <div class="top-searchbar-content">
                    <i class="search-icon"></i>

                    <input  class="form-control top-searchbar-input" 
                        type="text"
                        @click="openSearchbox" 
                        v-model="query"
                        @keyup="searchKeywords"
                        placeholder="Employee name, New York, GTM-1, project 01"/>
                </div>

                <div class="selected-keywords">
                    <span class="keyword-chip" >GMT+1<i class="keyword-chip-del">close</i> </span>
                </div>

                <searchbox v-if="team_project.searchbox_visible && queryResults.length > 0" :results="queryResults"></searchbox>
            
            </div>
            <div class="view-toggle">
                <span class="grid-view view-toggle-btn" 
                :class="(team_project.view_mode == 'card') ? 'active' : '' "
                @click="toggleTeamViewMode"></span>

                <span class="list-view view-toggle-btn" 
                :class="(team_project.view_mode == 'timeline') ? 'active': '' " 
                @click="toggleTeamViewMode"></span>

            </div>
            
    </header>
</template>

<script>
import Searchbox from '../components/utils/searchbox.vue';
import {mapState,mapMutations} from 'vuex';
export default {
    data(){
        return {
            query:null,
            queryResults:[],
            keywords_selected:[]
        }
    },
    computed:{
        ...mapState(['team_project','screen_sizes','device_width','hour_clock']),
        viewModeToggle(){
            this.team_project.view_mode
        },
        screen_width(){
            return window.innerWidth;
        }
    },
    methods:{
        ...mapMutations(['toggleTeamViewMode','toggleSearchbox','toggleSidebar','switchHourClock']),
        openSearchbox(){
            if(this.team_project.searchbox_visible == false){
                return this.toggleSearchbox();
            }
        },
        searchKeywords(){

            //BUG
            /*There is a bug where checklist remain selected in position/index 
            even when data changes, temporary solution is to manuale check false 
            all the checkboxes in results.

            Problem is if final result is the same as one alredy selected we dont 
            have that result selected an appears as new
            */

            let checkboxes = document.querySelectorAll('.searchbox-result-item input[type="checkbox"]');
            if(checkboxes != null){
                checkboxes.forEach(item => item.checked = false)
            }
            // END OF SOLUTION

            return fetch(`/search?team=${this.team_project.id}&q=${this.query}`)
            .then(res => res.text())
            .then(data =>{  
                this.queryResults = JSON.parse(data)
            })
            .then( ()=>{
                // Make script to check if any new result is equal to anyone alredy selected.
                //Solution #1:
                let selected_keywords = document.querySelectorAll('.searchbox-keywords i[data-value]');
                let searchbox_result = document.querySelectorAll('.searchbox-result-item span[data-keyword-value]');
                searchbox_result.forEach( item => {
                    selected_keywords.forEach(selected => {
                        if( item.getAttribute('data-keyword-value') == selected.getAttribute('data-value') ){
                            return item.children[0].checked = true
                        }
                    })
                })
            })
        }
     
        
    },
    components:{
        Searchbox
    }
}
</script>