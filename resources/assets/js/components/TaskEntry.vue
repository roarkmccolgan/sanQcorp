

<template>
    <div class="col-sm-6">
        <div class="panel panel-default" style="margin-left: 15px; margin-right: 15px">
            <div class="panel-heading">Add Log - {{task.name}}</div>
            <div class="panel-body">
                <form>
                    <div class="row">
                        <div class="col-xs-12">
                        <label>Who worked on this task</label>
                            <div class="form-group" style="margin-bottom:0">
                                
                                <select type="hidden" v-select="task_employees" :placeholder="Please Select" multiple class="form-control multiselect multiselect-primary mrs mbm">
                                    <option></option>
                                    <option v-for="employee in employees" v-bind:value="employee.id">{{employee.text}}</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-6">
                            <div class="form-group">
                                <label for="completed">Area Completed Today</label>
                                <div class="input-group">
                                    <input class="form-control" placeholder="" type="text">
                                    <span class="input-group-addon">{{task.unit_of_measure}}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12">
                            <button class="btn btn-primary pull-right" @click.prevent="addMaterial()"><i class="fui-plus"></i></button>
                            <label>Materials Taken This Morning</label>
                            <table class="table table-stripped">
                                <tr v-for="material in task_materials">
                                    <td width="75%">
                                        <select v-model="material" class="form-control">
                                            <option v-for="task_material in task.materials" v-bind:value="task_material">{{task_material.name}}</option>
                                        </select>
                                    </td>
                                    <td>
                                        <div class="input-group">
                                            <input v-model="material.qty" class="form-control" placeholder="Qty" type="text">
                                            <span class="input-group-addon">ea</span>
                                        </div>
                                    </td>
                                </tr>
                            </table>
                            <button class="btn btn-primary pull-right" @click.prevent="addMaterial()"><i class="fui-plus"></i></button>
                            <label>Materials Returned This Afternoon</label>

                            <!-- <table class="table table-stripped">
                                <tr v-for="(product_type, materials) in task.groupedMaterials">
                                    <td>{{product_type}}</td>
                                    <td>
                                        <select :placeholder="Please Select" class="form-control select select-inverse mrs mbm">
                                            <option v-for="material in materials" v-bind:value="material.id">{{material.name}}</option>
                                        </select>
                                    </td>
                                    <td>
                                        <div class="input-group">
                                            <input v-model="task_materials.value" class="form-control" placeholder="Qty" type="text">
                                            <span class="input-group-addon">{{material.name}}</span>
                                        </div>
                                    </td>
                                </tr>
                            </table> -->
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="form-group">
                                <button class="btn btn-primary btn-wide" @click.prevent="">Save</button>
                                <button class="btn btn-default btn-wide" @click.prevent="task=''">Cancel</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['task','option','jobId','taskOptions', 'employees'],
        data: function() {
            return {
                //system_selected: '',
                option_system:'',
                total_percentages: '',
                task_employees: [],
                task_materials: []
            };
        },
        methods:{
            addMaterial: function(){
                this.task_materials.push({
                    id:'',
                    name: '',
                    qty: '',
                    unit_of_measure: ''
                });
            }
        },
        /*ready(){
            jQuery(':checkbox').radiocheck();
        }*/
    };
</script>
