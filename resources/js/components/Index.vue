<template>
    <TableComponent :columns="columns"
                    :row_data="data"/>
</template>

<script setup lang="ts">
    import TableComponent from './Table/Table.vue';
    import { IRowData } from './Table/TableTypes.types';
    import { ref } from 'vue';
    const columns: Array<string> = ref(['Наименование', 'Кол-во', 'Источник', 'Лазер', 'Сварка', 'Электричество']);
    const data: Array<IRowData> = ref([{name: 'name', amount: 10, source: 'source', lazer: 10, welding: 10, electricity: 10}]);
</script>
