

<template>
    <div class="col-xs-6">
        <div class="panel panel-default" style="margin-left: 15px; margin-right: 15px">
            <div class="panel-heading">Add Log - {{task.name}}</div>
            <div class="panel-body">
                <form>
                    <div class="row">
                        <div class="col-xs-4">
                            <div class="form-group">
                                <label for="completed">Completed Today</label>
                                <div class="input-group">
                                    <input class="form-control" placeholder="" type="text" v-model="completed">
                                    <span class="input-group-addon">{{task.unit_of_measure}}</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-8">
                            <label>Who worked on this task</label>
                            <div class="form-group" style="margin-bottom:0">
                                <select type="hidden" v-select="task_employees" placeholder="Please Select" multiple class="form-control multiselect multiselect-primary mrs mbm">
                                    <option></option>
                                    <option v-for="(empKey, employee) in employees" v-bind:value="employee.id">{{employee.text}}</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row" v-for="employee in chosen_employees">
                        <div class="col-xs-8">
                            {{employee.text}}
                        </div>
                        <div class="col-xs-4">
                            <div class="input-group">
                                <input class="form-control" placeholder="" type="text"  value="{{amountDivided}}">
                                <span class="input-group-addon">{{task.unit_of_measure}}</span>
                            </div>
                        </div>
                    </div>
                    <div class="row" v-if="taskHasMaterials">
                        <div class="col-xs-12">
                            <button class="btn btn-primary pull-right" @click.prevent="addMaterial()"><i class="fui-plus"></i></button>
                            <label>Materials Used</label>
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
                chosen_employees: [],
                task_materials: [],
                completed: null,

            };
        },
        computed: {
            amountDivided: function(){
                if(this.completed!=0){
                    return (this.completed / this.chosen_employees.length).toFixed(2);
                }
            },
            taskHasMaterials: function(){
                return this.task && this.task.materials.length > 0;
            }
        },
        events: {
            selectFilter: function(val){
                if(val){
                    this.addEmployee(val);
                }else{
                    this.chosen_employees = [];
                }
            }
        },
        methods:{
            addMaterial: function(){
                this.task_materials.push({
                    id:'',
                    name: '',
                    qty: '',
                    unit_of_measure: ''
                });
            },
            addEmployee: function(id){
                var newList = [];
                for(var i=0; i<id.length; i++){
                    newList.push(this.employees[id[i]]);
                }
                this.chosen_employees = newList;
            }
        },
        /*ready(){
            jQuery(':checkbox').radiocheck();
        }*/
    };
</script>
