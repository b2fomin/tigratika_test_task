<template>
    <tr>
        <td v-for="column in data">{{ column }}</td>
    </tr>
</template>

<script setup lang="ts">
    import { defineProps } from 'vue';
    import { IRowData } from './TableTypes.types';
    defineProps<{
        data: IRowData
    }>();
</script>