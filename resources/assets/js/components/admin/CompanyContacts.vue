<template>
    <div class="col-md-3">
        <div class="tile">
            <label class="checkbox">
                <input type="checkbox" id="contact_{{contact.id}}" name="contact[{{contactKey}}][id]" value="{{ contact.id }}"> {{ contact.first_name+' '+contact.last_name }}
            </label>
            <input type="hidden" name="contact[{{contactKey}}][first_name]" value="{{contact.first_name}}">
            <input type="hidden" name="contact[{{contactKey}}][last_name]" value="{{contact.last_name}}">
        </div>
    </div>
</template>

<script>
    export default {
        props: ['contact','contactKey'],
        ready(){
            jQuery(':checkbox').radiocheck();
            if(laravel.old.contact && laravel.old.contact.length){
                var that=this;
                jQuery(laravel.old.contact).each(function(index, item){
                    if(item.id == that.contact.id){
                        jQuery('#contact_'+that.contact.id).radiocheck('check');
                    }
                });
            }
        }
    };
</script>
