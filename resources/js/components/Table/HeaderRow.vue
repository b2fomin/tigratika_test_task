<template>
    <thead>
        <tr>
            <th v-for="column in columns.slice(1)">{{ column }}</th>
        </tr>
    </thead>
</template>

<script setup lang="ts">    
    import { defineProps } from 'vue';
    defineProps<{columns: Array<string>}>();
</script>