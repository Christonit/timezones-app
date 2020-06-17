<template>

    <modal-template  class="invite-created-modal">
        <template>
            <h2 class="title">“Scopic Web” was created</h2>
            <h4 class="title-caption w-100 text-center">Time to add teammates</h4>

            <div class="popup-fields-container">
                <b class="mb-3">Copy and share this link to add members</b>
                <div class="inline-input-field">
                    <span class='filled'>timezonesmachine.com/04984</span>
                    <button>Copy</button>
                </div>
            </div>
            <hr class="full-width-popup-hr"/>
            <div class="popup-fields-container">
                <b class="mb-3">Or invite by Email</b>
                <div class="inline-input-field">
                    <input type="text" value="" placeholder="Type an Email address">
                    <button>Send invite</button>
                </div>
            </div>

            <button class="mt-3 btn-link-green">Add members Manually</button>
            
        </template>
        
    </modal-template>
    
</template>

<script>
import ModalTemplate from './template.vue';
export default {
    name: 'team-created-modal',
    components:{
        ModalTemplate
    },
    methods:{
        
    }
}
</script>