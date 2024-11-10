<template>
    <TableComponent :columns="columns"
                    :row_data="data"
                    @move-cell-up="onMoveCellUp"
                    @move-cell-down="onMoveCellDown"/>
    <Pagination v-model="page" :records="total_pages" :perPage="per_page" @paginate="on_paginate"/>
</template>

<script setup lang="ts">
    import TableComponent from './Table/Table.vue';
    import { IRowGroupData } from './Table/TableTypes.types';
    import Pagination from 'v-pagination-3';
    import { ref, Ref, defineEmits } from 'vue';
    import axios from 'axios';

    defineEmits<{
        'move-cell-up': [index: number],
        'move-cell-down': [index: number]
    }>();

    let columns: Ref<Array<string>> = ref([]);
    let data: Ref<Array<IRowGroupData>> = ref([]);

    let params = new URLSearchParams(document.location.search);
    let page = ref(Number(params.get('page')));
    let per_page = ref(Number(params.get('per_page')));
    let total_pages = ref(0);
    const base_url: string = window.location.origin;

    function range(start, end) {
        if(start === end) return [start];
        return [start, ...range(start + 1, end)];
    }

    const order = ref(range(0, per_page.value - 1))

    async function onMoveCellUp(index: number) {
        let tmp = order.value[index];
        order.value[index] = order.value[index + 1];
        order.value[index + 1] = tmp;
        on_paginate();
    }

    async function onMoveCellDown(index: number) {
        let tmp = order.value[index];
        order.value[index] = order.value[index - 1];
        order.value[index - 1] = tmp;
        on_paginate();
    }
    async function on_paginate() {
        columns.value = [];
        data.value = [];
        
        await axios.get(`./api/v1/group`, {params: {order: order.value, page: page.value, per_page: per_page.value}})
        .then((response) => {
            let new_url = base_url;
            response = response['data'];

            page.value = response['meta']['page'];
            new_url += '?page=' + page.value;

            per_page.value = response['meta']['per_page'];
            new_url += '&per_page=' + per_page.value;

            total_pages.value = response['meta']['total_number'];
            columns.value = Object.keys(response['data'][0]);
            data.value = response['data'];

            window.history.replaceState(document.title, Object(), new_url);
        });            
    }

    on_paginate();
    
</script>
