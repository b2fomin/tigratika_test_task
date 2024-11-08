<template>
    <thead>
        <tr>
            <th v-for="column in columns">{{ column }}</th>
        </tr>
    </thead>
</template>

<script setup lang="ts">    
    import { defineProps } from 'vue';
    defineProps<{columns: Array<string>}>();
</script>