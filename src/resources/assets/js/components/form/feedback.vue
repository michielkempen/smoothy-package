<template>
    <div class="feedback">
        <div class="icon"></div>
        <div class="message">
            {{ message }}
        </div>
    </div>
</template>

<script>
    export default {
        props: [ 'message' ]
    }
</script>
