<template>
    <table>
        <HeaderRow :columns="columns" />
    </table>
</template>

<script setup lang="ts">
import HeaderRow from "./HeaderRow.vue";
import { IRowData } from './TableTypes';

    defineProps<{
        columns: Array<string>,
        row_data?: Array<IRowData>
    }>()
</script>