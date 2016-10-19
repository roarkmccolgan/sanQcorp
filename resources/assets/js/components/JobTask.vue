<template>
    <div>
        <input name="section[{{key}}][id]" type="hidden" v-model="section.id" />
        <div class="row">
            <div class="col-xs-12">
                <h6>Tasks - {{section.name}}</h6>
                <div class="row">
                    <div v-bind:class="{ 'col-xs-6': edit_task, 'col-xs-12': !edit_task }">
                        <div class="list-group">
                            <template v-for="(optKey, option) in section.options">
                                <a @click.prevent="setTask(task)" class="list-group-item" v-bind:class="{'active': edit_task.name==task.name}" v-for="(tasKey, task) in option.tasks">
                                    <strong class="list-group-item-heading">{{task.name}}</strong>
                                    <p class="list-group-item-text">
                                        <strong>{{Math.round((task.pivot.done/task.pivot.total)*100)}}%</strong> complete {{task.pivot.total-task.pivot.done}}{{task.unit_of_measure}} remaining
                                    </p>                                    
                                </a>
                            </template>
                        </div>
                    </div>
                    <task-entry v-show="edit_task" :task.sync="edit_task" :task-options="edit_task.selectMaterials" :employees="employees"></task-entry>
                </div>                
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['section','systems','key','removeSection', 'employees'],
        data: function() {
            return {
                //system_selected: '',
                edit_task:''
            };
        },
        components: {
            TaskEntry: require('./TaskEntry.vue'),
        },
        methods:{
            setTask: function(task){
                this.edit_task = task
            },
            removeTask: function(){
                this.edit_task = '';
            }
        },
        /*ready(){
            jQuery(':checkbox').radiocheck();
        }*/
    };
</script>
