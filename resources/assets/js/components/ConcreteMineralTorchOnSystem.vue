<template>
    <h6>{{system.name}}</h6>
    <div class="col-md-3">
        <div class="tile">
            Yeah MAN
        </div>
    </div>
</template>

<script>
    export default {
        props: ['system'],
        ready(){
            jQuery(':checkbox').radiocheck();
        }
    };
</script>
