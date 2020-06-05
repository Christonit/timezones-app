<template>
    <div class="row">
        <div class="col-12 col-md-3"></div>
        <div class="col-9 col-md-6">
            <div id='top-searchbar' class="input-group">

                <span class="material-icons">
                    search
                </span>

                <input  class="form-control" type="text" placeholder="Search"/>
            
            </div>
        </div>
        <div class="col-3 col-md-3">
            <div class="view-toggle">
                <button class="material-icons">
                    view_module
                </button>
                <button class="material-icons">
                    view_stream
                </button>
            </div>
            
        </div>
    </div>
</template>

<script>
export default {
    data(){
        return {

        }
    }
}
</script>