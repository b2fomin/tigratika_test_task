<template>
    <table class="table table-striped">
        <HeaderRow :columns="Object.keys(response['data']['data'][0])" />
        <BodyRow v-for="row in response['data']['data']" :data="delete row.id && row" 
        :id="order[response['data']['data'].indexOf(row)]+response['data']['meta']['page']+(response['data']['meta']['page']-1)*response['data']['meta']['per_page']" 
        :current="response['data']['data'].indexOf(row)" :total="response['data']['data'].length" 
        @move-cell-up="onMoveCellUp"
        @move-cell-down="onMoveCellDown"
        @delete-row="onDelete"/>
    </table>
    <footer>
        <Pagination v-model="response['data']['meta']['page']" 
                            :records="response['data']['meta']['total_number']"
                            :perPage="response['data']['meta']['per_page']"
                             @paginate="onPaginate"/>
    </footer>
</template>

<script setup lang="ts">
    import HeaderRow from "./HeaderRow.vue";
    import BodyRow from "./BodyRow.vue";
    import Pagination from 'v-pagination-3';
    import { defineProps, defineEmits, ref, Ref } from 'vue';
    import { AxiosResponse } from "axios";

    const props = defineProps<{
        response: AxiosResponse
        }>();
    
    const emit = defineEmits<{
        'move-cell-up': [index: number],
        'move-cell-down': [index: number],
        'receive-data': [order: Array<number>],
        'delete-row': [index: number]
    }>();
    
    function range(start, stop, step=1) {
        return Array.from({ length: (stop - start) / step + 1}, (_, i) => start + (i * step))
    }

    const base_url: string = window.location.origin;
    const order = ref(range(0, props.response['data']['meta']['per_page']));

    async function onMoveCellUp(index: number) {
        let tmp = order.value[index];
        order.value[index] = order.value[index + 1];
        order.value[index + 1] = tmp;
        onPaginate();
    }

    async function onMoveCellDown(index: number) {
        let tmp = order.value[index];
        order.value[index] = order.value[index - 1];
        order.value[index - 1] = tmp;        
        onPaginate();
    }

    async function onPaginate() {
            let new_url = base_url;
            let response = props.response['data'];

            new_url += '?page=' + response['meta']['page'];
            new_url += '&per_page=' + response['meta']['per_page'];

            window.history.replaceState(document.title, Object(), new_url);

            emit('receive-data', order.value);

    }

    async function onDelete(index: number) {
        order.value.splice(index, 1);
        for (let i = index; i < order.value.length; ++i) {
            --order.value[i];
        }
        
        emit('receive-data', order.value);
    }
</script>