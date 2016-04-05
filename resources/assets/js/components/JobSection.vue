<template>
    <div class="tile" style="text-align:left">
        <div class="row">
            <div class="col-md-12">

                <h6 style="margin: 0">{{section.name}}</h6>
                <p style="margin-bottom: 5px;">{{section.survey}}</p>
                <hr style="border-top: 1px solid #FFF;">
                <div class="clearfix"></div>
                <button class="btn btn-primary pull-right btn-sm" @click="add_section=true">add Option</button>
                <strong>Options</strong>
            
                <div class="clearfix"></div>
            </div>
        </div>
        <div class="clearfix" style="margin-top: 10px;"></div>
        <div class="panel panel-default" v-show="add_section">
            <div class="panel-heading">
                <button type="button" class="close" aria-label="Close" @click="add_section=''"><span aria-hidden="true">&times;</span></button>
                <h3 class="panel-title">Add Option</h3>
            </div>
            <div class="panel-body">
                <form>
                    <!-- <div class="col-md-12">
                        <label for="section_name">Name</label>
                        <input type="text" class="form-control" name="option_name" v-model="new_option.name">
                    </div> -->
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="system">System</label>
                            <select data-toggle="select" class="form-control select select-primary select-lg" v-select="system_selected">
                                <option>Please Select</option>
                                <option v-for="system in systems" v-bind:value="system.id">
                                {{ system.name }}
                                </option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <label for="section_survey">Description</label>
                        <textarea class="form-control" rows="3" name="option_description" v-model="new_option.description"></textarea>
                    </div>
                </form>
            </div>
        </div>
        <div v-show="system_selected==1">
            <concrete-mineral-torch-on-system :system="new_option"></concrete-mineral-torch-on-system>
        </div>
        

        <div class="row" v-for="task in section.tasks">
            <div class="col-md-4">
                <h5>{{task.name}}</h5>
            </div>
            <div class="col-md-4">
                <p>{{task.qty}}</p>
            </div>
            <div class="col-md-4">
                <p>{{task.total}}</p>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['section','systems'],
        data: function() {
            return {
                'system_selected': '',
                'add_section': '',
                new_option: {
                    description:''
                }

            };
        },
        components:{
            ConcreteMineralTorchOnSystem: require('./ConcreteMineralTorchOnSystem.vue')
        }
        /*ready(){
            jQuery(':checkbox').radiocheck();
        }*/
    };
</script>
