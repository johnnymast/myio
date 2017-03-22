<template>
    <div :class="['notification', level]" v-show="show">
        <slot></slot>
        <button type="button" class="delete" @click="show = false"></button>
    </div>
</template>

<script>
    export default {
        props: {
            level: {
                default: 'is-primary'
            }
        },

        data() {
            return {
                show: true
            }
        }
    }
</script>