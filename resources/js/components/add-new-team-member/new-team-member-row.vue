<template>
    <div class="input-field-group  my-3">
        <div class="input-field">
            <label class="input-label  black" for="name">Full name</label>
            <input type="text" :value="member.name">
        </div>
        <div class="input-field">
            <label class="input-label  black" for="email">Email Address</label>
            <input type="text" :value="member.email">
        </div>

        <input-timezone @timezone-select="modifyNewTeamMemberTimezone({index,timezone:$event})" :timezone_name="member.timezone.name"></input-timezone>

        <delete-btn class="large" @click="deleteNewTeamMember(index)"></delete-btn>
    </div>
</template>

<script>
import InputTimezone from "../utils/input-timezone";
import DeleteBtn from "../utils/buttons/delete-btn";
import { mapMutations } from 'vuex';

export default {
    props:['index','member'],
    components:{
        InputTimezone,
        DeleteBtn
    },
    methods:{
        ...mapMutations([
            'modifyNewTeamMemberTimezone',
            'deleteNewTeamMember']),
        
    }
}
</script>