<script>
export default {
    methods:{
        setCurrentTarget(){
            let current_hour_timeframe = document.querySelector("#logged-user-timeframe .available[data-time='"+this.current_hour+"']");
            if(current_hour_timeframe == undefined){
                    current_hour_timeframe = document.querySelector(`#logged-user-timeframe .hour-time.available.leave ~ .hour-time[data-time~='${this.current_hour}']`)
            }
            this.current_hour_timeframe = current_hour_timeframe;
        },
        moveTimeRuler(){
            let current_hour =  this.current_hour_timeframe;
            let current_hour_pos =  current_hour.offsetLeft;
            let arrow = document.querySelector(".timeline-arrow").offsetLeft;
            let timeframe_ruler = document.querySelector("#logged-user-timeframe");
            let teammates_rulers = [];
            let position = null;
            let hour_counter_12 = this.hour_counter_12;
            let hour_counter_24 = this.hour_counter_24;
            let calculation = (arrow - current_hour_pos - 6);

            if(current_hour_pos < arrow){

                if(this.hour_counter_12.length < 52){
                    let new_12 = [{ original: 20, time: 8, meridie: "pm" },{ original: 21, time: 9, meridie: "pm" },{ original: 22, time: 10, meridie: "pm" },{ original: 23, time: 11, meridie: "pm" }];
                    let new_24 = this.hour_counter_24.splice(35);
                    
                    new_12.reverse().map( item => {
                        this.hour_counter_12.unshift(item);
                    } )
                }
            }

            this.team_members.forEach(member => {
                let timeframe = document.querySelector(`.hour-timeframe[data-teammate="${member.id}"]`);
                teammates_rulers.push(timeframe)

            })
           
            teammates_rulers.forEach( (ruler,key) => {

                let nodes = ruler.children;

                let hour_dom_node = document.querySelector(`.hour-timeframe[data-teammate="${key + 1}"] .available.hour-time[data-time="${this.teammates_current_hour[key]}"]`)
                
                if(hour_dom_node == null){
                    hour_dom_node = document.querySelector(`.hour-timeframe[data-teammate="${key + 1}"] .hour-time.available.leave ~ .hour-time[data-time="${this.teammates_current_hour[key]}"]`)
                }

                position = hour_dom_node.offsetLeft
                calculation = (arrow - position - 6);
                ruler.style.left = `${calculation}px`;
            })

        }
    }
}
</script>