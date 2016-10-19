<style>
    .modal-header h3 {
        margin-top: 0;
        color: #42b983;
    }

    .modal-body {
        margin: 20px 0;
    }

    .text-right {
        text-align: right;
    }

    .form-label {
        display: block;
        margin-bottom: 1em;
    }

</style>

<template>
    <modal :show.sync="show" :title="title" :on-close="close">
        <form action="/orders/" class="form-horizontal" role="form" method="POST" enctype="multipart/form-data" ><!-- @submit.prevent="submitForm($event)" -->
        <input type="hidden" name="_token" v-model="token">
        <div class="modal-body" v-show="job">
            <input type="hidden" name="job[id]" v-model="job.id" />
            <div class="row">
                <div class="col-xs-9">Has the Job been accepted</div>
                <div class="col-xs-3"><input v-switch="job.accepted" type="checkbox" data-toggle="switch" data-on-text="Yes" data-off-text="No" /></div>
            </div>
            <hr />
            <div class="row" v-if="job.accepted">
                <div class="col-xs-12" v-for="section in job.sections">
                    <strong>{{section.name}}</strong>
                    <div class="row" v-for="option in section.options">
                        <div class="col-xs-8 col-xs-offset-1">
                            {{option.name}}
                        </div>
                        <div class="col-xs-3">
                            <input v-switch:showorder="option.accepted" v-model="option.accepted" type="checkbox" id="custom-{{section.id}}-{{option.id}}" name="job[option][{{option.id}}][accepted]" data-toggle="switch" data-on-text="Yes" data-off-text="No" / >
                        </div>
                    </div>
                </div>
            </div>
            <hr />
            <div class="row">
                <div class="col-xs-12" v-show="orderdetails&&job.accepted">
                    <div class="row">
                        <div class="col-xs-12">                            
                            <div class="form-group">
                                <label for="inputEmail1" class="col-xs-3 control-label">Accepted by</label>
                                <div class="col-xs-9">
                                    <vue-autocomplete
                                        id="contact"
                                        name="contact"
                                        :param="contactparam"
                                        url="/api/contacts"
                                        anchor="name"
                                        placeholder="Company Contact"
                                        delay="500"
                                        label="Contact"
                                        limit="5"
                                        model="contact"
                                        class="form-control">
                                    </vue-autocomplete>
                                    <input type="hidden" name="contact_id" id="contact_id">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputEmail1" class="col-xs-3 control-label">Requested Start</label>
                                <div class="col-xs-9">
                                    <div class="input-group">
                                        <span class="input-group-btn">
                                            <button class="btn" type="button"><span class="fui-calendar"></span></button>
                                        </span>
                                        <input type="text" name="job[start_date]" class="form-control" value="{{requested_start_date | moment 'D MMMM, YYYY'}}" id="datepicker-01" />
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="upload" class="col-xs-3 control-label">Order</label>
                                <div class="col-xs-9">
                                    <div class="fileinput fileinput-new" data-provides="fileinput">
                                        <span class="btn btn-inverse btn-sm btn-embossed btn-file">
                                            <span class="fileinput-new"><span class="fui-upload"></span>&nbsp;&nbsp;Upload Order</span>
                                            <span class="fileinput-exists"><span class="fui-gear"></span>&nbsp;&nbsp;Change</span>
                                            <input name="upload" id="fileUploadFile" type="file" @change="orderFile">
                                        </span>
                                        <span class="fileinput-filename">{{orderdetails.upload}}</span>
                                        <a href="#" class="close fileinput-exists" data-dismiss="fileinput" style="float: none">&times;</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal-footer text-right">
            <button type="submit" v-bind:class="{'disabled': !cansubmit}" class="btn btn-lg btn-primary">
                Save
            </button>
            <button type="reset" class="btn btn-lg btn-danger" @click.prevent="this.close()">
                Close
            </button>
        </div>
        </form>
    </modal>
</template>

<script>
    export default {
        props: ['show'],
        data() {
            return {
                token: document.querySelector('#token').getAttribute('value'),
                job: false,
                title: '',
                orderdetails:false,
                contact: false,
                fileUploaded: false
            };
        },
        components: {
            VueAutocomplete: require('./vue-autocomplete.vue'),
            Modal: require('./Modal.vue')
        },
        computed: {
            contactparam: function(){
                if(this.job){
                    return 'company_id=' + this.job.contacts[0].company.id + '&name';
                }
            },
            cansubmit: function(){
                return true;
                if(this.job && (this.contact && this.job.fileUploaded)){
                    return true;
                }
                return false;
            }
        },
        methods: {
            close: function () {
                this.show = false;
                this.title = '';
                this.job = false;
                this.orderdetails = false;
                this.contact = false;
                this.fileUploaded = false;
            },
            showorder: function(value, el){
                //var anyAccepted = false;
                var id = $(el).attr('id').split("-");
                var secId=id[1];
                var optId=id[2];
                var anyAccepted = false;
                var sectionAccepted = false;
                for (var h = 0; h < this.job.sections.length; h++) {
                    var optionAccepted = false;
                    for (var i = 0; i < this.job.sections[h].options.length; i++) {
                        if(this.job.sections[h].options[i].accepted==true){
                            anyAccepted = true;optId
                            if(this.job.sections[h].id==secId && this.job.sections[h].options[i].id!=optId && optionAccepted==false && value==true){
                                this.job.sections[h].options[i].accepted=false;
                                optionAccepted = true;
                            }
                        }
                    }
                }
                this.orderdetails = anyAccepted;
            },
            orderFile: function(event){
                //console.log(event);
            },
            submitForm: function(event){
                console.log(event);
            }
        },
        events: {
            'autocomplete:selected': function(name,data){
                console.log(data.id);
                $('#contact_id').val(data.id);
            },
            'modal-job-status:open': function (jobId,title) {
                this.title = title;
                this.$http.get('/api/job', {
                    id: jobId
                }).then(function(result){
                    if(result.data.result=='success'){
                        this.job=result.data.job;
                        if(this.job.order){
                            $('#contact_id').val(this.job.order.contact_id);
                        }
                        
                        this.show = true;
                        var self = this;

                        setTimeout(function(){
                            var datepickerSelector = $('#datepicker-01');
                            datepickerSelector.datepicker({
                                showOtherMonths: true,
                                selectOtherMonths: true,
                                dateFormat: 'd MM, yy',
                                yearRange: '-1:+1'
                            }).prev('.input-group-btn').on('click', function (e) {
                                e && e.preventDefault();
                                datepickerSelector.focus();
                            });
                            $.extend($.datepicker, { _checkOffset: function (inst,offset,isFixed) { return offset; } });

                            // Now let's align datepicker with the prepend button
                            datepickerSelector.datepicker('widget').css({ 'margin-left': -datepickerSelector.prev('.input-group-btn').find('.btn').outerWidth() + 3 });

                            //another request
                            if(self.job.order){
                                self.$http.get('/api/contacts', {
                                    id: self.job.order.contact_id
                                }).then(function(result){
                                    //console.log(result);
                                    self.contact =  result.data.first_name+' '+result.data.last_name;
                                    $('#contact').val(self.contact);
                                }, function(data){
                                    console.log(data, status, request);
                                });
                            }

                        }, 300);                            
                    }
                    //$('#fileUploadFile').val(result.data.filename);
                }, function(data){
                    console.log(data, status, request);
                });
            },
            switchFilter:function(method,value,el){
                this[method](value,el);
            }
        },
        ready(){
            console.log('status ready');
        }
    };
</script>
