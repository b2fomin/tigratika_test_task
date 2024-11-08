<template>
    <TableComponent :columns="columns"/>
</template>

<script setup lang="ts">
    import TableComponent from './Table/Table.vue';
    import { IRowData } from './Table/TableTypes';
    import { ref } from 'vue';
    const columns = ref(['Наименование', 'Цена']);
</script>
