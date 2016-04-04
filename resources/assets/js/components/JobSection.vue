<template>
    <div class="row">
        <div class="tile">
            <div class="row">
                <h5>{{section.name}}</h5>
                <p>{{section.survey}}</p>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['section'],
        /*ready(){
            jQuery(':checkbox').radiocheck();
        }*/
    };
</script>
