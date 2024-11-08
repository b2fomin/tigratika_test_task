<template>
    <TableComponent :columns="columns"
                    :row_data="data"/>
</template>

<script setup lang="ts">
    import TableComponent from './Table/Table.vue';
    import { IRowData } from './Table/TableTypes.types';
    import { ref } from 'vue';
    let columns: Array<string> = ref([]);
    let data: Array<IRowData> = ref([]);
    axios.get('http://localhost:8000/api/v1/group')
    .then((response) => {
            columns.value = Object.keys(response['data'][0]);
            for (const row of response['data']) {
                data.value.push(row);
            }
        });
    
</script>
