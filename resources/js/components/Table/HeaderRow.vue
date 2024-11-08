<template>
    <template v-for="column in columns">
        <th>{{ column }}</th>
    </template>
</template>

<script setup lang="ts">
    
    defineProps<{columns: Array<string>}>();
</script>