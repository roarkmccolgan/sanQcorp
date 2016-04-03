<template>
    <div class="col-md-3">
        <div class="tile">
            <label class="checkbox">
                <input type="checkbox" name="contact[]" value="{{ contact.id }}"> {{ contact.first_name+' '+contact.last_name }}
            </label>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['contact'],
        ready(){
            jQuery(':checkbox').radiocheck();
        }
    };
</script>
