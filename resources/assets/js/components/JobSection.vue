<template>
    <div class="row">
        <div class="col-md-12">
            <button class="btn btn-danger pull-right btn-xs" @click.prevent="removeSection(key)"><i class="fui-cross"></i></button>
            <br/>
                <!-- <h6 style="margin: 0">{{section.name}}</h6> -->
                <div class="form-group">
                    <input name="section[{{key}}][name]" type="text" class="form-control input-lg" placeholder="Section Name" v-model="section.name" value="Section {{key+1}}" />
                </div>
                <div class="form-group">
                    <textarea name="section[{{key}}][survey]" class="form-control" rows="3" placeholder="Site Survey" v-model="section.survey"></textarea>
                </div>
                <div class="clearfix"></div>
                <button class="btn btn-primary pull-right btn-sm" @click.prevent="addOption">add Option</button>
                <strong>Options</strong>
            <div class="clearfix"></div>
        </div>
    </div>
    <div class="clearfix" style="margin-top: 10px;"></div>
    <div class="tile" style="text-align:left" v-show="section.options" v-for="(optionKey, option) in section.options">
        <div class="row">
            <template v-if="option.system">
                <div class="col-md-12">
                    <button class="btn btn-danger btn-xs pull-right" style="z-index:1" @click.prevent="removeOption(optionKey)"><i class="fui-cross"></i></button><br>
                    <div class="form-group">
                        <input name="section[{{key}}][options][{{optionKey}}][name]" type="text" class="form-control" placeholder="Option #" v-model="option.name" value="Option {{optionKey+1}} - {{option.system.alias}}" />
                    </div>
                    <div class="form-group">
                        <textarea name="section[{{key}}][options][{{optionKey}}][description]" class="form-control" rows="2" placeholder="Explanation / description" v-model="option.description">{{option.system.description}}</textarea>
                    </div>
                </div>
            </template>
            <div class="col-md-12">
                <div class="form-group">
                    <div class="form-group">
                        <label for="system">System</label>
                        <select v-model="option.system" class="form-control">
                          <option v-for="system in systems" v-bind:value="system">{{system.name}}</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-md-12" v-if="option.system">
                <component :is="option.system.component" :option="option" :option-key="optionKey" :section-key="key"></component>
            </div>
        </div>
    </div>
    <hr>
</template>

<script>
    export default {
        props: ['section','systems','key','removeSection'],
        data: function() {
            return {
                //system_selected: '',
                option_system:''
            };
        },
        components:{
            ConcreteMineralTorchOnSystem: require('./ConcreteMineralTorchOnSystem.vue'),
            SanikaBoardedMineralTorchOnSystem: require('./SanikaBoardedMineralTorchOnSystem.vue'),
        },
        methods:{
            addOption: function(){
                this.section.options.push({
                    id:'',
                    name: '',
                    description: '',
                    system: ''
                });
            },
            removeOption: function(key){
                this.section.options.splice(key);
            },
        },
        /*ready(){
            jQuery(':checkbox').radiocheck();
        }*/
    };
</script>
